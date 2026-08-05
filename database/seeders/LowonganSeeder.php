<?php

namespace Database\Seeders;

use App\Models\Lowongan;
use App\Models\Mitra;
use Illuminate\Database\Seeder;

class LowonganSeeder extends Seeder
{
    public function run(): void
    {
        $astra = Mitra::where('email', 'hrd@astra.co.id')->first();
        $mayora = Mitra::where('email', 'recruitment@mayora.co.id')->first();
        $wings = Mitra::where('email', 'karir@wings.co.id')->first();
        $yamaha = Mitra::where('email', 'hrd@yamaha-motor.co.id')->first();
        $indofood = Mitra::where('email', 'recruitment@indofood.co.id')->first();

        $data = [
            ['id_mitra' => $astra->id, 'posisi' => 'Operator Produksi', 'lokasi' => 'Karawang, Jawa Barat', 'unggulan' => false, 'status' => 'disetujui'],
            ['id_mitra' => $mayora->id, 'posisi' => 'Staff Gudang', 'lokasi' => 'Semarang, Jawa Tengah', 'unggulan' => true, 'status' => 'disetujui'],
            ['id_mitra' => $wings->id, 'posisi' => 'Administrasi', 'lokasi' => 'Sukoharjo, Jawa Tengah', 'unggulan' => false, 'status' => 'disetujui'],
            ['id_mitra' => $yamaha->id, 'posisi' => 'Technical Support', 'lokasi' => 'Jakarta, DKI Jakarta', 'unggulan' => false, 'status' => 'disetujui'],
            ['id_mitra' => $indofood->id, 'posisi' => 'Quality Control', 'lokasi' => 'Semarang, Jawa Tengah', 'unggulan' => false, 'status' => 'disetujui'],
            ['id_mitra' => $astra->id, 'posisi' => 'Teknisi Lapangan', 'lokasi' => 'Karawang, Jawa Barat', 'unggulan' => false, 'status' => 'menunggu'],
        ];

        foreach ($data as $item) {
            Lowongan::firstOrCreate(
                ['id_mitra' => $item['id_mitra'], 'posisi' => $item['posisi']],
                array_merge($item, [
                    'jenis_pekerjaan' => 'Full Time',
                    'gaji' => 'Sesuai UMR + Tunjangan',
                    'deskripsi' => 'Bertanggung jawab menjalankan proses kerja sesuai standar perusahaan dan mendukung tercapainya target secara efektif dan aman.',
                    'persyaratan' => "Pendidikan minimal SMK sederajat.\nUsia maksimal 25 tahun.\nSehat jasmani dan rohani.\nMampu bekerja dalam tim.",
                    'cara_melamar' => 'Kirimkan lamaran melalui email atau website resmi perusahaan.',
                    'deadline' => now()->addMonths(2),
                    'jumlah_kunjungan' => rand(50, 1300),
                ])
            );
        }
    }
}
