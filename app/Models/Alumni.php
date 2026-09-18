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
        'foto_path',
        'headline',
        'ringkasan',
        'keahlian',
        'portfolio_url',
        'linkedin_url',
        'instagram_url',
        'tiktok_url',
        'cv_path',
        'portfolio_path',
        'is_visible',
        'talent_approval_status',
        'phone',
        'classroom',
        'sipintu_last_synced_at',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_visible' => 'boolean',
            'sipintu_last_synced_at' => 'datetime',
        ];
    }

    public function getNameAttribute(): ?string
    {
        return $this->nama;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['nama'] = $value;
    }

    public function getExternalIdAttribute(): ?string
    {
        return $this->nis;
    }

    public function setExternalIdAttribute(?string $value): void
    {
        $this->attributes['nis'] = $value;
    }

    public function getRoleAttribute(): string
    {
        return 'alumni';
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
