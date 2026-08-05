<?php

namespace Database\Seeders;

use App\Models\StrukturOrganisasi;
use Illuminate\Database\Seeder;

class StrukturOrganisasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Drs. Ahmad Fauzan', 'jabatan' => 'Kepala Sekolah', 'urutan' => 1],
            ['nama' => 'Siti Rahayu, S.Pd', 'jabatan' => 'Ketua BKK', 'urutan' => 2],
            ['nama' => 'Budi Santoso, S.Kom', 'jabatan' => 'Sekretaris BKK', 'urutan' => 3],
            ['nama' => 'Dewi Anggraini, S.E', 'jabatan' => 'Humas & Kerja Sama Industri', 'urutan' => 4],
        ];

        foreach ($data as $item) {
            StrukturOrganisasi::firstOrCreate(
                ['nama' => $item['nama']],
                array_merge($item, ['foto' => 'struktur/placeholder.jpg'])
            );
        }
    }
}
