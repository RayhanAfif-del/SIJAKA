<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KategoriGaleri extends Model
{
    use HasFactory;

    protected $table = 'kategori_galeri';

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
    ];

    protected static function booted(): void
    {
        static::saving(function (KategoriGaleri $kategori) {
            if (empty($kategori->slug) || $kategori->isDirty('nama')) {
                $kategori->slug = Str::slug($kategori->nama);
            }
        });
    }

    public function galeri()
    {
        return $this->hasMany(Galeri::class, 'kategori', 'nama');
    }
}
