<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::firstOrCreate(
            ['email' => 'admin@smkn1bangsri.sch.id'],
            ['name' => 'Admin SIJAKA', 'password' => 'password']
        );
    }
}
