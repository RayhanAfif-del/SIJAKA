<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\PengaturanWebsite;
use Illuminate\Support\Facades\DB;

class StatistikController extends Controller
{
    public function index()
    {
        $bekerja = Alumni::bekerja()->count() + Alumni::belumBekerja()->count();
        $berwirausaha = Alumni::berwirausaha()->count();
        $melanjutkanStudi = Alumni::melanjutkanStudi()->count();

        $perTahun = Alumni::selectRaw("
                tahun_lulus,
                CASE WHEN status = 'Belum Bekerja' THEN 'Bekerja' ELSE status END as status,
                COUNT(*) as total
            ")
            ->groupByRaw("tahun_lulus, CASE WHEN status = 'Belum Bekerja' THEN 'Bekerja' ELSE status END")
            ->orderBy('tahun_lulus')
            ->get()
            ->groupBy('tahun_lulus');

        return view('public.statistik.index', [
            'bekerja' => $bekerja,
            'berwirausaha' => $berwirausaha,
            'melanjutkanStudi' => $melanjutkanStudi,
            'perTahun' => $perTahun,
            'pengaturanWebsite' => PengaturanWebsite::singleton(),
        ]);
    }
}
