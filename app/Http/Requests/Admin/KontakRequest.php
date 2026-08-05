<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class KontakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'alamat' => ['required', 'string'],
            'email' => ['required', 'email'],
            'telepon' => ['required', 'string', 'max:30'],
            'jam_operasional' => ['nullable', 'string', 'max:100'],
            'instagram' => ['nullable', 'url'],
            'facebook' => ['nullable', 'url'],
            'youtube' => ['nullable', 'url'],
        ];
    }
}
