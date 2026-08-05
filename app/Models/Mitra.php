<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mitra extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'mitra';

    protected $fillable = [
        'nama_perusahaan',
        'email',
        'password',
        'logo',
        'deskripsi',
        'website',
        'alamat',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function lowongan()
    {
        return $this->hasMany(Lowongan::class, 'id_mitra');
    }

    public function lowonganAktif()
    {
        return $this->lowongan()->where('status', 'disetujui');
    }
}
