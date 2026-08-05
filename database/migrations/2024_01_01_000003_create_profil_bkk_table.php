<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Tabel singleton: hanya akan diisi 1 baris (id = 1) lewat seeder.
    public function up(): void
    {
        Schema::create('profil_bkk', function (Blueprint $table) {
            $table->id();
            $table->text('profil')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_bkk');
    }
};
