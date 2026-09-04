<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewRequest extends Model
{
    protected $fillable = [
        'alumni_id', 'mitra_id', 'lowongan_id', 'message', 'status',
        'response_note', 'proposed_at',
    ];

    protected function casts(): array
    {
        return ['proposed_at' => 'datetime'];
    }

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }
}
