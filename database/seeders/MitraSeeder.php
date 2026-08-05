<?php

namespace Database\Seeders;

use App\Models\Mitra;
use Illuminate\Database\Seeder;

class MitraSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_perusahaan' => 'PT Astra International Tbk', 'email' => 'hrd@astra.co.id', 'website' => 'https://www.astra.co.id/karir', 'deskripsi' => 'Perusahaan otomotif dan multi-industri terbesar di Indonesia.', 'alamat' => 'Jl. Gaya Motor No.8, Sunter II, Jakarta Utara 14330'],
            ['nama_perusahaan' => 'PT Mayora Indah Tbk', 'email' => 'recruitment@mayora.co.id', 'website' => 'https://www.mayoraindah.co.id', 'deskripsi' => 'Produsen makanan dan minuman olahan terkemuka.', 'alamat' => 'Semarang, Jawa Tengah'],
            ['nama_perusahaan' => 'PT Wings Surya', 'email' => 'karir@wings.co.id', 'website' => 'https://www.wings.co.id', 'deskripsi' => 'Perusahaan consumer goods nasional.', 'alamat' => 'Sukoharjo, Jawa Tengah'],
            ['nama_perusahaan' => 'PT Yamaha Indonesia Motor Mfg.', 'email' => 'hrd@yamaha-motor.co.id', 'website' => 'https://www.yamaha-motor.co.id', 'deskripsi' => 'Produsen sepeda motor dan mesin Yamaha untuk pasar Indonesia.', 'alamat' => 'Jakarta, DKI Jakarta'],
            ['nama_perusahaan' => 'PT Indofood Sukses Makmur Tbk', 'email' => 'recruitment@indofood.co.id', 'website' => 'https://www.indofood.com', 'deskripsi' => 'Perusahaan makanan terintegrasi terbesar di Indonesia.', 'alamat' => 'Semarang, Jawa Tengah'],
            ['nama_perusahaan' => 'PT Denso Indonesia', 'email' => 'hrd@denso.co.id', 'website' => 'https://www.denso.com/id', 'deskripsi' => 'Produsen komponen otomotif kelas dunia.', 'alamat' => 'Bekasi, Jawa Barat'],
        ];

        foreach ($data as $mitra) {
            Mitra::firstOrCreate(
                ['email' => $mitra['email']],
                array_merge($mitra, ['password' => 'password'])
            );
        }
    }
}
