<?php

namespace App\Policies;

use App\Models\Lowongan;
use App\Models\Mitra;

class LowonganPolicy
{
    // Mitra hanya boleh mengelola lowongan miliknya sendiri
    public function update(Mitra $mitra, Lowongan $lowongan): bool
    {
        return $mitra->id === $lowongan->id_mitra;
    }

    public function delete(Mitra $mitra, Lowongan $lowongan): bool
    {
        return $mitra->id === $lowongan->id_mitra;
    }

    public function view(Mitra $mitra, Lowongan $lowongan): bool
    {
        return $mitra->id === $lowongan->id_mitra;
    }
}
