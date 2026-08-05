<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ProfilBkk;

class ProfilController extends Controller
{
    public function index()
    {
        return view('public.profil.index', [
            'profilBkk' => ProfilBkk::singleton(),
        ]);
    }
}
