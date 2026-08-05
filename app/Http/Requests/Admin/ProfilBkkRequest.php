<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfilBkkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'profil' => ['required', 'string'],
            'visi' => ['required', 'string'],
            'misi' => ['required', 'string'],
        ];
    }
}
