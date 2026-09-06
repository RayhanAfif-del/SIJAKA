<?php

namespace App\Console\Commands;

use App\Services\SipintuAlumniSyncService;
use Illuminate\Console\Command;

class SyncSipintuAlumniCommand extends Command
{
    protected $signature = 'sipintu:sync-alumni {--clear-dummy : Hapus data dummy alumni sebelum sinkronisasi}';

    protected $description = 'Sinkronisasi data alumni dari SiPintu API Gateway (khusus classroom = null)';

    public function handle(SipintuAlumniSyncService $syncService): int
    {
        $this->info('Memulai sinkronisasi data alumni dari SiPintu API...');

        try {
            $result = $syncService->sync(deleteDummy: true);
            $this->info("Berhasil menyinkronkan {$result['synced']} data alumni dari {$result['total_received']} data siswa dengan classroom = null.");

            return Command::SUCCESS;
        } catch (\Throwable $e) {
            $this->error('Gagal menyinkronkan data alumni: ' . $e->getMessage());

            return Command::FAILURE;
        }
    }
}
