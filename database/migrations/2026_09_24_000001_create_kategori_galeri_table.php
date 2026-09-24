<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_galeri', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // Kategori awal yang ada di sistem
        $defaultCategories = [
            'Workshop',
            'Seminar',
            'Kunjungan Industri',
            'Job Fair',
            'Training',
            'Sosialisasi',
            'Kegiatan Sekolah',
            'Kerja Sama',
            'Kegiatan Lain',
        ];

        // Ambil juga kategori yang sudah tersimpan di tabel galeri
        if (Schema::hasTable('galeri')) {
            $existingFromGaleri = DB::table('galeri')
                ->whereNotNull('kategori')
                ->where('kategori', '!=', '')
                ->distinct()
                ->pluck('kategori')
                ->toArray();

            $defaultCategories = array_unique(array_merge($defaultCategories, $existingFromGaleri));
        }

        foreach ($defaultCategories as $nama) {
            $nama = trim($nama);
            if ($nama === '') {
                continue;
            }

            DB::table('kategori_galeri')->insertOrIgnore([
                'nama' => $nama,
                'slug' => Str::slug($nama),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_galeri');
    }
};
