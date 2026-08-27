<x-layouts.public title="Beranda">

    @php
        $heroBadge = $pengaturanWebsite->hero_badge ?: 'BKK SMKN 1 Bangsri';
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
    {{-- HERO SECTION (Gradient Mesh + Glassmorphism) --}}
    {{-- ============================================ --}}
    <section class="relative bg-blue-50 overflow-hidden">
        
        {{-- Gradient Mesh Background --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute -bottom-40 -left-40 w-[500px] h-[500px] bg-amber-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] bg-cyan-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 grid lg:grid-cols-2 gap-12 items-center">
            
            {{-- Hero Content --}}
            <div class="max-w-2xl" data-aos="fade-right" data-aos-duration="1000">
                {{-- Glassmorphism Badge --}}
                <span class="inline-flex items-center gap-1.5 bg-white/70 backdrop-blur-md border border-white/40 text-amber-700 text-xs font-bold px-4 py-1.5 rounded-full mb-6 shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ $heroBadge }}
                </span>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-[1.1] tracking-tight mb-6">
                    {{ $heroTitlePrefix }} 
                    <span class="text-blue-600 relative inline-block">
                        {{ $heroTitleHighlight }}
                        <svg class="absolute -bottom-2 left-0 w-full" viewBox="0 0 200 8" fill="none">
                            <path d="M0 4 Q50 0 100 4 T200 4" stroke="#f59e0b" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                    </span> 
                    {{ $heroTitleSuffix }}
                </h1>
                
                <p class="text-gray-600 text-lg leading-relaxed mb-8 max-w-xl">
                    {{ $heroDescription }}
                </p>
                
                <div class="flex flex-wrap gap-4 mb-10">
                    <a href="{{ $heroPrimaryUrl }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-3.5 rounded-xl shadow-lg shadow-blue-600/20 transition-all duration-200 hover:-translate-y-0.5">
                        {{ $heroPrimaryLabel }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="{{ $heroSecondaryUrl }}" class="inline-flex items-center gap-2 bg-white/70 backdrop-blur-md border border-gray-200 hover:bg-white hover:border-gray-300 text-gray-700 text-sm font-semibold px-6 py-3.5 rounded-xl transition-all duration-200">
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
                        <span class="inline-flex items-center gap-2 bg-white/60 backdrop-blur-sm border border-white/60 px-3 py-1.5 rounded-full text-xs font-medium text-gray-700 shadow-sm">
                            <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $feature['icon'] }}"/>
                            </svg>
                            {{ $feature['text'] }}
                        </span>
                    @endforeach
                </div>
            </div>

            {{-- Hero Image --}}
            <div class="relative lg:pl-8" data-aos="fade-left" data-aos-duration="1000">
                <div class="rounded-2xl overflow-hidden shadow-2xl shadow-blue-900/10 bg-white ring-1 ring-gray-900/5">
                    @if ($heroImageUrl)
                        <img src="{{ $heroImageUrl }}" alt="Foto beranda utama" class="w-full h-72 sm:h-96 object-cover">
                    @else
                        <svg viewBox="0 0 960 720" class="w-full h-72 sm:h-96 block" xmlns="http://www.w3.org/2000/svg">
                            <rect width="960" height="720" rx="40" fill="#EFF6FF" />
                            <circle cx="780" cy="120" r="110" fill="#FDE68A" fill-opacity="0.75" />
                            <circle cx="160" cy="620" r="140" fill="#BFDBFE" fill-opacity="0.7" />
                            <path d="M120 520C200 410 310 370 430 370C550 370 640 420 760 320C822 268 870 238 920 220V720H120V520Z" fill="#1D4ED8" fill-opacity="0.12" />
                            <rect x="110" y="120" width="740" height="460" rx="32" fill="white" opacity="0.8" />
                            <rect x="150" y="160" width="260" height="20" rx="10" fill="#DBEAFE" />
                            <rect x="150" y="202" width="370" height="22" rx="11" fill="#93C5FD" />
                            <rect x="150" y="370" width="220" height="140" rx="24" fill="#DBEAFE" />
                            <rect x="402" y="370" width="220" height="140" rx="24" fill="#FEF3C7" />
                            <rect x="654" y="370" width="120" height="140" rx="24" fill="#E0F2FE" />
                            <circle cx="260" cy="435" r="34" fill="#2563EB" />
                            <circle cx="512" cy="435" r="34" fill="#F59E0B" />
                            <circle cx="714" cy="435" r="34" fill="#0EA5E9" />
                            <path d="M250 435L258 443L273 426" stroke="white" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M502 435L510 443L525 426" stroke="white" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M704 435L712 443L727 426" stroke="white" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    @endif
                </div>
                {{-- Floating Glass Card --}}
                <div class="absolute -bottom-6 -left-6 bg-white/80 backdrop-blur-md border border-white/60 rounded-xl shadow-xl p-4 hidden sm:flex items-center gap-3" data-aos="fade-up" data-aos-delay="600">
                    <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Mitra Terpercaya</p>
                        <p class="text-sm font-bold text-gray-900">{{ $mitra->count() ?? 0 }}+ Perusahaan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================ --}}
    {{-- INFINITE MARQUEE - LOGO MITRA                --}}
    {{-- ============================================ --}}
    <section class="bg-white border-y border-gray-100 py-10 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 text-center">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-[0.2em]" data-aos="fade-up">Dipercaya oleh perusahaan terkemuka</p>
        </div>
        
        <div class="relative">
            {{-- Fade edges --}}
            <div class="absolute left-0 top-0 bottom-0 w-24 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 w-24 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>
            
            <div class="marquee flex gap-12 items-center">
                {{-- Duplikasi logo untuk seamless loop --}}
                @foreach ([$mitra, $mitra] as $group)
                    @foreach ($group as $item)
                        <div class="flex-shrink-0 w-32 h-16 flex items-center justify-center grayscale hover:grayscale-0 transition-all duration-300 opacity-60 hover:opacity-100">
                            @if ($item->logo)
                                <img src="{{ Storage::url($item->logo) }}" class="max-w-full max-h-full object-contain" alt="{{ $item->nama_perusahaan }}">
                            @else
                                <span class="text-sm font-bold text-gray-400">{{ strtoupper(substr($item->nama_perusahaan, 0, 2)) }}</span>
                            @endif
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================ --}}
    {{-- QUICK LINKS (Glassmorphism)                  --}}
    {{-- ============================================ --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20 mb-16" data-aos="fade-up">
        <div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-xl border border-white/60 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 divide-y sm:divide-y-0 sm:divide-x divide-gray-100/80">
            @foreach ([
                ['label' => 'Lowongan Pekerjaan', 'desc' => 'Temukan peluang kerja', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'url' => route('lowongan.index')],
                ['label' => 'Artikel Dunia Kerja', 'desc' => 'Tips & informasi terkini', 'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z', 'url' => route('artikel.index')],
                ['label' => 'Galeri Kegiatan', 'desc' => 'Dokumentasi BKK terbaru', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z', 'url' => route('galeri.index')],
                ['label' => 'Mitra Perusahaan', 'desc' => 'Rekanan terbaik kami', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'url' => route('lowongan.index')],
                ['label' => 'Statistik Alumni', 'desc' => 'Data penyerapan alumni', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'url' => route('statistik.index')],
            ] as $item)
                <a href="{{ $item['url'] }}" class="group p-5 flex items-start gap-4 hover:bg-white/50 transition-colors duration-200">
                    <span class="w-11 h-11 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0 group-hover:bg-blue-600 group-hover:text-white group-hover:scale-110 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                        </svg>
                    </span>
                    <div>
                        <span class="block text-sm font-bold text-gray-800 group-hover:text-blue-700 transition-colors">{{ $item['label'] }}</span>
                        <span class="block text-xs text-gray-500 mt-1 leading-relaxed">{{ $item['desc'] }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- ============================================ --}}
    {{-- LOWONGAN UNGGULAN                            --}}
    {{-- ============================================ --}}
    @if ($lowonganUnggulan->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="flex items-center justify-between mb-6" data-aos="fade-up">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            Lowongan Unggulan
                        </h2>
                        <a href="{{ route('lowongan.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 hover:underline flex items-center gap-1">
                            Lihat Semua 
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                    
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        @foreach ($lowonganUnggulan as $index => $item)
                            <div class="bg-white border border-gray-100 rounded-2xl p-5 hover:shadow-xl hover:border-blue-100 hover:-translate-y-1 transition-all duration-300 flex flex-col" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 text-xs font-bold overflow-hidden flex-shrink-0 ring-1 ring-blue-100">
                                        @if ($item->mitra->logo)
                                            <img src="{{ Storage::url($item->mitra->logo) }}" class="w-full h-full object-cover" alt="{{ $item->mitra->nama_perusahaan }}">
                                        @else
                                            {{ strtoupper(substr($item->mitra->nama_perusahaan, 0, 2)) }}
                                        @endif
                                    </div>
                                    <p class="font-semibold text-gray-800 text-sm line-clamp-1" title="{{ $item->mitra->nama_perusahaan }}">{{ $item->mitra->nama_perusahaan }}</p>
                                </div>
                                <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 min-h-[3rem]">{{ $item->posisi }}</h3>
                                <div class="flex items-center gap-1.5 text-xs text-gray-500 mb-4">
                                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $item->lokasi }}
                                </div>
                                <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between">
                                    <span class="inline-block text-xs font-medium bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md">{{ $item->jenis_pekerjaan }}</span>
                                    <a href="{{ route('lowongan.show', $item) }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700 flex items-center gap-1">
                                        Detail <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- CTA Box --}}
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl p-8 text-white flex flex-col justify-between shadow-xl shadow-blue-600/20 relative overflow-hidden" data-aos="fade-left">
                    <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-40 h-40 bg-amber-400/20 rounded-full blur-2xl"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center mb-6 backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-3 leading-tight">Saatnya Raih Karier Impianmu!</h3>
                        <p class="text-blue-100 text-sm leading-relaxed">Temukan ribuan lowongan kerja terbaik dari perusahaan terpercaya.</p>
                    </div>
                    <a href="{{ route('lowongan.index') }}" class="relative z-10 inline-flex items-center justify-center gap-2 bg-amber-400 hover:bg-amber-500 text-amber-950 text-sm font-bold px-6 py-3.5 rounded-xl w-full transition-all duration-200 hover:shadow-lg mt-6">
                        Cari Lowongan Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- ============================================ --}}
    {{-- LOWONGAN & ARTIKEL TERBARU                   --}}
    {{-- ============================================ --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 lg:pb-20 grid lg:grid-cols-2 gap-8 lg:gap-12">
        {{-- Lowongan Terbaru --}}
        <div data-aos="fade-up">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Lowongan Terbaru</h2>
                <a href="{{ route('lowongan.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 hover:underline flex items-center gap-1">
                    Lihat Semua <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm divide-y divide-gray-50 overflow-hidden">
                @forelse ($lowonganTerbaru as $item)
                    <a href="{{ route('lowongan.show', $item) }}" class="flex items-center justify-between gap-4 p-4 hover:bg-blue-50/50 transition-colors duration-200 group">
                        <span class="flex items-center gap-3 min-w-0">
                            <span class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 text-xs font-bold overflow-hidden flex-shrink-0 ring-1 ring-blue-100">
                                @if ($item->mitra->logo)
                                    <img src="{{ Storage::url($item->mitra->logo) }}" class="w-full h-full object-cover" alt="{{ $item->mitra->nama_perusahaan }}">
                                @else
                                    {{ strtoupper(substr($item->mitra->nama_perusahaan, 0, 2)) }}
                                @endif
                            </span>
                            <span class="min-w-0">
                                <span class="block text-sm font-bold text-gray-800 group-hover:text-blue-700 transition-colors line-clamp-1">{{ $item->posisi }}</span>
                                <span class="block text-xs text-gray-500 truncate">{{ $item->mitra->nama_perusahaan }} · {{ $item->lokasi }}</span>
                            </span>
                        </span>
                        <span class="text-xs font-medium bg-gray-100 text-gray-600 px-2.5 py-1 rounded-md whitespace-nowrap group-hover:bg-blue-100 group-hover:text-blue-700 transition-colors">
                            {{ $item->jenis_pekerjaan }}
                        </span>
                    </a>
                @empty
                    <div class="p-8 text-center">
                        <p class="text-sm text-gray-400">Belum ada lowongan terbaru.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Artikel Terbaru --}}
        <div data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Artikel Terbaru</h2>
                <a href="{{ route('artikel.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 hover:underline flex items-center gap-1">
                    Lihat Semua <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm divide-y divide-gray-50 overflow-hidden">
                @forelse ($artikelTerbaru as $item)
                    <a href="{{ route('artikel.show', $item) }}" class="flex items-center gap-4 p-4 hover:bg-blue-50/50 transition-colors duration-200 group">
                        <div class="w-16 h-16 rounded-xl bg-gray-100 flex-shrink-0 overflow-hidden ring-1 ring-gray-100">
                            @if ($item->gambar)
                                <img src="{{ Storage::url($item->gambar) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="{{ $item->judul }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                        </div>
                        <span class="min-w-0 flex-1">
                            <span class="block text-sm font-bold text-gray-800 group-hover:text-blue-700 transition-colors line-clamp-2 leading-snug">{{ $item->judul }}</span>
                            <span class="flex items-center gap-1.5 text-xs text-gray-400 mt-1.5">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $item->created_at->translatedFormat('d M Y') }}
                            </span>
                        </span>
                    </a>
                @empty
                    <div class="p-8 text-center">
                        <p class="text-sm text-gray-400">Belum ada artikel terbaru.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ============================================ --}}
    {{-- STATISTIK BENTO GRID                         --}}
    {{-- ============================================ --}}
    @php $totalAlumniBeranda = $alumniBekerja + $alumniMelanjutkanStudi + $alumniBelumBekerja; @endphp
    
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="text-center mb-10" data-aos="fade-up">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">Capaian Penyerapan Alumni</h2>
            <p class="text-gray-500 mt-2">Data real-time dari tracer study BKK SMKN 1 Bangsri</p>
        </div>

        {{-- Bento Grid Layout --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4" data-aos="fade-up" data-aos-delay="100">
            
            {{-- Kotak Besar: Total Alumni --}}
            <div class="col-span-2 md:col-span-2 bg-gradient-to-br from-blue-600 to-blue-700 text-white rounded-2xl p-6 sm:p-8 flex flex-col justify-center relative overflow-hidden shadow-xl shadow-blue-600/20">
                <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-wider text-blue-100">Total Alumni</span>
                    </div>
                    <p class="text-5xl sm:text-6xl font-extrabold tracking-tight">{{ number_format($totalAlumniBeranda) }}</p>
                    <p class="text-blue-100 text-sm mt-2">Alumni terdata dalam sistem</p>
                </div>
            </div>
            
            {{-- Kotak Kecil: Bekerja --}}
            <div class="bg-white border border-gray-100 rounded-2xl p-5 sm:p-6 flex flex-col justify-between hover:border-blue-200 hover:shadow-lg transition-all duration-300 group">
                <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ number_format($alumniBekerja) }}</p>
                    <p class="text-xs font-semibold text-gray-500 mt-1 uppercase tracking-wide">Sudah Bekerja</p>
                    @if ($totalAlumniBeranda > 0)
                        <p class="text-xs text-emerald-600 font-bold mt-1">{{ round($alumniBekerja / $totalAlumniBeranda * 100) }}%</p>
                    @endif
                </div>
            </div>

            {{-- Kotak Kecil: Melanjutkan Studi --}}
            <div class="bg-white border border-gray-100 rounded-2xl p-5 sm:p-6 flex flex-col justify-between hover:border-amber-200 hover:shadow-lg transition-all duration-300 group">
                <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                </div>
                <div>
                    <p class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ number_format($alumniMelanjutkanStudi) }}</p>
                    <p class="text-xs font-semibold text-gray-500 mt-1 uppercase tracking-wide">Kuliah</p>
                    @if ($totalAlumniBeranda > 0)
                        <p class="text-xs text-amber-600 font-bold mt-1">{{ round($alumniMelanjutkanStudi / $totalAlumniBeranda * 100) }}%</p>
                    @endif
                </div>
            </div>

            {{-- Kotak Lebar: Mitra Aktif --}}
            <div class="col-span-2 md:col-span-2 bg-gradient-to-br from-amber-50 to-white border border-amber-100 rounded-2xl p-6 flex items-center justify-between hover:shadow-lg transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-amber-400 text-amber-900 rounded-xl flex items-center justify-center shadow-md shadow-amber-400/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-amber-700 uppercase tracking-wider">Mitra Aktif</p>
                        <p class="text-2xl font-extrabold text-gray-900 tracking-tight">{{ $mitra->count() ?? 0 }}+ Perusahaan</p>
                    </div>
                </div>
                <a href="{{ route('lowongan.index') }}" class="hidden sm:inline-flex items-center gap-1 text-sm font-semibold text-amber-700 hover:text-amber-800">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            {{-- Kotak Lebar: Belum Bekerja --}}
            <div class="col-span-2 md:col-span-2 bg-white border border-gray-100 rounded-2xl p-6 flex items-center justify-between hover:border-gray-200 hover:shadow-lg transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gray-100 text-gray-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Menunggu Kerja</p>
                        <p class="text-2xl font-extrabold text-gray-900 tracking-tight">{{ number_format($alumniBelumBekerja) }}</p>
                    </div>
                </div>
                <a href="{{ route('statistik.index') }}" class="hidden sm:inline-flex items-center gap-1 text-sm font-semibold text-blue-600 hover:text-blue-700">
                    Detail Statistik
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ============================================ --}}
    {{-- CUSTOM CSS (Marquee & Blob Animation)        --}}
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
        }
        .marquee:hover {
            animation-play-state: paused;
        }

        /* Blob Animation for Gradient Mesh */
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
        .animate-blob {
            animation: blob 12s infinite ease-in-out;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
    @endpush

</x-layouts.public>