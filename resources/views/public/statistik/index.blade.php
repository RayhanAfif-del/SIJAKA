<x-layouts.public title="Statistik Alumni">

    @php
        $pengaturanWebsite = $pengaturanWebsite ?? \App\Models\PengaturanWebsite::first();
        $heroImageUrl = $pengaturanWebsite && $pengaturanWebsite->hero_image ? \Illuminate\Support\Facades\Storage::url($pengaturanWebsite->hero_image) : null;
        
        $totalAlumniStat = ($bekerja ?? 0) + ($berwirausaha ?? 0) + ($melanjutkanStudi ?? 0);
        $persenBekerja = $totalAlumniStat ? round(($bekerja ?? 0) / $totalAlumniStat * 100) : 0;
        $persenWirausaha = $totalAlumniStat ? round(($berwirausaha ?? 0) / $totalAlumniStat * 100) : 0;
        $persenStudi = $totalAlumniStat ? round(($melanjutkanStudi ?? 0) / $totalAlumniStat * 100) : 0;
    @endphp

    {{-- ============================================ --}}
    {{-- 1. HERO SECTION                              --}}
    {{-- ============================================ --}}
    <section class="relative bg-slate-900 text-white overflow-hidden">
        @if ($heroImageUrl)
            <div class="absolute inset-0">
                <img src="{{ $heroImageUrl }}" alt="Background" class="w-full h-full object-cover opacity-30">
                <div class="absolute inset-0 bg-gradient-to-br from-[#024CD4]/90 via-slate-900/90 to-slate-900/90"></div>
            </div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-[#024CD4] via-slate-900 to-slate-900"></div>
        @endif
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 32px 32px;"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24" data-aos="fade-up">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-blue-200 mb-6 flex-wrap">
                <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white font-medium">Statistik Alumni</span>
            </nav>
            
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mb-4">
                Statistik <span class="text-blue-400">Alumni</span>
            </h1>
            <p class="text-blue-100 text-lg leading-relaxed max-w-2xl">
                Data capaian penyerapan tenaga kerja alumni SMK N 1 Bangsri dari tahun ke tahun — transparan, terukur, dan terpercaya.
            </p>
        </div>
    </section>

    {{-- ============================================ --}}
    {{-- 2. MAIN CONTENT                              --}}
    {{-- ============================================ --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">

        @if ($totalAlumniStat > 0)

            {{-- Section Title & Intro --}}
            <div class="text-center mb-10 lg:mb-14" data-aos="fade-up">
                <span class="inline-block px-4 py-1.5 rounded-full bg-[#024CD4]/10 text-[#024CD4] text-xs font-bold uppercase tracking-wider mb-4">Statistik Kami</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight">
                    Capaian Penyerapan Alumni
                </h2>
                <p class="text-gray-500 mt-4 text-base lg:text-lg max-w-2xl mx-auto">Data real-time dari tracer study BKK SMKN 1 Bangsri</p>
            </div>

            {{-- 4 Cards Grid Layout --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16" data-aos="fade-up" data-aos-delay="100">
                
                {{-- Card 1: Total Alumni --}}
                <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-100 border-t-4 border-t-[#024CD4] shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between relative group">
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-11 h-11 rounded-2xl bg-blue-50 border border-blue-100/80 flex items-center justify-center text-[#024CD4] shadow-sm group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50/80 border border-blue-100 text-[#024CD4] text-xs font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#024CD4]"></span>
                            Terverifikasi
                        </span>
                    </div>

                    <div class="mb-5">
                        <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">TOTAL ALUMNI</p>
                        <p class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight mb-2">{{ number_format($totalAlumniStat) }}</p>
                        <p class="text-xs text-gray-500 leading-relaxed min-h-[36px]">Alumni terdata dalam sistem BKK SMKN 1 Bangsri.</p>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between text-xs mt-auto">
                        <span class="text-gray-500 font-medium">Validasi Data BKK</span>
                        <span class="font-bold text-[#024CD4]">100% Valid</span>
                    </div>
                </div>

                {{-- Card 2: Sudah Bekerja --}}
                <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-100 border-t-4 border-t-emerald-500 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between relative group">
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-11 h-11 rounded-2xl bg-emerald-50 border border-emerald-100/80 flex items-center justify-center text-emerald-600 shadow-sm group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50/80 border border-emerald-100 text-emerald-600 text-xs font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            {{ $persenBekerja }}% Terserap
                        </span>
                    </div>

                    <div class="mb-5">
                        <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">SUDAH BEKERJA</p>
                        <p class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight mb-2">{{ number_format($bekerja) }}</p>
                        <p class="text-xs text-gray-500 leading-relaxed min-h-[36px]">Bekerja di mitra DUDI, manufaktur, teknologi & BUMN.</p>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between text-xs mt-auto">
                        <span class="text-gray-500 font-medium">Tingkat Penyerapan</span>
                        <span class="font-bold text-emerald-600">{{ $persenBekerja }}%</span>
                    </div>
                </div>

                {{-- Card 3: Berwirausaha --}}
                <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-100 border-t-4 border-t-purple-500 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between relative group">
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-11 h-11 rounded-2xl bg-purple-50 border border-purple-100/80 flex items-center justify-center text-purple-600 shadow-sm group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-purple-50/80 border border-purple-100 text-purple-600 text-xs font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                            {{ $persenWirausaha }}%
                        </span>
                    </div>

                    <div class="mb-5">
                        <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">BERWIRAUSAHA</p>
                        <p class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight mb-2">{{ number_format($berwirausaha) }}</p>
                        <p class="text-xs text-gray-500 leading-relaxed min-h-[36px]">Memulai rintisan usaha mandiri, UMKM, & bisnis kreatif.</p>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between text-xs mt-auto">
                        <span class="text-gray-500 font-medium">Proporsi Wirausaha</span>
                        <span class="font-bold text-purple-600">{{ $persenWirausaha }}%</span>
                    </div>
                </div>

                {{-- Card 4: Melanjutkan Studi --}}
                <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-100 border-t-4 border-t-amber-500 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between relative group">
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-11 h-11 rounded-2xl bg-amber-50 border border-amber-100/80 flex items-center justify-center text-amber-600 shadow-sm group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50/80 border border-amber-100 text-amber-600 text-xs font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            {{ $persenStudi }}%
                        </span>
                    </div>

                    <div class="mb-5">
                        <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">MELANJUTKAN STUDI</p>
                        <p class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight mb-2">{{ number_format($melanjutkanStudi) }}</p>
                        <p class="text-xs text-gray-500 leading-relaxed min-h-[36px]">Melanjutkan ke jenjang pendidikan tinggi/perguruan tinggi.</p>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between text-xs mt-auto">
                        <span class="text-gray-500 font-medium">Proporsi Studi Lanjut</span>
                        <span class="font-bold text-amber-600">{{ $persenStudi }}%</span>
                    </div>
                </div>

            </div>

            {{-- Charts Section --}}
            <div class="grid lg:grid-cols-3 gap-6 mb-12">
                
                {{-- Donut Chart --}}
                <div class="bg-white border border-gray-100 rounded-3xl p-4 sm:p-6 shadow-sm" data-aos="fade-up">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Distribusi Status</h3>
                        <p class="text-xs text-gray-500 mt-1">Proporsi status alumni secara keseluruhan</p>
                    </div>
                    <div class="relative w-48 h-48 sm:w-56 sm:h-56 mx-auto">
                        <canvas id="chartDonut"></canvas>
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                            <span class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ number_format($totalAlumniStat) }}</span>
                            <span class="text-[11px] text-gray-400 font-medium uppercase tracking-wider mt-1">Total</span>
                        </div>
                    </div>
                    <div class="mt-6 space-y-3">
                        <div class="flex items-center justify-between py-2.5 px-4 rounded-xl bg-emerald-50/50 border border-emerald-100">
                            <span class="flex items-center gap-2.5 text-sm text-gray-700 font-semibold">
                                <span class="w-3 h-3 rounded-full bg-emerald-500 shadow-sm shadow-emerald-500/50"></span>
                                Bekerja
                            </span>
                            <div class="flex items-baseline gap-2">
                                <span class="text-sm font-extrabold text-gray-900">{{ number_format($bekerja) }}</span>
                                <span class="text-xs font-bold text-emerald-600 bg-emerald-100 px-2 py-0.5 rounded-full">{{ $persenBekerja }}%</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between py-2.5 px-4 rounded-xl bg-violet-50/50 border border-violet-100">
                            <span class="flex items-center gap-2.5 text-sm text-gray-700 font-semibold">
                                <span class="w-3 h-3 rounded-full bg-violet-500 shadow-sm shadow-violet-500/50"></span>
                                Berwirausaha
                            </span>
                            <div class="flex items-baseline gap-2">
                                <span class="text-sm font-extrabold text-gray-900">{{ number_format($berwirausaha) }}</span>
                                <span class="text-xs font-bold text-violet-600 bg-violet-100 px-2 py-0.5 rounded-full">{{ $persenWirausaha }}%</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between py-2.5 px-4 rounded-xl bg-amber-50/50 border border-amber-100">
                            <span class="flex items-center gap-2.5 text-sm text-gray-700 font-semibold">
                                <span class="w-3 h-3 rounded-full bg-amber-500 shadow-sm shadow-amber-500/50"></span>
                                Melanjutkan Studi
                            </span>
                            <div class="flex items-baseline gap-2">
                                <span class="text-sm font-extrabold text-gray-900">{{ number_format($melanjutkanStudi) }}</span>
                                <span class="text-xs font-bold text-amber-600 bg-amber-100 px-2 py-0.5 rounded-full">{{ $persenStudi }}%</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bar Chart per Tahun --}}
                <div class="lg:col-span-2 bg-white border border-gray-100 rounded-3xl p-4 sm:p-6 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Tren Penyerapan per Tahun</h3>
                        <p class="text-xs text-gray-500 mt-1">Distribusi status alumni berdasarkan tahun kelulusan</p>
                    </div>
                    <div class="h-64 sm:h-80 w-full">
                        <canvas id="chartPerTahun"></canvas>
                    </div>
                </div>
            </div>

            {{-- Progress Bar per Tahun --}}
            <div class="bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-100 bg-slate-50/50 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#024CD4] text-white flex items-center justify-center shadow-lg shadow-blue-600/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
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
                        <div class="p-4 sm:p-6 hover:bg-slate-50/80 transition-colors duration-200">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-[#024CD4] flex items-center justify-center font-extrabold text-sm shrink-0 border border-blue-100">
                                        {{ substr($tahun, -2) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900 text-lg">Angkatan {{ $tahun }}</p>
                                        <p class="text-xs text-gray-500 font-medium">{{ $tTotal }} alumni terdata</p>
                                    </div>
                                </div>
                                <div class="flex flex-wrap items-center gap-2 text-xs">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 font-bold border border-emerald-100">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                        {{ $tBekerja }} Bekerja
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-violet-50 text-violet-700 font-bold border border-violet-100">
                                        <span class="w-2 h-2 rounded-full bg-violet-500"></span>
                                        {{ $tWirausaha }} Wirausaha
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-50 text-amber-700 font-bold border border-amber-100">
                                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                        {{ $tStudi }} Studi
                                    </span>
                                </div>
                            </div>

                            {{-- Stacked Progress Bar --}}
                            <div class="w-full h-4 bg-gray-100 rounded-full overflow-hidden flex shadow-inner">
                                @if ($tBekerja > 0)
                                    <div class="h-full bg-emerald-500 hover:bg-emerald-400 transition-all duration-500 relative group/bar" style="width: {{ $persenBekerjaTahun }}%">
                                        <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover/bar:block bg-gray-900 text-white text-[10px] font-bold px-2 py-1 rounded whitespace-nowrap z-10">
                                            Bekerja: {{ $persenBekerjaTahun }}%
                                        </div>
                                    </div>
                                @endif
                                @if ($tWirausaha > 0)
                                    <div class="h-full bg-violet-500 hover:bg-violet-400 transition-all duration-500 relative group/bar" style="width: {{ $persenWirausahaTahun }}%">
                                        <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover/bar:block bg-gray-900 text-white text-[10px] font-bold px-2 py-1 rounded whitespace-nowrap z-10">
                                            Wirausaha: {{ $persenWirausahaTahun }}%
                                        </div>
                                    </div>
                                @endif
                                @if ($tStudi > 0)
                                    <div class="h-full bg-amber-500 hover:bg-amber-400 transition-all duration-500 relative group/bar" style="width: {{ $persenStudiTahun }}%">
                                        <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover/bar:block bg-gray-900 text-white text-[10px] font-bold px-2 py-1 rounded whitespace-nowrap z-10">
                                            Studi: {{ $persenStudiTahun }}%
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Legend per Tahun --}}
                            <div class="flex flex-wrap gap-x-6 gap-y-2 mt-3 text-xs text-gray-500 font-medium">
                                <span class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                    Bekerja: <strong class="text-gray-900">{{ $persenBekerjaTahun }}%</strong>
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-violet-500"></span>
                                    Wirausaha: <strong class="text-gray-900">{{ $persenWirausahaTahun }}%</strong>
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                                    Studi: <strong class="text-gray-900">{{ $persenStudiTahun }}%</strong>
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <p class="text-sm text-gray-400">Data statistik per tahun belum tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        @else
            {{-- Empty State --}}
            <div class="py-20 text-center" data-aos="fade-up">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Data Statistik</h3>
                    <p class="text-gray-500 leading-relaxed mb-8">Data statistik penyerapan alumni sedang dalam proses pengumpulan. Silakan kunjungi kami kembali nanti untuk melihat capaian terkini.</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 min-h-11 px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-xl transition shadow-lg shadow-slate-900/10 hover:-translate-y-0.5 w-full sm:w-auto">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        @endif

    </section>

    {{-- ============================================ --}}
    {{-- 3. CHART.JS SCRIPTS                          --}}
    {{-- ============================================ --}}
    @if ($totalAlumniStat > 0)
        @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Chart.defaults.font.family = "'Figtree', system-ui, -apple-system, sans-serif";
                Chart.defaults.color = '#64748b';

                // Donut Chart
                const donutEl = document.getElementById('chartDonut');
                if (donutEl) {
                    new Chart(donutEl, {
                        type: 'doughnut',
                        data: {
                            labels: ['Bekerja', 'Berwirausaha', 'Melanjutkan Studi'],
                            datasets: [{
                                data: [{{ $bekerja ?? 0 }}, {{ $berwirausaha ?? 0 }}, {{ $melanjutkanStudi ?? 0 }}],
                                backgroundColor: ['#10b981', '#8b5cf6', '#f59e0b'],
                                borderWidth: 0,
                                hoverOffset: 8,
                                spacing: 3
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '78%',
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: '#0f172a',
                                    padding: 12,
                                    cornerRadius: 8,
                                    titleFont: { size: 13, weight: '600' },
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

                // Bar Chart per Tahun
                const perTahunEl = document.getElementById('chartPerTahun');
                @if (isset($perTahun) && $perTahun->isNotEmpty())
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
                                    maxBarThickness: 40 
                                },
                                { 
                                    label: 'Berwirausaha', 
                                    data: wirausahaData, 
                                    backgroundColor: '#8b5cf6', 
                                    borderRadius: 6, 
                                    borderSkipped: false, 
                                    maxBarThickness: 40 
                                },
                                { 
                                    label: 'Melanjutkan Studi', 
                                    data: studiData, 
                                    backgroundColor: '#f59e0b', 
                                    borderRadius: 6, 
                                    borderSkipped: false, 
                                    maxBarThickness: 40 
                                },
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: { usePointStyle: true, pointStyle: 'circle', boxWidth: 8, padding: 20, font: { size: 12, weight: '600' } }
                                },
                                tooltip: {
                                    backgroundColor: '#0f172a',
                                    padding: 12,
                                    cornerRadius: 8,
                                    titleFont: { size: 13, weight: '600' },
                                    bodyFont: { size: 12 },
                                    boxPadding: 4
                                }
                            },
                            scales: {
                                x: { 
                                    grid: { display: false }, 
                                    ticks: { font: { size: 12, weight: '600' } },
                                    border: { display: false }
                                },
                                y: { 
                                    beginAtZero: true, 
                                    ticks: { precision: 0, font: { size: 12, weight: '500' }, padding: 12 }, 
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