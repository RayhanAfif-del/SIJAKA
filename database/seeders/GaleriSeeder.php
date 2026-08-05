<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['judul' => 'Pembekalan Karier untuk Siswa', 'kategori' => 'Kegiatan Sekolah', 'tanggal' => '2024-05-20'],
            ['judul' => 'Penandatanganan MoU dengan PT Sinar Abadi', 'kategori' => 'Kerja Sama & MoU', 'tanggal' => '2024-05-15'],
            ['judul' => 'Kunjungan Industri ke PT Astra International', 'kategori' => 'Kunjungan Industri', 'tanggal' => '2024-04-10'],
            ['judul' => 'Job Fair SMK N 1 Bangsri 2024', 'kategori' => 'Lainnya', 'tanggal' => '2024-03-05'],
            ['judul' => 'Pelatihan Membuat CV & Portofolio', 'kategori' => 'Pelatihan', 'tanggal' => '2024-02-28'],
            ['judul' => 'Serah Terima Karyawan dari Mitra Industri', 'kategori' => 'Kerja Sama & MoU', 'tanggal' => '2024-02-20'],
            ['judul' => 'Pelatihan Soft Skill: Komunikasi Efektif', 'kategori' => 'Pelatihan', 'tanggal' => '2024-03-25'],
        ];

        foreach ($data as $item) {
            Galeri::firstOrCreate(
                ['judul' => $item['judul']],
                array_merge($item, ['foto' => 'galeri/placeholder.jpg'])
            );
        }
    }
}
