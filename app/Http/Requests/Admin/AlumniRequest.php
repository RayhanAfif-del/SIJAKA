<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlumniRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $alumniId = $this->route('alumnus')?->id;

        return [
            'nama' => ['required', 'string', 'max:150'],
            'email' => ['nullable', 'email', Rule::unique('alumni', 'email')->ignore($alumniId)],
            'password' => [$alumniId ? 'nullable' : 'nullable', 'string', 'min:8'],
            'jurusan' => ['required', 'string', 'max:150'],
            'tahun_lulus' => ['required', 'digits:4'],
            'status' => ['required', 'in:Bekerja,Berwirausaha,Belum Bekerja,Melanjutkan Studi'],
        ];
    }
}
