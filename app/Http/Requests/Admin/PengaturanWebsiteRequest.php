<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PengaturanWebsiteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'site_name' => ['required', 'string', 'max:255'],
            'site_tagline' => ['required', 'string', 'max:255'],
            'hero_badge' => ['required', 'string', 'max:255'],
            'hero_title_prefix' => ['required', 'string', 'max:255'],
            'hero_title_highlight' => ['required', 'string', 'max:255'],
            'hero_title_suffix' => ['required', 'string', 'max:255'],
            'hero_description' => ['required', 'string', 'max:1000'],
            'hero_primary_label' => ['required', 'string', 'max:255'],
            'hero_primary_url' => ['required', 'string', 'max:255'],
            'hero_secondary_label' => ['required', 'string', 'max:255'],
            'hero_secondary_url' => ['required', 'string', 'max:255'],
            'footer_text' => ['required', 'string', 'max:1000'],
        ];
    }
}
