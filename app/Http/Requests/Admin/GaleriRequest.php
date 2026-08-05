<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GaleriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:100'],
            'tanggal' => ['required', 'date'],
            'foto' => [$this->isMethod('post') ? 'required' : 'nullable', 'image', 'max:2048'],
        ];
    }
}
