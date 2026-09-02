<x-layouts.public title="Statistik Alumni">

    @php
        $pengaturanWebsite = $pengaturanWebsite ?? \App\Models\PengaturanWebsite::singleton();
        $heroImageUrl = $pengaturanWebsite->hero_image ? \Illuminate\Support\Facades\Storage::url($pengaturanWebsite->hero_image) : null;
        $totalAlumniStat = $bekerja + $berwirausaha + $melanjutkanStudi;
        $persenBekerja = $totalAlumniStat ? round($bekerja / $totalAlumniStat * 100) : 0;
        $persenWirausaha = $totalAlumniStat ? round($berwirausaha / $totalAlumniStat * 100) : 0;
        $persenStudi = $totalAlumniStat ? round($melanjutkanStudi / $totalAlumniStat * 100) : 0;
    @endphp

    {{-- Hero Section --}}
    <section class="relative bg-slate-900 text-white overflow-hidden">
        @if ($heroImageUrl)
            <div class="absolute inset-0">
                <img src="{{ $heroImageUrl }}" alt="Background" class="w-full h-full object-cover opacity-40">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-slate-900/90 to-slate-900/90"></div>
            </div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-slate-900 to-slate-900"></div>
        @endif
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 32px 32px;"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20" data-aos="fade-up">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-blue-200 mb-6 flex-wrap">
                <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white font-medium">Statistik Alumni</span>
            </nav>
            
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight mb-4">
                Statistik <span class="text-blue-400">Alumni</span>
            </h1>
            <p class="text-blue-100 text-lg leading-relaxed max-w-2xl">
                Data capaian penyerapan tenaga kerja alumni SMK N 1 Bangsri dari tahun ke tahun — transparan, terukur, dan terpercaya.
            </p>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">

        @if ($totalAlumniStat > 0)

            {{-- Stat Cards (Bento Grid Style) --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12" data-aos="fade-up">
                
                {{-- Total Alumni (Featured) --}}
                <div class="col-span-2 md:col-span-2 bg-gradient-to-br from-slate-900 to-slate-800 text-white rounded-2xl p-6 sm:p-8 flex flex-col justify-center relative overflow-hidden shadow-xl shadow-slate-900/20">
                    <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-blue-500/20 rounded-full blur-2xl"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-wider text-blue-200">Total Alumni</span>
                        </div>
                        <p class="text-5xl sm:text-6xl font-extrabold tracking-tight">{{ number_format($totalAlumniStat) }}</p>
                        <p class="text-blue-200 text-sm mt-2">Alumni terdata dalam sistem</p>
                    </div>
                </div>

                {{-- Bekerja --}}
                <div class="bg-white border border-gray-100 rounded-2xl p-5 sm:p-6 flex flex-col justify-between hover:border-blue-200 hover:shadow-lg transition-all duration-300 group">
                    <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ number_format($bekerja) }}</p>
                        <p class="text-xs font-semibold text-gray-500 mt-1 uppercase tracking-wide">Sudah Bekerja</p>
                        <p class="text-xs text-emerald-600 font-bold mt-1">{{ $persenBekerja }}%</p>
                    </div>
                </div>

                {{-- Berwirausaha --}}
                <div class="bg-white border border-gray-100 rounded-2xl p-5 sm:p-6 flex flex-col justify-between hover:border-violet-200 hover:shadow-lg transition-all duration-300 group">
                    <div class="w-10 h-10 bg-violet-100 text-violet-600 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m-6 4h6m-6 4h6M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ number_format($berwirausaha) }}</p>
                        <p class="text-xs font-semibold text-gray-500 mt-1 uppercase tracking-wide">Berwirausaha</p>
                        <p class="text-xs text-violet-600 font-bold mt-1">{{ $persenWirausaha }}%</p>
                    </div>
                </div>

                {{-- Melanjutkan Studi --}}
                <div class="bg-white border border-gray-100 rounded-2xl p-5 sm:p-6 flex flex-col justify-between hover:border-amber-200 hover:shadow-lg transition-all duration-300 group">
                    <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                    </div>
                    <div>
                        <p class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ number_format($melanjutkanStudi) }}</p>
                        <p class="text-xs font-semibold text-gray-500 mt-1 uppercase tracking-wide">Melanjutkan Studi</p>
                        <p class="text-xs text-amber-600 font-bold mt-1">{{ $persenStudi }}%</p>
                    </div>
                </div>
            </div>

            {{-- Charts Section --}}
            <div class="grid lg:grid-cols-3 gap-6 mb-12">
                
                {{-- Donut Chart --}}
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm" data-aos="fade-up">
                    <div class="mb-5">
                        <h3 class="text-lg font-bold text-gray-900">Distribusi Status</h3>
                        <p class="text-xs text-gray-500 mt-1">Proporsi status alumni secara keseluruhan</p>
                    </div>
                    <div class="relative w-56 h-56 mx-auto">
                        <canvas id="chartDonut"></canvas>
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                            <span class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ number_format($totalAlumniStat) }}</span>
                            <span class="text-[11px] text-gray-400 font-medium uppercase tracking-wider">Total</span>
                        </div>
                    </div>
                    <div class="mt-5 space-y-2">
                        <div class="flex items-center justify-between py-2 px-3 rounded-lg bg-emerald-50">
                            <span class="flex items-center gap-2 text-sm text-gray-700 font-medium">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                Bekerja
                            </span>
                            <div class="flex items-baseline gap-1.5">
                                <span class="text-sm font-bold text-gray-900">{{ number_format($bekerja) }}</span>
                                <span class="text-xs text-gray-500 font-medium">{{ $persenBekerja }}%</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 rounded-lg bg-violet-50">
                            <span class="flex items-center gap-2 text-sm text-gray-700 font-medium">
                                <span class="w-2.5 h-2.5 rounded-full bg-violet-500"></span>
                                Berwirausaha
                            </span>
                            <div class="flex items-baseline gap-1.5">
                                <span class="text-sm font-bold text-gray-900">{{ number_format($berwirausaha) }}</span>
                                <span class="text-xs text-gray-500 font-medium">{{ $persenWirausaha }}%</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 rounded-lg bg-amber-50">
                            <span class="flex items-center gap-2 text-sm text-gray-700 font-medium">
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                                Melanjutkan Studi
                            </span>
                            <div class="flex items-baseline gap-1.5">
                                <span class="text-sm font-bold text-gray-900">{{ number_format($melanjutkanStudi) }}</span>
                                <span class="text-xs text-gray-500 font-medium">{{ $persenStudi }}%</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bar Chart per Tahun --}}
                <div class="lg:col-span-2 bg-white border border-gray-100 rounded-2xl p-6 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                    <div class="mb-5">
                        <h3 class="text-lg font-bold text-gray-900">Tren Penyerapan per Tahun</h3>
                        <p class="text-xs text-gray-500 mt-1">Distribusi status alumni berdasarkan tahun kelulusan</p>
                    </div>
                    <div class="h-80">
                        <canvas id="chartPerTahun"></canvas>
                    </div>
                </div>
            </div>

            {{-- Progress Bar per Tahun --}}
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden" data-aos="fade-up">
                <div class="px-6 py-5 border-b border-gray-100 bg-slate-50/50 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-900">Rincian per Tahun Kelulusan</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Persentase penyerapan alumni tiap angkatan</p>
                        </div>
                    </div>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse ($perTahun as $tahun => $rows)
                        @php
                            $tBekerja = $rows->firstWhere('status', 'Bekerja')->total ?? 0;
                            $tWirausaha = $rows->firstWhere('status', 'Berwirausaha')->total ?? 0;
                            $tStudi = $rows->firstWhere('status', 'Melanjutkan Studi')->total ?? 0;
                            $tTotal = $tBekerja + $tWirausaha + $tStudi;
                            $persenBekerjaTahun = $tTotal ? round($tBekerja / $tTotal * 100) : 0;
                            $persenWirausahaTahun = $tTotal ? round($tWirausaha / $tTotal * 100) : 0;
                            $persenStudiTahun = $tTotal ? round($tStudi / $tTotal * 100) : 0;
                        @endphp
                        <div class="p-5 hover:bg-slate-50/50 transition-colors">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center font-bold text-sm shrink-0">
                                        {{ substr($tahun, -2) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900">Angkatan {{ $tahun }}</p>
                                        <p class="text-xs text-gray-500">{{ $tTotal }} alumni terdata</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 text-xs">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-emerald-50 text-emerald-700 font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        {{ $tBekerja }} Bekerja
                                    </span>
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-violet-50 text-violet-700 font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-violet-500"></span>
                                        {{ $tWirausaha }} Wirausaha
                                    </span>
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-amber-50 text-amber-700 font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        {{ $tStudi }} Studi
                                    </span>
                                </div>
                            </div>

                            {{-- Stacked Progress Bar --}}
                            <div class="w-full h-3 bg-gray-100 rounded-full overflow-hidden flex">
                                @if ($tBekerja > 0)
                                    <div class="h-full bg-emerald-500 transition-all duration-500" style="width: {{ $persenBekerjaTahun }}%" title="Bekerja: {{ $persenBekerjaTahun }}%"></div>
                                @endif
                                @if ($tWirausaha > 0)
                                    <div class="h-full bg-violet-500 transition-all duration-500" style="width: {{ $persenWirausahaTahun }}%" title="Berwirausaha: {{ $persenWirausahaTahun }}%"></div>
                                @endif
                                @if ($tStudi > 0)
                                    <div class="h-full bg-amber-500 transition-all duration-500" style="width: {{ $persenStudiTahun }}%" title="Studi: {{ $persenStudiTahun }}%"></div>
                                @endif
                            </div>

                            {{-- Legend per Tahun --}}
                            <div class="flex flex-wrap gap-x-4 gap-y-1 mt-2 text-xs text-gray-500">
                                <span class="flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    Bekerja: <strong class="text-gray-700">{{ $persenBekerjaTahun }}%</strong>
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-violet-500"></span>
                                    Wirausaha: <strong class="text-gray-700">{{ $persenWirausahaTahun }}%</strong>
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                    Studi: <strong class="text-gray-700">{{ $persenStudiTahun }}%</strong>
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center">
                            <p class="text-sm text-gray-400">Data statistik belum tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        @else
            {{-- Empty State --}}
            <div class="py-16 text-center" data-aos="fade-up">
                <div class="max-w-md mx-auto">
                    <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-5">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Data Statistik</h3>
                    <p class="text-gray-500 leading-relaxed mb-6">Data statistik penyerapan alumni sedang dalam proses pengumpulan. Silakan kunjungi kami kembali nanti untuk melihat capaian terkini.</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-xl transition shadow-lg shadow-slate-900/10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        @endif

    </section>

    {{-- Chart.js Scripts --}}
    @if ($totalAlumniStat > 0)
        @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Chart.defaults.font.family = "'Figtree', system-ui, -apple-system, sans-serif";
                Chart.defaults.color = '#64748b';

                {{-- Donut Chart --}}
                const donutEl = document.getElementById('chartDonut');
                if (donutEl) {
                    new Chart(donutEl, {
                        type: 'doughnut',
                        data: {
                            labels: ['Bekerja', 'Berwirausaha', 'Melanjutkan Studi'],
                            datasets: [{
                                data: [{{ $bekerja }}, {{ $berwirausaha }}, {{ $melanjutkanStudi }}],
                                backgroundColor: ['#10b981', '#8b5cf6', '#f59e0b'],
                                borderWidth: 0,
                                hoverOffset: 8,
                                spacing: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '75%',
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: '#0f172a',
                                    padding: 10,
                                    cornerRadius: 8,
                                    titleFont: { size: 12, weight: '600' },
                                    bodyFont: { size: 12 },
                                    callbacks: {
                                        label: function (ctx) {
                                            const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                            const pct = total ? Math.round(ctx.raw / total * 100) : 0;
                                            return ' ' + ctx.label + ': ' + ctx.raw + ' (' + pct + '%)';
                                        }
                                    }
                                }
                            }
                        }
                    });
                }

                {{-- Bar Chart per Tahun --}}
                const perTahunEl = document.getElementById('chartPerTahun');
                @if ($perTahun->isNotEmpty())
                if (perTahunEl) {
                    const tahunLabels = {!! json_encode($perTahun->keys()->map(fn ($t) => (string) $t)->values()) !!};
                    const bekerjaData = {!! json_encode($perTahun->map(fn ($g) => $g->firstWhere('status', 'Bekerja')->total ?? 0)->values()) !!};
                    const wirausahaData = {!! json_encode($perTahun->map(fn ($g) => $g->firstWhere('status', 'Berwirausaha')->total ?? 0)->values()) !!};
                    const studiData = {!! json_encode($perTahun->map(fn ($g) => $g->firstWhere('status', 'Melanjutkan Studi')->total ?? 0)->values()) !!};

                    new Chart(perTahunEl, {
                        type: 'bar',
                        data: {
                            labels: tahunLabels,
                            datasets: [
                                { 
                                    label: 'Bekerja', 
                                    data: bekerjaData, 
                                    backgroundColor: '#10b981', 
                                    borderRadius: 6, 
                                    borderSkipped: false, 
                                    maxBarThickness: 32 
                                },
                                { 
                                    label: 'Berwirausaha', 
                                    data: wirausahaData, 
                                    backgroundColor: '#8b5cf6', 
                                    borderRadius: 6, 
                                    borderSkipped: false, 
                                    maxBarThickness: 32 
                                },
                                { 
                                    label: 'Melanjutkan Studi', 
                                    data: studiData, 
                                    backgroundColor: '#f59e0b', 
                                    borderRadius: 6, 
                                    borderSkipped: false, 
                                    maxBarThickness: 32 
                                },
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: { usePointStyle: true, pointStyle: 'circle', boxWidth: 6, padding: 16, font: { size: 11, weight: '500' } }
                                },
                                tooltip: {
                                    backgroundColor: '#0f172a',
                                    padding: 10,
                                    cornerRadius: 8,
                                    titleFont: { size: 12, weight: '600' },
                                    bodyFont: { size: 12 },
                                    boxPadding: 4
                                }
                            },
                            scales: {
                                x: { 
                                    grid: { display: false }, 
                                    ticks: { font: { size: 11, weight: '500' } },
                                    border: { display: false }
                                },
                                y: { 
                                    beginAtZero: true, 
                                    ticks: { precision: 0, font: { size: 11 }, padding: 8 }, 
                                    grid: { color: '#f1f5f9', drawBorder: false },
                                    border: { display: false }
                                }
                            }
                        }
                    });
                }
                @endif
            });
        </script>
        @endpush
    @endif

</x-layouts.public>
