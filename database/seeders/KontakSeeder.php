<?php

namespace Database\Seeders;

use App\Models\Kontak;
use Illuminate\Database\Seeder;

class KontakSeeder extends Seeder
{
    public function run(): void
    {
        Kontak::updateOrCreate(['id' => 1], [
            'alamat' => 'Jl. KH Achmad Fauzan No.17, Krasak, Bangsri, Jepara, Jawa Tengah',
            'email' => 'sijaka@smkn1bangsri.sch.id',
            'telepon' => '+62 857 1259 5555',
            'jam_operasional' => 'Senin - Jumat (08.00 - 16.00)',
            'instagram' => 'https://instagram.com/smkn1bangsri',
            'facebook' => 'https://facebook.com/smkn1bangsri',
            'youtube' => 'https://youtube.com/@smkn1bangsri',
        ]);
    }
}
