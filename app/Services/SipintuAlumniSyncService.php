<?php

namespace App\Services;

use App\Models\Alumni;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Cache;

class SipintuAlumniSyncService
{
    public function __construct(
        private readonly SipintuGatewayService $gateway,
        private readonly DatabaseManager $db
    ) {}

    /**
     * Sync alumni records from SiPintu API Gateway.
     * Only processes students where classroom and classroom_id are null.
     *
     * @param bool $deleteDummy Whether to delete dummy alumni records (nis is null or empty)
     * @return array{synced: int, total_received: int}
     */
    public function sync(bool $deleteDummy = false): array
    {
        $response = $this->gateway->students();

        if (! $response->successful()) {
            throw new \RuntimeException('Gateway SiPintu mengembalikan respons gagal: ' . $response->status());
        }

        $payload = $response->json();
        Cache::put('sipintu.students', $payload, now()->addHour());

        $records = $this->extractRecords($payload);
        $alumniRecords = $this->filterOnlyNullClassroom($records);

        $synced = 0;
        $this->db->transaction(function () use ($alumniRecords, $deleteDummy, &$synced): void {
            if ($deleteDummy) {
                $this->deleteDummyAlumni();
            }

            foreach ($alumniRecords as $student) {
                $nis = (string) data_get($student, 'nis');
                $sourceEmail = data_get($student, 'user.email');
                $email = is_string($sourceEmail) && filter_var($sourceEmail, FILTER_VALIDATE_EMAIL)
                    ? $sourceEmail
                    : null;

                if ($nis === '') {
                    continue;
                }

                $existing = Alumni::where('nis', $nis)->first()
                    ?? ($email ? Alumni::where('email', $email)->first() : null);

                $attributes = [
                    'nis' => $nis,
                    'nama' => data_get($student, 'nama', data_get($student, 'user.name', 'Alumni SiPintu')),
                    'jurusan' => 'Belum ditentukan',
                    'tahun_lulus' => (string) config('services.sipintu.default_graduation_year', date('Y')),
                    'status' => 'Belum Bekerja',
                ];

                if ($email) {
                    $attributes['email'] = $email;
                }

                $rawPassword = (string) (data_get($student, 'password')
                    ?? data_get($student, 'user.password')
                    ?? 'password');

                if ($existing) {
                    if (blank($existing->password) && $rawPassword !== '') {
                        $attributes['password'] = $rawPassword;
                    }
                    $existing->update($attributes);
                } else {
                    if ($rawPassword !== '') {
                        $attributes['password'] = $rawPassword;
                    }
                    Alumni::create($attributes);
                }
                $synced++;
            }
        });

        Cache::forever('sipintu.last_sync_at', now()->toIso8601String());

        return [
            'synced' => $synced,
            'total_received' => count($alumniRecords),
        ];
    }

    /**
     * Delete dummy alumni that do not have NIS or were generated as dummy.
     */
    public function deleteDummyAlumni(): int
    {
        return Alumni::whereNull('nis')->orWhere('nis', '')->delete();
    }

    /**
     * Strictly filter records where classroom is null.
     */
    public function filterOnlyNullClassroom(array $records): array
    {
        return array_values(array_filter($records, function (mixed $record): bool {
            return is_null(data_get($record, 'classroom')) && is_null(data_get($record, 'classroom_id'));
        }));
    }

    private function extractRecords(mixed $payload): array
    {
        foreach (['data', 'students', 'results'] as $key) {
            $records = data_get($payload, $key);

            if (is_array($records) && array_is_list($records)) {
                return $records;
            }
        }

        return is_array($payload) && array_is_list($payload)
            ? $payload
            : [];
    }
}
