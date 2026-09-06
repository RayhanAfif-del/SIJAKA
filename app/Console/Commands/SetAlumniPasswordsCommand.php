<?php

namespace App\Console\Commands;

use App\Models\Alumni;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class SetAlumniPasswordsCommand extends Command
{
    protected $signature = 'alumni:set-passwords {--force : Timpa password meskipun alumni sudah memiliki password} {--password=password : Nilai password default}';

    protected $description = 'Set password login seluruh alumni menggunakan data password dari SiPintu';

    public function handle(): int
    {
        $force = (bool) $this->option('force');
        $rawPassword = (string) $this->option('password');

        $query = Alumni::query()->whereNotNull('nis')->where('nis', '!=', '');
        if (! $force) {
            $query->whereNull('password');
        }

        $total = $query->count();

        if ($total === 0) {
            $this->info('Tidak ada data alumni yang perlu diperbarui passwordnya.');

            return Command::SUCCESS;
        }

        $this->info("Menyiapkan pembaruan password untuk {$total} alumni ke '{$rawPassword}'...");
        
        $hashed = Hash::make($rawPassword);
        $updated = $query->update(['password' => $hashed]);

        $this->info("Berhasil memperbarui password {$updated} alumni ke '{$rawPassword}'.");

        return Command::SUCCESS;
    }
}
