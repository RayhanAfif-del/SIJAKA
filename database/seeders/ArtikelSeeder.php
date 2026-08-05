<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Artikel;
use Illuminate\Database\Seeder;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::first();

        $data = [
            ['judul' => '5 Soft Skill yang Dibutuhkan Dunia Kerja', 'kategori' => 'Soft Skill', 'konten' => 'Soft skill penting yang perlu kamu kuasai agar dapat bersaing dan berkembang di dunia kerja modern.'],
            ['judul' => 'Mengenal Dunia Industri Sebelum Lulus Sekolah', 'kategori' => 'Dunia Kerja', 'konten' => 'Kenali dunia industri lebih awal agar kamu siap menghadapi tantangan dan peluang di masa depan.'],
            ['judul' => 'Etika Berkomunikasi di Tempat Kerja', 'kategori' => 'Dunia Kerja', 'konten' => 'Komunikasi yang baik adalah kunci hubungan kerja yang harmonis dan produktif.'],
            ['judul' => 'Tips Membuat CV yang Menarik dan Profesional', 'kategori' => 'Tips Karier', 'konten' => 'CV yang baik adalah langkah awal untuk mendapatkan panggilan interview.'],
            ['judul' => 'Persiapan Sebelum Interview Kerja Agar Lebih Percaya Diri', 'kategori' => 'Interview', 'konten' => 'Persiapan yang matang akan meningkatkan kepercayaan diri dan peluang kamu diterima di perusahaan impian.'],
            ['judul' => 'Cara Menjadi Karyawan Profesional di Tempat Kerja', 'kategori' => 'Karier', 'konten' => 'Menjadi karyawan profesional bukan hanya tentang bekerja keras, tetapi juga bekerja dengan cara yang tepat.'],
        ];

        foreach ($data as $item) {
            Artikel::firstOrCreate(
                ['judul' => $item['judul']],
                array_merge($item, ['admin_id' => $admin?->id])
            );
        }
    }
}
