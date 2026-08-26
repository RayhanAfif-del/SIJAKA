<x-layouts.public title="Statistik Alumni">

    <section class="bg-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <h1 class="text-3xl font-bold mb-2">Statistik Penyerapan Alumni</h1>
            <p class="text-blue-200 text-sm max-w-2xl">Data capaian penyerapan tenaga kerja alumni SMK N 1 Bangsri dari tahun ke tahun.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-14">
@php $totalAlumniStat = $bekerja + $melanjutkanStudi + $belumBekerja; @endphp

        <div class="grid sm:grid-cols-3 gap-6 mb-12">
            <div class="bg-white border border-gray-100 rounded-xl p-6 text-center">
                <p class="text-3xl font-bold text-gray-800">{{ $totalAlumniStat }}</p>
                <p class="text-sm text-gray-400 mt-1">Total Alumni Terdata</p>
            </div>
            <div class="bg-blue-50 rounded-xl p-6 text-center">
                <p class="text-3xl font-bold text-blue-700">{{ $bekerja }}</p>
                <p class="text-sm text-gray-500 mt-1">Sudah Bekerja ({{ $totalAlumniStat ? round($bekerja / $totalAlumniStat * 100) : 0 }}%)</p>
            </div>
            <div class="bg-amber-50 rounded-xl p-6 text-center">
                <p class="text-3xl font-bold text-amber-600">{{ $melanjutkanStudi }}</p>
                <p class="text-sm text-gray-500 mt-1">Melanjutkan Studi ({{ $totalAlumniStat ? round($melanjutkanStudi / $totalAlumniStat * 100) : 0 }}%)</p>
            </div>
        </div>

        <h2 class="font-semibold text-blue-900 mb-5">Rincian per Tahun Kelulusan</h2>
        <div class="bg-white border border-gray-100 rounded-xl divide-y divide-gray-100">
            @forelse ($perTahun as $tahun => $rows)
                @php
$tBekerja = $rows->firstWhere('status', 'Bekerja')->total ?? 0;
                    $tStudi = $rows->firstWhere('status', 'Melanjutkan Studi')->total ?? 0;
                    $tTotal = $tBekerja + $tStudi;
                    $persen = $tTotal ? round($tBekerja / $tTotal * 100) : 0;
                @endphp
                <div class="p-5">
                    <div class="flex items-center justify-between mb-2">
                        <p class="font-medium text-gray-700 text-sm">Angkatan {{ $tahun }}</p>
                        <p class="text-xs text-gray-400">{{ $tBekerja }} dari {{ $tTotal }} bekerja ({{ $persen }}%)</p>
                    </div>
                    <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-600 rounded-full" style="width: {{ $persen }}%"></div>
                    </div>
                </div>
            @empty
                <p class="p-5 text-sm text-gray-400 text-center">Data statistik belum tersedia.</p>
            @endforelse
        </div>
    </section>

</x-layouts.public>
