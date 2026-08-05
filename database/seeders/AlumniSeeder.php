<?php

namespace Database\Seeders;

use App\Models\Alumni;
use Illuminate\Database\Seeder;

class AlumniSeeder extends Seeder
{
public function run(): void
    {
        Alumni::factory()->count(1000)->create();

        // Konversi sebagian status 'Belum Bekerja' menjadi 'Melanjutkan Studi'
        Alumni::where('status', 'Belum Bekerja')
            ->inRandomOrder()
            ->limit(200)
            ->update(['status' => 'Melanjutkan Studi']);
    }
}
