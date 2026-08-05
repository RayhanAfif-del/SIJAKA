<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Alumni;

class StatistikController extends Controller
{
    public function index()
    {
$bekerja = Alumni::bekerja()->count();
        $melanjutkanStudi = Alumni::melanjutkanStudi()->count();
        $belumBekerja = Alumni::belumBekerja()->count();

        $perTahun = Alumni::selectRaw('tahun_lulus, status, count(*) as total')
            ->groupBy('tahun_lulus', 'status')
            ->orderBy('tahun_lulus')
            ->get()
            ->groupBy('tahun_lulus');

        return view('public.statistik.index', compact('bekerja', 'melanjutkanStudi', 'belumBekerja', 'perTahun'));
    }
}
