<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Alumni extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'alumni';

    protected $fillable = [
        'nama',
        'nis',
        'jurusan',
        'tahun_lulus',
        'status',
        'email',
        'password',
        'headline',
        'ringkasan',
        'keahlian',
        'portfolio_url',
        'cv_path',
        'portfolio_path',
        'is_visible',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_visible' => 'boolean',
        ];
    }

    public function interviewRequests()
    {
        return $this->hasMany(InterviewRequest::class);
    }

    public function scopeBekerja(Builder $query): Builder
    {
        return $query->where('status', 'Bekerja');
    }

    public function scopeBerwirausaha(Builder $query): Builder
    {
        return $query->where('status', 'Berwirausaha');
    }

    public function scopeBelumBekerja(Builder $query): Builder
    {
        return $query->where('status', 'Belum Bekerja');
    }

    public function scopeMelanjutkanStudi(Builder $query): Builder
    {
        return $query->where('status', 'Melanjutkan Studi');
    }
}
