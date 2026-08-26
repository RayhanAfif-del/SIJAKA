<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $table = 'kontak';

    protected $fillable = [
        'alamat',
        'email',
        'telepon',
        'jam_operasional',
        'instagram',
        'facebook',
        'youtube',
    ];

    public static function singleton(): self
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'alamat' => '',
                'email' => '',
                'telepon' => '',
                'jam_operasional' => '',
                'instagram' => '',
                'facebook' => '',
                'youtube' => '',
            ]
        );
    }
}
