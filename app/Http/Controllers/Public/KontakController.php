<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Kontak;

class KontakController extends Controller
{
    public function index()
    {
        return view('public.kontak.index', [
            'kontak' => Kontak::singleton(),
        ]);
    }
}
