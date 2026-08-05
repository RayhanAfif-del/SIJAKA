<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mitra')->constrained('mitra')->cascadeOnDelete();
            $table->string('posisi');
            $table->string('lokasi');
            $table->enum('jenis_pekerjaan', ['Full Time', 'Part Time', 'Magang', 'Kontrak']);
            $table->string('gaji')->nullable();
            $table->text('deskripsi');
            $table->text('persyaratan');
            $table->text('cara_melamar');
            $table->date('deadline');
            $table->boolean('unggulan')->default(false);
            $table->unsignedInteger('jumlah_kunjungan')->default(0);
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak', 'kadaluarsa'])->default('menunggu');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'unggulan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lowongan');
    }
};
