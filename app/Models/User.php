<?php

namespace App\Models;

class User extends Alumni
{
    protected $table = 'alumni';

    protected $fillable = [
        'nama',
        'name',
        'nis',
        'external_id',
        'jurusan',
        'classroom',
        'tahun_lulus',
        'status',
        'email',
        'password',
        'phone',
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
        'sipintu_last_synced_at',
    ];
}
