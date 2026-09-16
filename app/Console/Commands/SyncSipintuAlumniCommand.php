<?php

namespace App\Console\Commands;

use App\Services\SipintuAlumniSyncService;
use Illuminate\Console\Command;

class SyncSipintuAlumniCommand extends Command
{
    protected $signature = 'sipintu:sync-alumni {--clear-dummy : Hapus data dummy alumni sebelum sinkronisasi}';

    protected $description = 'Sinkronisasi data alumni dari SiPintu API Gateway (khusus graduated = true)';

    public function handle(SipintuAlumniSyncService $syncService): int
    {
        $this->info('Memulai sinkronisasi data alumni dari SiPintu API (graduated = true)...');

        try {
            $result = $syncService->sync(deleteDummy: true);
            $this->info("Berhasil menyinkronkan {$result['synced']} data alumni dari {$result['total_received']} data siswa dengan status graduated = true.");

            return Command::SUCCESS;
        } catch (\Throwable $e) {
            $this->error('Gagal menyinkronkan data alumni: ' . $e->getMessage());

            return Command::FAILURE;
        }
    }
}
