<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanWebsite extends Model
{
    protected $table = 'pengaturan_website';

    protected $fillable = [
        'site_name',
        'site_tagline',
        'site_icon',
        'hero_image',
        'hero_badge',
        'hero_title_prefix',
        'hero_title_highlight',
        'hero_title_suffix',
        'hero_description',
        'hero_primary_label',
        'hero_primary_url',
        'hero_secondary_label',
        'hero_secondary_url',
        'footer_text',
    ];

    public static function singleton(): self
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Sistem Informasi Jejaring Karier',
                'site_tagline' => 'SMK N 1 Bangsri',
                'site_icon' => null,
                'hero_image' => null,
                'hero_badge' => 'BKK SMKN 1 Bangsri',
                'hero_title_prefix' => 'Jembatan Karier',
                'hero_title_highlight' => 'untuk Masa Depan',
                'hero_title_suffix' => 'Gemilang',
                'hero_description' => 'Kami siap membantu siswa, alumni, dan masyarakat dalam mendapatkan informasi dunia kerja terkini dan peluang karier terbaik.',
                'hero_primary_label' => 'Lihat Lowongan',
                'hero_primary_url' => '/lowongan',
                'hero_secondary_label' => 'Tentang BKK',
                'hero_secondary_url' => '/profil',
                'footer_text' => 'SIJAKA SMK N 1 Bangsri berkomitmen menjadi jembatan karier terbaik antara dunia pendidikan dan dunia kerja.',
            ]
        );
    }
}
