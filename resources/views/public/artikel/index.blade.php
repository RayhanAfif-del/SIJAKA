<x-layouts.public title="Artikel Dunia Kerja">

    @php
        $kategoriColors = [
            'tips'        => ['bg' => 'bg-blue-50',    'text' => 'text-blue-700',    'border' => 'border-blue-200'],
            'karir'       => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200'],
            'info'        => ['bg' => 'bg-amber-50',   'text' => 'text-amber-700',   'border' => 'border-amber-200'],
            'berita'      => ['bg' => 'bg-violet-50',  'text' => 'text-violet-700',  'border' => 'border-violet-200'],
            'lowongan'    => ['bg' => 'bg-rose-50',    'text' => 'text-rose-700',    'border' => 'border-rose-200'],
            'pengembangan' => ['bg' => 'bg-cyan-50',   'text' => 'text-cyan-700',    'border' => 'border-cyan-200'],
        ];
    @endphp

    {{-- Hero Section --}}
    <section class="relative bg-slate-900 text-white overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-slate-900 to-slate-900"></div>
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 32px 32px;"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20" data-aos="fade-up">
            <nav class="flex items-center gap-2 text-sm text-blue-200 mb-6">
                <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white font-medium">Artikel Dunia Kerja</span>
            </nav>
            
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight mb-4">
                Artikel <span class="text-blue-400">Dunia Kerja</span>
            </h1>
            <p class="text-blue-100 text-lg leading-relaxed max-w-2xl">
                Temukan informasi, tips, dan inspirasi seputar dunia kerja, karier, dan pengembangan diri dari para ahli.
            </p>
        </div>
    </section>

    {{-- Search Bar (Floating) --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10 mb-12" data-aos="fade-up">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6">
            <form method="GET" action="{{ route('artikel.index') }}" class="grid gap-4 lg:grid-cols-[1fr_auto] items-end">
                <div>
                    <label for="cari" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Kata Kunci</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input id="cari" type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari judul, kategori, atau isi artikel..." class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition outline-none">
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="flex-1 lg:flex-none inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Cari
                    </button>
                    @if (request()->filled('cari'))
                        <a href="{{ route('artikel.index') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 px-4 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-50 hover:border-gray-300" title="Reset Pencarian">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        </a>
                    @endif
                </div>
            </form>

            @if (request()->filled('cari'))
                <div class="mt-4 pt-4 border-t border-gray-100 flex flex-wrap items-center gap-2 text-xs">
                    <span class="font-semibold text-gray-700">Filter aktif:</span>
                    <span class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-3 py-1 text-blue-700 border border-blue-100">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        {{ request('cari') }}
                    </span>
                    <span class="ml-auto text-gray-500 font-medium">{{ $artikel->total() }} artikel ditemukan</span>
                </div>
            @endif
        </div>
    </section>

    {{-- Articles Magazine Layout --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        @php
            $artikelItems = $artikel->getCollection();
            $showFeatured = $artikel->currentPage() === 1 && !request()->filled('cari') && $artikelItems->isNotEmpty();
            $gridItems = $showFeatured ? $artikelItems->slice(1) : $artikelItems;
        @endphp

        @if ($artikelItems->isEmpty())
            <div class="py-16 text-center" data-aos="fade-up">
                <div class="max-w-md mx-auto">
                    <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-5">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        @if (request()->filled('cari'))
                            Tidak Ada Hasil
                        @else
                            Belum Ada Artikel
                        @endif
                    </h3>
                    <p class="text-gray-500 leading-relaxed mb-6">
                        @if (request()->filled('cari'))
                            Tidak ditemukan artikel yang cocok dengan kata kunci "{{ request('cari') }}". Coba kata kunci lain atau reset pencarian.
                        @else
                            Artikel dunia kerja akan segera tersedia. Silakan kunjungi kami kembali nanti untuk tips dan informasi terbaru.
                        @endif
                    </p>
                    @if (request()->filled('cari'))
                        <a href="{{ route('artikel.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-xl transition shadow-lg shadow-slate-900/10">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            Reset Pencarian
                        </a>
                    @else
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-xl transition shadow-lg shadow-slate-900/10">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Kembali ke Beranda
                        </a>
                    @endif
                </div>
            </div>
        @else
            @if ($showFeatured)
                @php
                    $item = $artikelItems->first();
                    $kategoriKey = strtolower($item->kategori ?? '');
                    $kc = $kategoriColors[$kategoriKey] ?? ['bg' => 'bg-slate-100', 'text' => 'text-slate-700', 'border' => 'border-slate-200'];
                @endphp

                <article class="group bg-white rounded-3xl border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-500 mb-10" data-aos="fade-up">
                    <div class="grid lg:grid-cols-2 gap-0">
                        <a href="{{ route('artikel.show', $item) }}" class="relative block h-64 lg:h-auto bg-gradient-to-br from-blue-50 to-slate-100 overflow-hidden">
                            @if ($item->gambar)
                                <img src="{{ Storage::url($item->gambar) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $item->judul }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-24 h-24 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                </div>
                            @endif

                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center gap-1.5 bg-white/90 backdrop-blur-sm text-slate-900 text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                                    <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    Terbaru
                                </span>
                            </div>
                        </a>

                        <div class="p-8 lg:p-10 flex flex-col justify-center">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="inline-flex items-center gap-1.5 {{ $kc['bg'] }} {{ $kc['text'] }} border {{ $kc['border'] }} text-xs font-semibold px-3 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                    {{ $item->kategori ?: 'Umum' }}
                                </span>
                                <span class="text-xs text-gray-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $item->created_at->translatedFormat('d M Y') }}
                                </span>
                            </div>

                            <a href="{{ route('artikel.show', $item) }}" class="block mb-4">
                                <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 leading-tight group-hover:text-blue-700 transition-colors">
                                    {{ $item->judul }}
                                </h2>
                            </a>

                            <p class="text-gray-600 text-base leading-relaxed mb-6 line-clamp-3">
                                {{ Str::limit(strip_tags($item->konten), 200) }}
                            </p>

                            <a href="{{ route('artikel.show', $item) }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold transition group/link">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endif

            @if ($gridItems->isNotEmpty())
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($gridItems as $index => $item)
                        @php
                            $kategoriKey = strtolower($item->kategori ?? '');
                            $kc = $kategoriColors[$kategoriKey] ?? ['bg' => 'bg-slate-100', 'text' => 'text-slate-700', 'border' => 'border-slate-200'];
                        @endphp

                        <article class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl hover:border-blue-100 hover:-translate-y-1 transition-all duration-300 flex flex-col" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                            <a href="{{ route('artikel.show', $item) }}" class="relative block h-48 bg-gradient-to-br from-blue-50 to-slate-100 overflow-hidden">
                                @if ($item->gambar)
                                    <img src="{{ Storage::url($item->gambar) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $item->judul }}">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-16 h-16 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                    </div>
                                @endif

                                <span class="absolute top-3 left-3 inline-flex items-center gap-1.5 {{ $kc['bg'] }} {{ $kc['text'] }} border {{ $kc['border'] }} text-xs font-semibold px-2.5 py-1 rounded-full backdrop-blur-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-current opacity-60"></span>
                                    {{ $item->kategori ?: 'Umum' }}
                                </span>
                            </a>

                            <div class="p-5 flex flex-col flex-1">
                                <a href="{{ route('artikel.show', $item) }}" class="block mb-3">
                                    <h3 class="font-bold text-gray-900 text-lg leading-snug line-clamp-2 group-hover:text-blue-700 transition-colors">
                                        {{ $item->judul }}
                                    </h3>
                                </a>

                                <p class="text-sm text-gray-500 mb-4 line-clamp-2 leading-relaxed flex-1">
                                    {{ Str::limit(strip_tags($item->konten), 120) }}
                                </p>

                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <span class="inline-flex items-center gap-1.5 text-xs text-gray-400">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $item->created_at->translatedFormat('d M Y') }}
                                    </span>
                                    <a href="{{ route('artikel.show', $item) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-blue-600 hover:text-blue-700 transition group/btn">
                                        Baca
                                        <svg class="w-3.5 h-3.5 transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        @endif

        {{-- Pagination --}}
        @if ($artikel->hasPages())
            <div class="mt-12 flex justify-center" data-aos="fade-up">
                {{ $artikel->links() }}
            </div>
        @endif
    </section>

</x-layouts.public>
