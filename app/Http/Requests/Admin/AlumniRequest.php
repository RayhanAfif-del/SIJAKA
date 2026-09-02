<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AlumniRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:150'],
            'jurusan' => ['required', 'string', 'max:150'],
            'tahun_lulus' => ['required', 'digits:4'],
            'status' => ['required', 'in:Bekerja,Berwirausaha,Belum Bekerja,Melanjutkan Studi'],
        ];
    }
}
