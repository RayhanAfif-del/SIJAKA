<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        return view('public.struktur-organisasi.index', [
            // Global scope di model sudah orderBy('urutan')
            'struktur' => StrukturOrganisasi::all(),
        ]);
    }
}
