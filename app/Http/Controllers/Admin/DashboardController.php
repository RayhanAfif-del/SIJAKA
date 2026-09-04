<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Lowongan;
use App\Models\Mitra;
use App\Support\GaleriStack;
use App\Services\SipintuGatewayService;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function syncSipintu(SipintuGatewayService $gateway): RedirectResponse
    {
        try {
            $students = $gateway->students(['role' => 'alumni']);

            if (! $students->successful()) {
                throw new \RuntimeException('Gateway SiPintu mengembalikan respons gagal.');
            }

            $studentPayload = $students->json();
            Cache::put('sipintu.students', $studentPayload, now()->addHour());

            $studentRecords = $this->records($studentPayload, 'students');
            $syncedAlumni = $this->syncAlumni($studentRecords);
            $studentCount = count($studentRecords);
            Cache::forever('sipintu.last_sync_at', now()->toIso8601String());

            return redirect()->route('admin.dashboard')->with(
                'status',
                "Sinkronisasi SiPintu berhasil. {$syncedAlumni} data alumni dari {$studentCount} siswa diterima."
            );
        } catch (\Throwable $exception) {
            Log::warning('SiPintu dashboard synchronization failed', [
                'message' => $exception->getMessage(),
                'exception' => $exception,
            ]);

            return redirect()->route('admin.dashboard')->with('error', 'Sinkronisasi SiPintu gagal. Periksa konfigurasi dan koneksi gateway.');
        }
    }

    public function index()
    {
        return view('admin.dashboard.index', [
            'totalMitra' => Mitra::count(),
            'totalLowongan' => Lowongan::count(),
            'totalArtikel' => Artikel::count(),
            'totalAlumni' => Alumni::count(),
            'galeriStacks' => GaleriStack::group(
                Galeri::latest('tanggal')->latest('id')->take(24)->get()
            )->take(6)->values(),

            'alumniBekerja' => Alumni::bekerja()->count(),
            'alumniBerwirausaha' => Alumni::berwirausaha()->count(),
            'alumniMelanjutkanStudi' => Alumni::melanjutkanStudi()->count(),
            'alumniBelumBekerja' => Alumni::belumBekerja()->count(),

            'alumniPerTahun' => Alumni::selectRaw('tahun_lulus, status, count(*) as total')
                ->groupBy('tahun_lulus', 'status')
                ->orderBy('tahun_lulus')
                ->get()
                ->groupBy('tahun_lulus'),

            'lowonganMenunggu' => Lowongan::menunggu()->with('mitra')->latest()->take(5)->get(),

            'lowonganByStatus' => Lowongan::selectRaw('status, count(*) as total')
                ->groupBy('status')
                ->pluck('total', 'status'),

            'topLowongan' => Lowongan::with('mitra')
                ->orderByDesc('jumlah_kunjungan')
                ->take(5)
                ->get(),

            'sipintuLastSync' => Cache::get('sipintu.last_sync_at'),
        ]);
    }

    private function syncAlumni(array $students): int
    {
        $synced = 0;

        app(DatabaseManager::class)->transaction(function () use ($students, &$synced): void {
            foreach ($students as $student) {
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
                    'tahun_lulus' => (string) config('services.sipintu.default_graduation_year'),
                    'status' => 'Belum Bekerja',
                ];

                if ($email) {
                    $attributes['email'] = $email;
                }

                if ($existing) {
                    $existing->update($attributes);
                } else {
                    Alumni::create($attributes);
                }
                $synced++;
            }
        });

        return $synced;
    }

    private function records(mixed $payload, string $resource): array
    {
        foreach (['data', $resource, 'results'] as $key) {
            $records = data_get($payload, $key);

            if (is_array($records) && array_is_list($records)) {
                return $this->alumniRecords($records);
            }
        }

        return is_array($payload) && array_is_list($payload)
            ? $this->alumniRecords($payload)
            : [];
    }

    private function alumniRecords(array $records): array
    {
        return array_values(array_filter($records, function (mixed $record): bool {
            $role = data_get($record, 'role', data_get($record, 'user.role'));

            return $role !== null
                ? strtolower((string) $role) === 'alumni'
                : data_get($record, 'classroom') === null;
        }));
    }

    private function countRecords(mixed $payload): int
    {
        foreach (['data', 'students', 'teachers', 'results'] as $key) {
            $records = data_get($payload, $key);

            if (is_array($records) && array_is_list($records)) {
                return count($records);
            }
        }

        return is_array($payload) && array_is_list($payload) ? count($payload) : 0;
    }
}
