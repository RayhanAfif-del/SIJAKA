<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilBkk extends Model
{
    protected $table = 'profil_bkk';

    protected $fillable = [
        'gambar',
        'profil',
        'visi',
        'misi',
    ];

    // Selalu kembalikan baris tunggal (buat kalau belum ada)
    public static function singleton(): self
    {
        return self::firstOrCreate(['id' => 1]);
    }
}
