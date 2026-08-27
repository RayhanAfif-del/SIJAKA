<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Support\Facades\DB;

class StatistikController extends Controller
{
    public function index()
    {
        $bekerja = Alumni::bekerja()->count();
        $belumBekerjaCount = Alumni::belumBekerja()->count();
        $melanjutkanStudi = Alumni::melanjutkanStudi()->count() + $belumBekerjaCount;

        $perTahun = Alumni::selectRaw("
                tahun_lulus,
                CASE WHEN status = 'Belum Bekerja' THEN 'Melanjutkan Studi' ELSE status END as status,
                COUNT(*) as total
            ")
            ->groupByRaw("tahun_lulus, CASE WHEN status = 'Belum Bekerja' THEN 'Melanjutkan Studi' ELSE status END")
            ->orderBy('tahun_lulus')
            ->get()
            ->groupBy('tahun_lulus');

        return view('public.statistik.index', compact('bekerja', 'melanjutkanStudi', 'perTahun'));
    }
}
