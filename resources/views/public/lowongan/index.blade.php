<x-layouts.public title="Lowongan Pekerjaan">

    {{-- Hero Section --}}
    <section class="relative bg-slate-900 text-white overflow-hidden">
        {{-- Decorative Background --}}
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-slate-900 to-slate-900"></div>
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 32px 32px;"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20" data-aos="fade-up">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-blue-200 mb-6">
                <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white font-medium">Lowongan Pekerjaan</span>
            </nav>
            
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight mb-4">
                Lowongan <span class="text-blue-400">Pekerjaan</span>
            </h1>
            <p class="text-blue-100 text-lg leading-relaxed max-w-2xl">
                Temukan peluang kerja terbaik dan terbaru dari perusahaan mitra terpercaya SIJAKA SMK N 1 Bangsri.
            </p>
        </div>
    </section>

    {{-- Search & Filter Bar (Floating) --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10 mb-12" data-aos="fade-up">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6">
            <form method="GET" action="{{ route('lowongan.index') }}" class="grid gap-4 lg:grid-cols-[1fr_240px_auto] items-end">
                <div>
                    <label for="cari" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Kata Kunci</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input id="cari" type="text" name="cari" value="{{ request('cari') }}" placeholder="Posisi, perusahaan, atau keahlian..." class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition outline-none">
                    </div>
                </div>

                <div>
                    <label for="lokasi" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Lokasi</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <select id="lokasi" name="lokasi" class="w-full pl-10 pr-8 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition outline-none appearance-none bg-white cursor-pointer">
                            <option value="">Semua Lokasi</option>
                            @foreach ($daftarLokasi as $lokasi)
                                <option value="{{ $lokasi }}" @selected(request('lokasi') === $lokasi)>{{ $lokasi }}</option>
                            @endforeach
                        </select>
                        <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="flex-1 lg:flex-none inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Cari
                    </button>
                    @if (request()->filled('cari') || request()->filled('lokasi'))
                        <a href="{{ route('lowongan.index') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 px-4 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-50 hover:border-gray-300" title="Reset Filter">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        </a>
                    @endif
                </div>
            </form>

            {{-- Active Filters Display --}}
            @if (request()->filled('cari') || request()->filled('lokasi'))
                <div class="mt-4 pt-4 border-t border-gray-100 flex flex-wrap items-center gap-2 text-xs">
                    <span class="font-semibold text-gray-700">Filter aktif:</span>
                    @if (request()->filled('cari'))
                        <span class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-3 py-1 text-blue-700 border border-blue-100">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            {{ request('cari') }}
                        </span>
                    @endif
                    @if (request()->filled('lokasi'))
                        <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-3 py-1 text-amber-700 border border-amber-100">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ request('lokasi') }}
                        </span>
                    @endif
                    <span class="ml-auto text-gray-500 font-medium">{{ $lowongan->total() }} hasil ditemukan</span>
                </div>
            @endif
        </div>
    </section>

    {{-- Job Listings Grid --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($lowongan as $item)
                <div class="group bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-xl hover:border-blue-100 hover:-translate-y-1 transition-all duration-300 flex flex-col" data-aos="fade-up">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 text-sm font-bold overflow-hidden flex-shrink-0 ring-1 ring-blue-100 group-hover:scale-105 transition-transform duration-300">
                                @if ($item->mitra->logo)
                                    <img src="{{ Storage::url($item->mitra->logo) }}" class="w-full h-full object-cover" alt="{{ $item->mitra->nama_perusahaan }}">
                                @else
                                    {{ strtoupper(substr($item->mitra->nama_perusahaan, 0, 2)) }}
                                @endif
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 text-sm line-clamp-1" title="{{ $item->mitra->nama_perusahaan }}">{{ $item->mitra->nama_perusahaan }}</p>
                                <p class="text-xs text-gray-500 flex items-center gap-1 mt-0.5">
                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $item->lokasi }}
                                </p>
                            </div>
                        </div>
                        <span class="text-[10px] text-gray-400 whitespace-nowrap">{{ $item->created_at->diffForHumans() }}</span>
                    </div>
                    
                    <h3 class="font-bold text-gray-900 text-lg mb-3 line-clamp-2 group-hover:text-blue-700 transition-colors">{{ $item->posisi }}</h3>
                    
                    <div class="flex flex-wrap gap-2 mb-5">
                        <span class="inline-flex items-center gap-1 text-xs font-medium bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md border border-blue-100">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            {{ $item->jenis_pekerjaan }}
                        </span>
                        @if ($item->gaji)
                            <span class="inline-flex items-center gap-1 text-xs font-medium bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-md border border-emerald-100">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $item->gaji }}
                            </span>
                        @endif
                    </div>

                    <a href="{{ route('lowongan.show', $item) }}" class="mt-auto inline-flex items-center justify-center gap-2 w-full bg-slate-900 hover:bg-blue-600 text-white text-sm font-semibold py-2.5 rounded-xl transition-all duration-200 group-hover:shadow-lg group-hover:shadow-blue-600/20">
                        Lihat Detail
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            @empty
                {{-- Empty State --}}
                <div class="col-span-full py-16 text-center" data-aos="fade-up">
                    <div class="max-w-md mx-auto">
                        <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-5">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Lowongan</h3>
                        <p class="text-gray-500 leading-relaxed mb-6">Saat ini belum ada lowongan pekerjaan yang tersedia. Silakan cek kembali nanti atau hubungi kami untuk informasi lebih lanjut.</p>
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-xl transition shadow-lg shadow-slate-900/10">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($lowongan->hasPages())
            <div class="mt-12 flex justify-center" data-aos="fade-up">
                {{ $lowongan->links() }}
            </div>
        @endif
    </section>

</x-layouts.public>