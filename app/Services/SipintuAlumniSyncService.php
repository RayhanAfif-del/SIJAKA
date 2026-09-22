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
     * Only processes students where graduated is true.
     *
     * @param bool $deleteDummy Whether to delete dummy alumni records (nis is null or empty) and non-graduated records
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
        $alumniRecords = $this->filterGraduatedStudents($records);

        $synced = 0;
        $this->db->transaction(function () use ($records, $alumniRecords, $deleteDummy, &$synced): void {
            if ($deleteDummy) {
                $this->deleteDummyAlumni();
                $this->pruneNonGraduatedAlumni($records);
            }

            foreach ($alumniRecords as $student) {
                $nis = (string) data_get($student, 'nis');
                $sourceEmail = data_get($student, 'user.email') ?? data_get($student, 'email');
                $email = is_string($sourceEmail) && filter_var($sourceEmail, FILTER_VALIDATE_EMAIL)
                    ? $sourceEmail
                    : null;

                if ($nis === '') {
                    continue;
                }

                $existing = Alumni::where('nis', $nis)->first()
                    ?? ($email ? Alumni::where('email', $email)->first() : null);

                $nama = data_get($student, 'nama', data_get($student, 'user.name', 'Alumni SiPintu'));
                $jurusan = $this->determineJurusan($student);
                $tahunLulus = $this->determineTahunLulus($student);

                $rawPassword = (string) (data_get($student, 'password')
                    ?? data_get($student, 'user.password')
                    ?? 'password');

                if ($existing) {
                    $updateAttributes = [
                        'nama' => $nama,
                    ];

                    if ($email) {
                        $updateAttributes['email'] = $email;
                    }

                    if ($existing->jurusan === 'Belum ditentukan' && $jurusan !== 'Belum ditentukan') {
                        $updateAttributes['jurusan'] = $jurusan;
                    }

                    if ($existing->tahun_lulus !== $tahunLulus) {
    $updateAttributes['tahun_lulus'] = $tahunLulus;
}

                    if (blank($existing->password) && $rawPassword !== '') {
                        $updateAttributes['password'] = $rawPassword;
                    }

                    $existing->update($updateAttributes);
                } else {
                    $createAttributes = [
                        'nis' => $nis,
                        'nama' => $nama,
                        'jurusan' => $jurusan,
                        'tahun_lulus' => $tahunLulus,
                        'status' => 'Belum Bekerja',
                    ];

                    if ($email) {
                        $createAttributes['email'] = $email;
                    }

                    if ($rawPassword !== '') {
                        $createAttributes['password'] = $rawPassword;
                    }

                    Alumni::create($createAttributes);
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
     * Prune alumni in SIJAKA who are present in SiPintu data but marked as NOT graduated.
     */
    public function pruneNonGraduatedAlumni(array $records): int
    {
        $nonGraduatedNis = [];
        foreach ($records as $record) {
            $graduated = data_get($record, 'graduated', data_get($record, 'user.graduated'));
            $isGrad = filter_var($graduated, FILTER_VALIDATE_BOOLEAN) === true
                || $graduated === 1
                || $graduated === '1'
                || $graduated === true;

            if (! $isGrad) {
                $nis = (string) data_get($record, 'nis');
                if ($nis !== '') {
                    $nonGraduatedNis[] = $nis;
                }
            }
        }

        if (! empty($nonGraduatedNis)) {
            return Alumni::whereIn('nis', $nonGraduatedNis)->delete();
        }

        return 0;
    }

    /**
     * Filter records where graduated is true.
     */
    public function filterGraduatedStudents(array $records): array
    {
        return array_values(array_filter($records, function (mixed $record): bool {
            $graduated = data_get($record, 'graduated', data_get($record, 'user.graduated'));

            return filter_var($graduated, FILTER_VALIDATE_BOOLEAN) === true
                || $graduated === 1
                || $graduated === '1'
                || $graduated === true;
        }));
    }

    /**
     * @deprecated Gunakan filterGraduatedStudents(). Dipertahankan untuk kompatibilitas.
     */
    public function filterOnlyNullClassroom(array $records): array
    {
        return $this->filterGraduatedStudents($records);
    }

    /**
     * Determine major (jurusan) from classroom name or student record.
     */
    public function determineJurusan(mixed $student): string
    {
        $className = (string) (data_get($student, 'classroom.name') ?? data_get($student, 'classroom_name') ?? '');
        if ($className !== '') {
            $majorMap = [
                'PPLG' => 'Pengembangan Perangkat Lunak dan Gim',
                'RPL' => 'Rekayasa Perangkat Lunak',
                'AKL' => 'Akuntansi dan Keuangan Lembaga',
                'MPLB' => 'Manajemen Perkantoran dan Layanan Bisnis',
                'PM' => 'Pemasaran',
                'TO' => 'Teknik Otomotif',
                'DKV' => 'Desain Komunikasi Visual',
                'TKJ' => 'Teknik Komputer dan Jaringan',
                'TBSM' => 'Teknik Bisnis Sepeda Motor',
            ];

            foreach ($majorMap as $code => $fullName) {
                if (preg_match('/\b' . preg_quote($code, '/') . '\b/i', $className)) {
                    return $fullName;
                }
            }

            if (preg_match('/^(?:X|XI|XII)\s+([A-Za-z]+)/i', $className, $matches)) {
                return strtoupper($matches[1]);
            }

            return $className;
        }

        return (string) (data_get($student, 'jurusan') ?? 'Belum ditentukan');
    }

    /**
     * Determine graduation year from student record.
     */
    public function determineTahunLulus(mixed $student): string
    {
        $year = data_get($student, 'tahun_lulus', data_get($student, 'graduation_year'));
        if ($year && is_numeric($year)) {
            return (string) $year;
        }

        $gradDate = data_get($student, 'graduated_at', data_get($student, 'updated_at'));
        if ($gradDate && strtotime((string) $gradDate)) {
            return date('Y', strtotime((string) $gradDate));
        }

        return (string) config('services.sipintu.default_graduation_year', date('Y'));
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
