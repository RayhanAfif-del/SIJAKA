<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StrukturOrganisasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:150'],
            'jabatan' => ['required', 'string', 'max:150'],
            'urutan' => ['required', 'integer', 'min:0'],
            'foto' => [$this->isMethod('post') ? 'nullable' : 'nullable', 'image', 'max:2048'],
        ];
    }
}
