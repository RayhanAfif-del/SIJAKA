<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE alumni MODIFY COLUMN status ENUM('Bekerja', 'Berwirausaha', 'Belum Bekerja', 'Melanjutkan Studi') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("UPDATE alumni SET status = 'Bekerja' WHERE status = 'Berwirausaha'");
        DB::statement("ALTER TABLE alumni MODIFY COLUMN status ENUM('Bekerja', 'Belum Bekerja', 'Melanjutkan Studi') NOT NULL");
    }
};
