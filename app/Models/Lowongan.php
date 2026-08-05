<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Lowongan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lowongan';

    protected $fillable = [
        'id_mitra',
        'posisi',
        'lokasi',
        'jenis_pekerjaan',
        'gaji',
        'deskripsi',
        'persyaratan',
        'cara_melamar',
        'deadline',
        'unggulan',
        'jumlah_kunjungan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
            'unggulan' => 'boolean',
            'jumlah_kunjungan' => 'integer',
        ];
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra');
    }

    // Scope: hanya lowongan yang sudah disetujui admin & tampil di publik
    public function scopeDisetujui(Builder $query): Builder
    {
        return $query->where('status', 'disetujui');
    }

    // Scope: lowongan unggulan untuk section Beranda
    public function scopeUnggulan(Builder $query): Builder
    {
        return $query->where('unggulan', true);
    }

    public function scopeMenunggu(Builder $query): Builder
    {
        return $query->where('status', 'menunggu');
    }

    public function isKadaluarsa(): bool
    {
        return $this->deadline->isPast();
    }

    public function tambahKunjungan(): void
    {
        $this->increment('jumlah_kunjungan');
    }
}
