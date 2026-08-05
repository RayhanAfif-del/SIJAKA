<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MitraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $mitraId = $this->route('mitra')?->id;

        return [
            'nama_perusahaan' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', Rule::unique('mitra', 'email')->ignore($mitraId)],
            // password hanya wajib saat membuat akun baru
            'password' => [$mitraId ? 'nullable' : 'required', 'min:8'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'deskripsi' => ['nullable', 'string'],
            'website' => ['nullable', 'url', 'max:255'],
            'alamat' => ['nullable', 'string'],
        ];
    }
}
