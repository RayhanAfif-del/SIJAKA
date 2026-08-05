<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    protected $table = 'struktur_organisasi';

    protected $fillable = [
        'foto',
        'nama',
        'jabatan',
        'urutan',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('urutan', function ($query) {
            $query->orderBy('urutan');
        });
    }
}
