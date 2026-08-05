<?php

namespace Database\Seeders;

use App\Models\ProfilBkk;
use Illuminate\Database\Seeder;

class ProfilBkkSeeder extends Seeder
{
    public function run(): void
    {
        ProfilBkk::updateOrCreate(['id' => 1], [
            'profil' => 'SIJAKA (Sistem Informasi Jejaring Karier) merupakan platform digital yang dikelola oleh BKK SMK N 1 Bangsri untuk menyediakan layanan informasi karier dan lowongan kerja.',
            'visi' => 'Menjadi platform layanan karier yang profesional, terpercaya, dan inovatif dalam menghubungkan pencari kerja dengan dunia usaha dan dunia industri.',
            'misi' => "Menyediakan informasi lowongan kerja yang akurat dan selalu diperbarui.\nMempermudah akses layanan karier bagi pencari kerja dan perusahaan.\nMenjalin kerja sama dengan dunia usaha dan industri.\nMendukung pengembangan kompetensi dan kesiapan kerja.",
        ]);
    }
}
