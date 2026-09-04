<?php

namespace App\Http\Requests\Alumni;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'headline' => ['nullable', 'string', 'max:150'],
            'ringkasan' => ['nullable', 'string', 'max:3000'],
            'keahlian' => ['nullable', 'string', 'max:1000'],
            'portfolio_url' => ['nullable', 'url', 'max:255'],
            'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'portfolio' => ['nullable', 'file', 'mimes:pdf,zip', 'max:10240'],
            'is_visible' => ['nullable', 'boolean'],
        ];
    }
}
