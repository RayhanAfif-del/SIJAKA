<x-layouts.public title="Beranda">

    @php
        $heroTitlePrefix = $pengaturanWebsite->hero_title_prefix ?: 'Jembatan Karier';
        $heroTitleHighlight = $pengaturanWebsite->hero_title_highlight ?: 'untuk Masa Depan';
        $heroTitleSuffix = $pengaturanWebsite->hero_title_suffix ?: 'Gemilang';
        $heroDescription = $pengaturanWebsite->hero_description ?: 'Kami siap membantu siswa, alumni, dan masyarakat dalam mendapatkan informasi dunia kerja terkini dan peluang karier terbaik.';
        $heroPrimaryLabel = $pengaturanWebsite->hero_primary_label ?: 'Lihat Lowongan';
        $heroPrimaryUrl = $pengaturanWebsite->hero_primary_url ?: route('lowongan.index');
        $heroSecondaryLabel = $pengaturanWebsite->hero_secondary_label ?: 'Tentang BKK';
        $heroSecondaryUrl = $pengaturanWebsite->hero_secondary_url ?: route('profil.index');
        $heroImageUrl = $pengaturanWebsite->hero_image ? \Illuminate\Support\Facades\Storage::url($pengaturanWebsite->hero_image) : null;
    @endphp

    {{-- ============================================ --}}
    {{-- HERO SECTION - Premium Design               --}}
    {{-- ============================================ --}}
    <section class="relative min-h-screen bg-slate-900 text-white overflow-hidden flex items-center">
        {{-- Hero Background Image --}}
        @if ($heroImageUrl)
            <div class="absolute inset-0">
                <img src="{{ $heroImageUrl }}" alt="Foto beranda utama" class="w-full h-full object-cover opacity-40">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-slate-900/90 to-slate-900/90"></div>
            </div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-slate-900 to-slate-900"></div>
        @endif
        
        {{-- Dot Pattern --}}
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 32px 32px;"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 w-full" data-aos="fade-up">
            
            {{-- Hero Content --}}
            <div class="max-w-3xl">

                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold text-white leading-[1.1] tracking-tight mb-6">
                    {{ $heroTitlePrefix }} 
                    <span class="relative inline-block">
                        <span class="text-blue-400">
                            {{ $heroTitleHighlight }}
                        </span>
                    </span> 
                    <br>{{ $heroTitleSuffix }}
                </h1>
                
                <p class="text-blue-100 text-lg sm:text-xl leading-relaxed mb-10 max-w-2xl">
                    {{ $heroDescription }}
                </p>
                
                <div class="flex flex-wrap gap-4 mb-12">
                    <a href="{{ $heroPrimaryUrl }}" 
                       class="group relative inline-flex items-center gap-2 bg-blue-400 hover:bg-blue-500 text-slate-900 text-sm font-bold px-8 py-4 rounded-xl shadow-lg transition-all duration-300 hover:-translate-y-1">
                        <span class="relative">{{ $heroPrimaryLabel }}</span>
                        <svg class="w-4 h-4 relative group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="{{ $heroSecondaryUrl }}" 
                       class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white text-sm font-semibold px-8 py-4 rounded-xl transition-all duration-300 hover:-translate-y-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $heroSecondaryLabel }}
                    </a>
                </div>

                {{-- Feature Pills --}}
                <div class="flex flex-wrap gap-3">
                    @php
                        $features = [
                            ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'text' => 'Terpercaya'],
                            ['icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'text' => 'Peluang Kerja'],
                            ['icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'text' => 'Karier Sukses'],
                        ];
                    @endphp
                    @foreach ($features as $feature)
                        <span class="inline-flex items-center gap-2 bg-white/10 border border-white/20 px-4 py-2 rounded-full text-xs font-medium text-blue-100 shadow-lg">
                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $feature['icon'] }}"/>
                            </svg>
                            {{ $feature['text'] }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================ --}}
    {{-- INFINITE MARQUEE - LOGO MITRA                --}}
    {{-- ============================================ --}}
    <section class="bg-white border-b border-gray-100 py-10 lg:py-14 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8 text-center">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-[0.2em]" data-aos="fade-up">
                Dipercaya oleh perusahaan terkemuka
            </p>
        </div>
        
        <div class="relative">
            {{-- Fade edges --}}
            <div class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>
            
            <div class="marquee flex gap-16 items-center">
                {{-- Duplikasi logo untuk seamless loop --}}
                @foreach ([$mitra, $mitra] as $group)
                    @foreach ($group as $item)
                        <div class="flex-shrink-0 w-40 h-20 flex items-center justify-center transition-transform duration-300 hover:scale-110">
                            @if ($item->logo)
                                <img src="{{ Storage::url($item->logo) }}" class="max-w-full max-h-full object-contain" alt="{{ $item->nama_perusahaan }}">
                            @else
                                <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <span class="text-lg font-bold text-gray-400">{{ strtoupper(substr($item->nama_perusahaan, 0, 2)) }}</span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================ --}}
    {{-- QUICK LINKS - Premium Glassmorphism          --}}
    {{-- ============================================ --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14 relative z-20" data-aos="fade-up">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 divide-y sm:divide-y-0 sm:divide-x divide-gray-100">
            @foreach ([
                ['label' => 'Lowongan Pekerjaan', 'desc' => 'Temukan peluang kerja sesuai minat Anda', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'url' => route('lowongan.index'), 'color' => 'bg-[#024CD4]'],
                ['label' => 'Artikel Dunia Kerja', 'desc' => 'Tips, berita, dan informasi seputar dunia kerja', 'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z', 'url' => route('artikel.index'), 'color' => 'bg-[#024CD4]'],
                ['label' => 'Galeri Kegiatan', 'desc' => 'Dokumentasi kegiatan BKK terbaru', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z', 'url' => route('galeri.index'), 'color' => 'bg-[#024CD4]'],
                ['label' => 'Mitra Perusahaan', 'desc' => 'Perusahaan terbaik yang bekerja sama dengan kami', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'url' => route('lowongan.index'), 'color' => 'bg-[#024CD4]'],
                ['label' => 'Statistik Alumni', 'desc' => 'Data penyerapan alumni dan capaian BKK', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'url' => route('statistik.index'), 'color' => 'bg-[#024CD4]'],
            ] as $item)
            <div class="group p-6 flex flex-col items-center text-center gap-4 hover:bg-gradient-to-b hover:from-gray-50 hover:to-white transition-all duration-300 relative">
                    <span class="w-14 h-14 rounded-2xl {{ $item['color'] }} text-white flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                        </svg>
                    </span>
                    <div>
                        <span class="block text-sm font-bold text-gray-800 group-hover:text-[#013ba8] transition-colors">{{ $item['label'] }}</span>
                        <span class="block text-xs text-gray-500 mt-2 leading-relaxed">{{ $item['desc'] }}</span>
                    </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- ============================================ --}}
    {{-- LOWONGAN UNGGULAN - Enhanced Design          --}}
    {{-- ============================================ --}}
    @if ($lowonganUnggulan->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
            <div class="grid lg:grid-cols-3 gap-8 items-stretch">
                <div class="lg:col-span-2 flex flex-col">
                    <div class="flex items-center justify-between mb-8" data-aos="fade-up">
                        <div>
                            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 flex items-center gap-3">
                                <span class="w-1 h-8 bg-[#024CD4] rounded-full"></span>
                                Lowongan Unggulan
                            </h2>
                            <p class="text-gray-500 mt-2 text-sm">Peluang karier terbaik untuk masa depanmu</p>
                        </div>
                        <a href="{{ route('lowongan.index') }}" class="group inline-flex items-center gap-2 text-sm font-semibold text-[#024CD4] hover:text-[#013ba8] bg-[#024CD4]/10 hover:bg-[#024CD4]/20 px-4 py-2 rounded-lg transition-all duration-200">
                            Lihat Semua 
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                    
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 flex-1 content-start">
                        @foreach ($lowonganUnggulan as $index => $item)
                            <div class="group bg-white border border-gray-100 rounded-2xl p-6 hover:shadow-2xl hover:border-[#024CD4]/40 hover:-translate-y-2 transition-all duration-300 flex flex-col relative overflow-hidden h-full"
                                data-aos="fade-up"
                                data-aos-delay="{{ $index * 100 }}">

                                {{-- Hover Effect Line --}}
                                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#024CD4] to-[#013ba8] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>

                                {{-- Membuat seluruh kartu bisa diklik (Stretched Link) --}}
                                <a href="{{ route('lowongan.show', $item) }}" class="absolute inset-0 z-10" aria-label="Lihat detail {{ $item->posisi }}"></a>

                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#024CD4]/10 to-[#024CD4]/20 flex items-center justify-center text-[#024CD4] text-sm font-bold overflow-hidden flex-shrink-0 ring-2 ring-[#024CD4]/20 group-hover:ring-[#024CD4]/40 transition-all">
                                        @if ($item->mitra->logo)
                                            <img src="{{ Storage::url($item->mitra->logo) }}"
                                                class="w-full h-full object-cover"
                                                alt="{{ $item->mitra->nama_perusahaan }}"
                                                loading="lazy">
                                        @else
                                            {{ strtoupper(substr($item->mitra->nama_perusahaan, 0, 2)) }}
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-semibold text-gray-800 text-sm line-clamp-1" title="{{ $item->mitra->nama_perusahaan }}">
                                            {{ $item->mitra->nama_perusahaan }}
                                        </p>
                                        <p class="text-xs text-gray-400">Perusahaan</p>
                                    </div>
                                </div>

                                <h3 class="font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-[#013ba8] transition-colors">
                                    {{ $item->posisi }}
                                </h3>

                                <div class="flex items-center gap-1.5 text-xs text-gray-500 mb-4">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $item->lokasi }}
                                </div>

                                <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                                    <span class="inline-block text-xs font-semibold bg-[#024CD4]/10 text-[#013ba8] px-3 py-1.5 rounded-lg group-hover:bg-[#024CD4]/20 transition-colors">
                                        {{ $item->jenis_pekerjaan }}
                                    </span>
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-[#024CD4] group-hover:text-[#013ba8] group-hover:gap-2 transition-all">
                                        Detail
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- CTA Box - Enhanced (Matching Image Design) --}}
                <div class="relative bg-[#024CD4] rounded-2xl p-8 lg:p-10 text-white flex flex-col justify-between shadow-xl overflow-hidden h-full" data-aos="fade-left">

                    {{-- Decorative Curved Shapes (Right Side) --}}
                    <div class="absolute top-0 right-0 w-64 h-64 lg:w-80 lg:h-80">
                        <svg viewBox="0 0 300 300" class="w-full h-full" fill="none">
                            <path d="M300 0 C200 50, 150 100, 100 200 C80 240, 60 270, 0 300 L300 300 Z" fill="rgba(255,255,255,0.08)"/>
                            <path d="M300 0 C220 60, 170 120, 120 220 C100 260, 80 280, 0 300 L300 300 Z" fill="rgba(255,255,255,0.05)"/>
                            <path d="M300 0 C240 70, 190 140, 140 240 C120 270, 100 290, 0 300 L300 300 Z" fill="rgba(255,255,255,0.03)"/>
                        </svg>
                    </div>

                    {{-- Paper Airplane Icon (Top Right) --}}
                    <div class="absolute top-6 right-8 lg:top-8 lg:right-12">
                        <svg class="w-10 h-10 lg:w-12 lg:h-12 text-amber-400 transform rotate-[-15deg]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                        </svg>
                    </div>

                    {{-- Dot Pattern (Bottom Left) --}}
                    <div class="absolute bottom-4 left-4 lg:bottom-6 lg:left-6 grid grid-cols-4 gap-2 opacity-30">
                        @for ($i = 0; $i < 16; $i++)
                            <div class="w-1.5 h-1.5 bg-white rounded-full"></div>
                        @endfor
                    </div>

                    {{-- Glow Effect --}}
                    <div class="absolute top-0 right-0 -mr-16 -mt-16 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-48 h-48 bg-[#024CD4]/40 rounded-full blur-3xl"></div>

                    {{-- Content --}}
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="flex-1">
                            <h3 class="text-2xl lg:text-3xl xl:text-4xl font-bold mb-3 leading-tight">
                                Saatnya<br>Raih Karier Impianmu!
                            </h3>
                            <p class="text-[#d0e3ff] text-sm lg:text-base leading-relaxed mb-8 max-w-md">
                                Temukan ribuan lowongan kerja terbaik dari perusahaan terpercaya.
                            </p>
                        </div>

                        <div>
                            <a href="{{ route('lowongan.index') }}" class="group inline-flex items-center gap-2 bg-amber-400 hover:bg-amber-500 text-slate-900 text-sm font-bold px-6 py-3.5 rounded-xl transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5">
                                Cari Lowongan Sekarang
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    
    {{-- ============================================ --}}
    {{-- LOWONGAN & ARTIKEL TERBARU                   --}}
    {{-- ============================================ --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14 grid lg:grid-cols-2 gap-8 lg:gap-12">
        {{-- Lowongan Terbaru --}}
        <div data-aos="fade-up">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                        <span class="w-1 h-8 bg-[#024CD4] rounded-full"></span>
                        Lowongan Terbaru
                    </h2>
                </div>
                <a href="{{ route('lowongan.index') }}" class="group inline-flex items-center gap-2 text-sm font-semibold text-[#024CD4] hover:text-[#013ba8] bg-[#024CD4]/10 hover:bg-[#024CD4]/20 px-4 py-2 rounded-lg transition-all">
                    Lihat Semua 
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-lg shadow-gray-100/50 divide-y divide-gray-50 overflow-hidden">
                @forelse ($lowonganTerbaru as $item)
                    <a href="{{ route('lowongan.show', $item) }}" class="group flex items-center justify-between gap-4 p-5 hover:bg-gradient-to-r hover:from-[#024CD4]/5 hover:to-transparent transition-all duration-200">
                        <span class="flex items-center gap-4 min-w-0">
                            <span class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#024CD4]/10 to-[#024CD4]/20 flex items-center justify-center text-[#024CD4] text-sm font-bold overflow-hidden flex-shrink-0 ring-2 ring-[#024CD4]/20 group-hover:ring-[#024CD4]/40 transition-all">
                                @if ($item->mitra->logo)
                                    <img src="{{ Storage::url($item->mitra->logo) }}" class="w-full h-full object-cover" alt="{{ $item->mitra->nama_perusahaan }}">
                                @else
                                    {{ strtoupper(substr($item->mitra->nama_perusahaan, 0, 2)) }}
                                @endif
                            </span>
                            <span class="min-w-0">
                                <span class="block text-sm font-bold text-gray-800 group-hover:text-[#013ba8] transition-colors line-clamp-1">{{ $item->posisi }}</span>
                                <span class="flex items-center gap-1 text-xs text-gray-500 mt-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    {{ $item->mitra->nama_perusahaan }}
                                </span>
                            </span>
                        </span>
                        <span class="flex items-center gap-3">
                            <span class="text-xs font-semibold bg-gray-100 text-gray-600 px-3 py-1.5 rounded-lg whitespace-nowrap group-hover:bg-[#024CD4]/20 group-hover:text-[#013ba8] transition-colors">
                                {{ $item->jenis_pekerjaan }}
                            </span>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-[#024CD4] group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </a>
                @empty
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-400">Belum ada lowongan terbaru.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Artikel Terbaru --}}
        <div data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                        <span class="w-1 h-8 bg-[#024CD4] rounded-full"></span>
                        Artikel Terbaru
                    </h2>
                </div>
                <a href="{{ route('artikel.index') }}" class="group inline-flex items-center gap-2 text-sm font-semibold text-emerald-600 hover:text-emerald-700 bg-emerald-50 hover:bg-emerald-100 px-4 py-2 rounded-lg transition-all">
                    Lihat Semua 
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-lg shadow-gray-100/50 divide-y divide-gray-50 overflow-hidden">
                @forelse ($artikelTerbaru as $item)
                    <a href="{{ route('artikel.show', $item) }}" class="group flex items-center gap-5 p-5 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-transparent transition-all duration-200">
                        <div class="w-20 h-20 rounded-xl bg-gray-100 flex-shrink-0 overflow-hidden ring-2 ring-gray-100 group-hover:ring-emerald-200 transition-all">
                            @if ($item->gambar)
                                <img src="{{ Storage::url($item->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" alt="{{ $item->judul }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-emerald-50 to-emerald-100">
                                    <svg class="w-8 h-8 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <span class="min-w-0 flex-1">
                            <span class="block text-sm font-bold text-gray-800 group-hover:text-emerald-700 transition-colors line-clamp-2 leading-snug mb-2">
                                {{ $item->judul }}
                            </span>
                            <span class="flex items-center gap-2 text-xs text-gray-400">
                                <span class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </span>
                                {{ $item->created_at->translatedFormat('d M Y') }}
                            </span>
                        </span>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-600 group-hover:translate-x-1 transition-all flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @empty
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-400">Belum ada artikel terbaru.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ============================================ --}}
    {{-- GALERI KEGIATAN - Homepage Section           --}}
    {{-- ============================================ --}}
    @if (isset($galeri) && $galeri->count() > 0)
        @php
            $kategoriColors = [
                'workshop'           => ['bg' => 'bg-[#024CD4]/10', 'text' => 'text-[#013ba8]', 'dot' => 'bg-[#024CD4]'],
                'seminar'            => ['bg' => 'bg-violet-50',  'text' => 'text-violet-700',  'dot' => 'bg-violet-500'],
                'kunjungan industri' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'dot' => 'bg-emerald-500'],
                'job fair'           => ['bg' => 'bg-amber-50',   'text' => 'text-amber-700',   'dot' => 'bg-amber-500'],
                'training'           => ['bg' => 'bg-rose-50',    'text' => 'text-rose-700',    'dot' => 'bg-rose-500'],
                'sosialisasi'        => ['bg' => 'bg-cyan-50',    'text' => 'text-cyan-700',    'dot' => 'bg-cyan-500'],
                'kegiatan lain'      => ['bg' => 'bg-slate-100',  'text' => 'text-slate-700',   'dot' => 'bg-slate-500'],
            ];
        @endphp
        <section class="relative bg-[#024CD4] py-10 lg:py-14 overflow-hidden">
            <div class="absolute inset-0 opacity-20 pointer-events-none">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;0.05&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>

            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-40 -right-40 w-[600px] h-[600px] bg-[#024CD4]/50 rounded-full filter blur-3xl opacity-15"></div>
                <div class="absolute -bottom-40 -left-40 w-[600px] h-[600px] bg-[#024CD4]/70 rounded-full filter blur-3xl opacity-10"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-10" data-aos="fade-up">
                    <div>
                        <h2 class="text-3xl sm:text-4xl font-bold text-white flex items-center gap-3">
                            <span class="w-1 h-10 bg-white rounded-full"></span>
                            Dokumentasi Kegiatan BKK
                        </h2>
                        <p class="text-[#d0e3ff] mt-3 max-w-xl">
                            Momen-momen berharga dari berbagai kegiatan yang telah kami laksanakan bersama mitra dan siswa.
                        </p>
                    </div>
                    <a href="{{ route('galeri.index') }}" class="hidden sm:inline-flex items-center gap-2 group bg-white/15 text-white hover:bg-white/25 text-sm font-semibold px-6 py-3 rounded-xl border border-white/25 hover:border-white/35 hover:shadow-lg transition-all duration-200">
                        Lihat Semua Galeri
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

                @php
                    $featuredGaleri = $galeri->take(5)->values();
                    $featuredMain = $featuredGaleri->first();
                    $featuredSide = $featuredGaleri->slice(1)->values();
                @endphp

                <div class="grid gap-4 lg:grid-cols-[minmax(0,1.2fr)_minmax(0,1fr)]" data-aos="fade-up" data-aos-delay="100">
                    @if ($featuredMain)
                        @php
                            $kategoriKey = strtolower($featuredMain['kategori'] ?? '');
                            $kc = $kategoriColors[$kategoriKey] ?? $kategoriColors['kegiatan lain'];
                            $cover = $featuredMain['cover'];
                            $photos = $featuredMain['items'];
                            $previewItems = $photos->map(function ($photo) {
                                return [
                                    'url' => Storage::url($photo->foto),
                                    'title' => $photo->judul,
                                    'date' => $photo->tanggal?->translatedFormat('d F Y'),
                                    'kategori' => $photo->kategori,
                                ];
                            })->values();
                            $stackThumbs = $previewItems->take(3);
                        @endphp

                        <div class="group relative overflow-hidden rounded-2xl cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 min-h-[320px] lg:min-h-[520px]"
                             data-aos="fade-up"
                             @if ($cover?->foto)
                             @click="$dispatch('open-stack-preview', { title: @js($featuredMain['judul']), date: @js(optional($featuredMain['tanggal'])->translatedFormat('d F Y')), kategori: @js($featuredMain['kategori']), items: @js($previewItems), startIndex: 0 })"
                             @endif>

                            <div class="relative h-full min-h-[320px] lg:min-h-[520px] bg-gradient-to-br from-gray-100 to-gray-200">
                                @if ($cover?->foto)
                                    <img src="{{ Storage::url($cover->foto) }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                         alt="{{ $featuredMain['judul'] }}"
                                         loading="lazy">
                                @else
                                    <div class="w-full h-full min-h-[320px] lg:min-h-[520px] flex items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/35 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                                <div class="absolute inset-0 flex flex-col justify-end p-5 md:p-6 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-[10px] font-semibold {{ $kc['bg'] }} {{ $kc['text'] }} backdrop-blur-sm bg-opacity-90">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $kc['dot'] }}"></span>
                                            {{ ucfirst($featuredMain['kategori']) }}
                                        </span>
                                    </div>
                                    <h3 class="text-white font-bold text-lg md:text-2xl line-clamp-2 drop-shadow-lg max-w-xl">
                                        {{ $featuredMain['judul'] }}
                                    </h3>
                                    <p class="text-white/80 text-xs mt-2 flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ optional($featuredMain['tanggal'])->translatedFormat('d M Y') }}
                                    </p>
                                </div>

                                <div class="absolute top-4 right-4 inline-flex items-center gap-1.5 bg-white/20 backdrop-blur-sm rounded-full px-2.5 py-1 text-[10px] font-semibold text-white">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                    </svg>
                                    {{ $featuredMain['count'] }} foto
                                </div>

                                @if ($stackThumbs->count() > 1)
                                    <div class="absolute bottom-4 right-4 flex items-end -space-x-3">
                                        @foreach ($stackThumbs as $thumb)
                                            <div class="w-12 h-12 rounded-xl border-2 border-white shadow-lg overflow-hidden bg-white/30 backdrop-blur-sm {{ $loop->index === 0 ? 'translate-y-0' : 'translate-y-1' }}">
                                                <img src="{{ $thumb['url'] }}" alt="{{ $thumb['title'] }}" class="w-full h-full object-cover">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($featuredSide as $index => $item)
                            @php
                                $kategoriKey = strtolower($item['kategori'] ?? '');
                                $kc = $kategoriColors[$kategoriKey] ?? $kategoriColors['kegiatan lain'];
                                $cover = $item['cover'];
                                $photos = $item['items'];
                                $previewItems = $photos->map(function ($photo) {
                                    return [
                                        'url' => Storage::url($photo->foto),
                                        'title' => $photo->judul,
                                        'date' => $photo->tanggal?->translatedFormat('d F Y'),
                                        'kategori' => $photo->kategori,
                                    ];
                                })->values();
                                $stackThumbs = $previewItems->take(2);
                            @endphp

                            <div class="group relative overflow-hidden rounded-2xl cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 aspect-square"
                                 data-aos="fade-up"
                                 data-aos-delay="{{ $index * 50 }}"
                                 @if ($cover?->foto)
                                 @click="$dispatch('open-stack-preview', { title: @js($item['judul']), date: @js(optional($item['tanggal'])->translatedFormat('d F Y')), kategori: @js($item['kategori']), items: @js($previewItems), startIndex: 0 })"
                                 @endif>
                                @if ($cover?->foto)
                                    <img src="{{ Storage::url($cover->foto) }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                         alt="{{ $item['judul'] }}"
                                         loading="lazy">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/35 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                                <div class="absolute inset-0 flex flex-col justify-end p-4 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-[10px] font-semibold {{ $kc['bg'] }} {{ $kc['text'] }} backdrop-blur-sm bg-opacity-90 w-fit mb-2">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $kc['dot'] }}"></span>
                                        {{ ucfirst($item['kategori']) }}
                                    </span>
                                    <h3 class="text-white font-bold text-sm line-clamp-2 drop-shadow-lg">
                                        {{ $item['judul'] }}
                                    </h3>
                                    <p class="text-white/80 text-[11px] mt-1">
                                        {{ optional($item['tanggal'])->translatedFormat('d M Y') }}
                                    </p>
                                </div>

                                <div class="absolute top-3 right-3 inline-flex items-center gap-1.5 bg-white/20 backdrop-blur-sm rounded-full px-2 py-1 text-[10px] font-semibold text-white">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                    </svg>
                                    {{ $item['count'] }}
                                </div>

                                @if ($stackThumbs->count() > 1)
                                    <div class="absolute bottom-3 right-3 flex items-end -space-x-2">
                                        @foreach ($stackThumbs as $thumb)
                                            <div class="w-9 h-9 rounded-lg border-2 border-white shadow-lg overflow-hidden bg-white/30 backdrop-blur-sm {{ $loop->index === 0 ? 'translate-y-0' : 'translate-y-1' }}">
                                                <img src="{{ $thumb['url'] }}" alt="{{ $thumb['title'] }}" class="w-full h-full object-cover">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8 text-center sm:hidden" data-aos="fade-up">
                    <a href="{{ route('galeri.index') }}" class="inline-flex items-center gap-2 bg-white/15 text-white text-sm font-semibold px-6 py-3 rounded-xl border border-white/25 hover:border-white/35 shadow-lg transition-all">
                        Lihat Semua Galeri
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        {{-- Gallery Lightbox Modal --}}
        <div
            x-data="{
                isOpen: false,
                title: '',
                date: '',
                kategori: '',
                items: [],
                selectedIndex: 0,
                currentItem() {
                    return this.items[this.selectedIndex] || {};
                },
                open(detail) {
                    this.isOpen = true;
                    this.title = detail.title || '';
                    this.date = detail.date || '';
                    this.kategori = detail.kategori || '';
                    this.items = detail.items || [];
                    this.selectedIndex = detail.startIndex || 0;
                }
            }"
            @open-stack-preview.window="open($event.detail)"
            @keydown.escape.window="isOpen = false"
            x-show="isOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/90 backdrop-blur-sm"
            @click.self="isOpen = false">

            <div class="relative max-w-6xl w-full bg-white rounded-2xl shadow-2xl overflow-hidden" @click.stop>
                <div class="flex items-start justify-between gap-4 p-4 border-b border-slate-100 bg-slate-50/50">
                    <div class="min-w-0 flex-1 pr-4">
                        <h3 class="text-sm font-bold text-slate-900 truncate" x-text="title"></h3>
                        <div class="flex flex-wrap items-center gap-3 mt-1 text-xs text-slate-500">
                            <span class="flex items-center gap-1" x-show="date">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span x-text="date"></span>
                            </span>
                            <span class="flex items-center gap-1" x-show="kategori">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                <span x-text="kategori"></span>
                            </span>
                            <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2 py-0.5 text-slate-600 font-medium" x-show="items.length">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/>
                                </svg>
                                <span x-text="items.length + ' foto'"></span>
                            </span>
                        </div>
                    </div>
                    <button type="button" @click="isOpen = false" class="p-2 rounded-lg hover:bg-slate-200 text-slate-500 hover:text-slate-700 transition shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="grid lg:grid-cols-[1fr_320px] bg-slate-950">
                    <div class="flex items-center justify-center p-4 md:p-6 min-h-[420px]">
                        <template x-if="items.length">
                            <img :src="currentItem().url" :alt="currentItem().title || title" class="max-w-full max-h-[72vh] object-contain rounded-xl shadow-2xl bg-white/5">
                        </template>
                    </div>

                    <div class="border-t lg:border-t-0 lg:border-l border-white/10 bg-slate-900 p-4 md:p-5">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Foto Lain</p>
                                <p class="text-xs text-slate-500 mt-1">Klik thumbnail untuk berpindah</p>
                            </div>
                            <span class="text-xs text-slate-300" x-show="items.length" x-text="(selectedIndex + 1) + ' / ' + items.length"></span>
                        </div>

                        <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-2 gap-2 max-h-[72vh] overflow-y-auto pr-1">
                            <template x-for="(photo, index) in items" :key="photo.url + '-' + index">
                                <button
                                    type="button"
                                    class="relative aspect-square rounded-xl overflow-hidden border-2 transition focus:outline-none"
                                    :class="selectedIndex === index ? 'border-amber-400 ring-2 ring-amber-400/30' : 'border-white/10 hover:border-white/40'"
                                    @click="selectedIndex = index">
                                    <img :src="photo.url" :alt="photo.title || title" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/0 hover:bg-black/15 transition"></div>
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ============================================ --}}
    {{-- STATISTIK BENTO GRID - Premium Design        --}}
    {{-- ============================================ --}}
    @php $totalAlumniBeranda = $alumniBekerja + $alumniMelanjutkanStudi; @endphp
    
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 tracking-tight">
                Capaian Penyerapan Alumni
            </h2>
            <p class="text-gray-500 mt-3">Data real-time dari tracer study BKK SMKN 1 Bangsri</p>
        </div>

        {{-- Bento Grid Layout --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4" data-aos="fade-up" data-aos-delay="100">
            
            {{-- Kotak Besar: Total Alumni --}}
            <div class="col-span-2 md:col-span-2 bg-[#024CD4] text-white rounded-2xl p-8 flex flex-col justify-center relative overflow-hidden shadow-xl group">
                {{-- Decorative Elements --}}
                <div class="absolute top-0 right-0 -mr-10 -mt-10 w-48 h-48 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-48 h-48 bg-[#024CD4]/40 rounded-full blur-2xl"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-white/15 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                            </svg>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-wider text-[#d0e3ff]">Total Alumni</span>
                    </div>
                    <p class="text-6xl sm:text-7xl font-extrabold tracking-tight text-white">
                        {{ number_format($totalAlumniBeranda) }}
                    </p>
                    <p class="text-[#d0e3ff] text-sm mt-3">Alumni terdata dalam sistem</p>
                </div>
            </div>
            
            {{-- Kotak Kecil: Bekerja --}}
            <div class="bg-white border border-gray-100 rounded-2xl p-6 flex flex-col justify-between hover:border-emerald-200 hover:shadow-2xl hover:shadow-emerald-100/50 transition-all duration-300 group relative overflow-hidden">
                {{-- Hover Effect --}}
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                
                <div class="w-12 h-12 bg-[#024CD4] text-white rounded-xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-4xl font-extrabold text-gray-900 tracking-tight">{{ number_format($alumniBekerja) }}</p>
                    <p class="text-xs font-semibold text-gray-500 mt-2 uppercase tracking-wide">Sudah Bekerja</p>
                    @if ($totalAlumniBeranda > 0)
                        <div class="mt-3 bg-emerald-50 rounded-full px-3 py-1 inline-block">
                            <p class="text-xs text-emerald-600 font-bold">{{ round($alumniBekerja / $totalAlumniBeranda * 100) }}%</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Kotak Kecil: Melanjutkan Studi --}}
            <div class="bg-white border border-gray-100 rounded-2xl p-6 flex flex-col justify-between hover:border-amber-200 hover:shadow-2xl hover:shadow-amber-100/50 transition-all duration-300 group relative overflow-hidden">
                {{-- Hover Effect --}}
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-amber-400 to-amber-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                
                <div class="w-12 h-12 bg-[#024CD4] text-white rounded-xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                    </svg>
                </div>
                <div>
                    <p class="text-4xl font-extrabold text-gray-900 tracking-tight">{{ number_format($alumniMelanjutkanStudi) }}</p>
                    <p class="text-xs font-semibold text-gray-500 mt-2 uppercase tracking-wide">Melanjutkan Studi</p>
                    @if ($totalAlumniBeranda > 0)
                        <div class="mt-3 bg-amber-50 rounded-full px-3 py-1 inline-block">
                            <p class="text-xs text-amber-600 font-bold">{{ round($alumniMelanjutkanStudi / $totalAlumniBeranda * 100) }}%</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Kotak Lebar: Mitra Aktif --}}
            <div class="col-span-2 md:col-span-2 bg-white border border-gray-100 rounded-2xl p-8 flex items-center justify-between hover:border-[#024CD4]/40 hover:shadow-2xl hover:shadow-[#024CD4]/20 transition-all duration-300 group relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#024CD4]/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                
                <div class="flex items-center gap-5 relative z-10">
                    <div class="w-16 h-16 bg-[#024CD4] text-white rounded-2xl flex items-center justify-center shadow-xl group-hover:scale-110 group-hover:rotate-6 transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-[#024CD4] uppercase tracking-wider mb-1">Mitra Aktif</p>
                        <p class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ $mitra->count() ?? 0 }}+ Perusahaan</p>
                    </div>
                </div>
            </div>

            {{-- Kotak Lebar: Statistik Alumni --}}
            <div class="col-span-2 md:col-span-2 bg-white border border-gray-100 rounded-2xl p-8 flex items-center justify-between hover:border-[#024CD4]/40 hover:shadow-2xl hover:shadow-[#024CD4]/20 transition-all duration-300 group relative overflow-hidden">
                <div class="absolute top-0 left-0 w-32 h-32 bg-[#024CD4]/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                
                <div class="flex items-center gap-5 relative z-10">
                    <div class="w-16 h-16 bg-[#024CD4] text-white rounded-2xl flex items-center justify-center shadow-xl group-hover:scale-110 group-hover:rotate-6 transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Detail Statistik</p>
                        <p class="text-3xl font-extrabold text-gray-900 tracking-tight">Lihat capaian alumni</p>
                    </div>
                </div>
                <a href="{{ route('statistik.index') }}" class="hidden sm:inline-flex items-center gap-2 text-sm font-semibold text-[#024CD4] hover:text-[#013ba8] bg-[#024CD4]/10 hover:bg-[#024CD4]/20 px-4 py-2 rounded-lg border border-[#024CD4]/30 transition-all relative z-10">
                    Buka Statistik
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ============================================ --}}
    {{-- CUSTOM CSS (Animations & Effects)            --}}
    {{-- ============================================ --}}
    @push('styles')
    <style>
        /* Infinite Marquee Animation */
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .marquee {
            animation: marquee 30s linear infinite;
            width: max-content;
            will-change: transform;
        }

        /* Floating Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            25% { transform: translateY(-20px) rotate(90deg); }
            50% { transform: translateY(-40px) rotate(180deg); }
            75% { transform: translateY(-20px) rotate(270deg); }
        }
        .animate-float {
            animation: float linear infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #024CD4;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #013ba8;
        }

        /* Line Clamp Utility */
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    @endpush

</x-layouts.public>
