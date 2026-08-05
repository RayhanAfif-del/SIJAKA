<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE alumni MODIFY COLUMN status ENUM('Bekerja', 'Belum Bekerja', 'Melanjutkan Studi') NOT NULL");
    }

    public function down(): void
    {
        // Kembalikan ke enum sebelumnya (data 'Melanjutkan Studi' dikonversi ke 'Belum Bekerja')
        DB::statement("UPDATE alumni SET status = 'Belum Bekerja' WHERE status = 'Melanjutkan Studi'");
        DB::statement("ALTER TABLE alumni MODIFY COLUMN status ENUM('Bekerja', 'Belum Bekerja') NOT NULL");
    }
};
