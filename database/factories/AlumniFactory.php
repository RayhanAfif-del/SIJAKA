<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AlumniFactory extends Factory
{
    protected $model = \App\Models\Alumni::class;

    public function definition(): array
    {
        $jurusan = ['Teknik Kendaraan Ringan', 'Rekayasa Perangkat Lunak', 'Akuntansi', 'Tata Boga', 'Multimedia', 'Teknik Elektronika'];

        return [
            'nama' => fake()->name(),
            'jurusan' => fake()->randomElement($jurusan),
            'tahun_lulus' => fake()->numberBetween(2022, 2026),
'status' => fake()->randomElement(['Bekerja', 'Bekerja', 'Bekerja', 'Melanjutkan Studi', 'Melanjutkan Studi', 'Belum Bekerja']), // bobot ~50% bekerja, ~33% study, ~17% belum
        ];
    }
}
