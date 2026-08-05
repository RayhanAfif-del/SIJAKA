<?php

namespace App\Http\Requests\Mitra;

use Illuminate\Foundation\Http\FormRequest;

class LowonganRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Kepemilikan sudah dicek lewat LowonganPolicy di controller ($this->authorize())
        return true;
    }

    public function rules(): array
    {
        return [
            'posisi' => ['required', 'string', 'max:150'],
            'lokasi' => ['required', 'string', 'max:150'],
            'jenis_pekerjaan' => ['required', 'in:Full Time,Part Time,Magang,Kontrak'],
            'gaji' => ['nullable', 'string', 'max:100'],
            'deskripsi' => ['required', 'string'],
            'persyaratan' => ['required', 'string'],
            'cara_melamar' => ['required', 'string'],
            'deadline' => ['required', 'date', 'after:today'],
        ];
    }
}
