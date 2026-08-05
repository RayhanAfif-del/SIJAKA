<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // Urutan wajib: master data dulu (admin, mitra), baru data yang punya foreign key (lowongan, artikel)
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            MitraSeeder::class,
            LowonganSeeder::class,
            ArtikelSeeder::class,
            GaleriSeeder::class,
            ProfilBkkSeeder::class,
            StrukturOrganisasiSeeder::class,
            KontakSeeder::class,
            AlumniSeeder::class,
        ]);
    }
}
