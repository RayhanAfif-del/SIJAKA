<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';

    protected $fillable = [
        'nama',
        'jurusan',
        'tahun_lulus',
        'status',
    ];

    public function scopeBekerja(Builder $query): Builder
    {
        return $query->where('status', 'Bekerja');
    }

    public function scopeBelumBekerja(Builder $query): Builder
    {
        return $query->where('status', 'Belum Bekerja');
    }
}
