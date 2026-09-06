<?php

namespace Database\Seeders;

use App\Models\Alumni;
use App\Services\SipintuAlumniSyncService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class AlumniSeeder extends Seeder
{
    public function run(SipintuAlumniSyncService $syncService): void
    {
        // Hapus data dummy alumni
        Alumni::whereNull('nis')->orWhere('nis', '')->delete();

        try {
            $result = $syncService->sync(deleteDummy: true);
            $this->command?->info("AlumniSeeder: Berhasil menyinkronkan {$result['synced']} data alumni dari SiPintu API (classroom = null).");
        } catch (\Throwable $e) {
            Log::warning('AlumniSeeder gagal menyinkronkan data SiPintu: ' . $e->getMessage());
            $this->command?->warn("AlumniSeeder: Gagal menyinkronkan dari SiPintu API ({$e->getMessage()}). Data dummy tetap dibersihkan.");
        }
    }
}
