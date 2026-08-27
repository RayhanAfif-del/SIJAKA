<x-layouts.public title="Struktur Organisasi">

    {{-- Hero Section --}}
    <section class="relative bg-slate-900 text-white overflow-hidden">
        {{-- Decorative Background --}}
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-slate-900 to-slate-900"></div>
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 32px 32px;"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20" data-aos="fade-up">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-blue-200 mb-6 flex-wrap">
                <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('profil.index') }}" class="hover:text-white transition">Profil SIJAKA</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white font-medium">Struktur Organisasi</span>
            </nav>
            
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight mb-4">
                Struktur <span class="text-blue-400">Organisasi</span>
            </h1>
            <p class="text-blue-100 text-lg leading-relaxed max-w-2xl">
                Susunan pengurus BKK SIJAKA SMK N 1 Bangsri yang bertanggung jawab menjalankan layanan informasi karier dan menjembatani siswa dengan dunia industri.
            </p>

            {{-- Info Bar --}}
            @if ($struktur->isNotEmpty())
                <div class="mt-8 inline-flex items-center gap-3 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl px-5 py-3">
                    <div class="w-10 h-10 rounded-lg bg-blue-500/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-blue-200 font-medium">Total Pengurus</p>
                        <p class="text-lg font-bold text-white">{{ $struktur->count() }} Orang</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- Struktur Organisasi Grid --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
        
        @if ($struktur->isNotEmpty())
            
            {{-- Header Section --}}
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold uppercase tracking-wider mb-3">Tim Pengurus</span>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Kenali Tim Kami</h2>
                <p class="text-gray-500 mt-3 max-w-2xl mx-auto">Setiap anggota tim kami berkomitmen untuk memberikan layanan terbaik dalam menjembatani siswa dan alumni dengan dunia kerja.</p>
            </div>

            @if ($struktur->count() > 1)
                {{-- 1. Featured First Item (Misal: Kepala BKK) --}}
                @php $firstItem = $struktur->first(); @endphp
                <div class="mb-12" data-aos="fade-up">
                    <div class="max-w-md mx-auto">
                        <div class="group bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl p-8 text-white text-center shadow-xl shadow-blue-600/20 relative overflow-hidden">
                            <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                            <div class="relative z-10">
                                <div class="relative w-28 h-28 mx-auto mb-5">
                                    <div class="absolute inset-0 bg-white/20 rounded-full transform group-hover:scale-105 transition-transform duration-300"></div>
                                    <div class="relative w-full h-full rounded-full overflow-hidden ring-4 ring-white/30 shadow-lg">
                                        @if ($firstItem->foto)
                                            <img src="{{ Storage::url($firstItem->foto) }}" class="w-full h-full object-cover" alt="{{ $firstItem->nama }}">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-white font-bold text-2xl bg-blue-500/50">
                                                {{ collect(explode(' ', $firstItem->nama))->map(fn ($w) => strtoupper($w[0] ?? ''))->take(2)->implode('') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <h3 class="font-bold text-white text-xl mb-2">{{ $firstItem->nama }}</h3>
                                <span class="text-xs font-bold text-blue-100 bg-white/20 backdrop-blur-sm inline-block px-4 py-1.5 rounded-full uppercase tracking-wider">
                                    {{ $firstItem->jabatan }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 2. Grid untuk Sisa Pengurus --}}
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($struktur->skip(1) as $index => $item)
                        @php $delay = min(($index + 1) * 50, 400); @endphp
                        <div class="group bg-white rounded-2xl border border-gray-100 p-6 text-center hover:shadow-xl hover:border-blue-100 hover:-translate-y-1 transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $delay }}">
                            <div class="relative w-24 h-24 mx-auto mb-5">
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-full transform group-hover:scale-105 transition-transform duration-300"></div>
                                <div class="relative w-full h-full rounded-full overflow-hidden ring-4 ring-white shadow-sm">
                                    @if ($item->foto)
                                        <img src="{{ Storage::url($item->foto) }}" class="w-full h-full object-cover" alt="{{ $item->nama }}">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-blue-600 font-bold text-xl bg-blue-50">
                                            {{ collect(explode(' ', $item->nama))->map(fn ($w) => strtoupper($w[0] ?? ''))->take(2)->implode('') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <h3 class="font-bold text-gray-900 text-lg mb-2 group-hover:text-blue-700 transition-colors">{{ $item->nama }}</h3>
                            <span class="text-xs font-semibold text-blue-700 bg-blue-50 inline-block px-3 py-1.5 rounded-full">
                                {{ $item->jabatan }}
                            </span>
                        </div>
                    @endforeach
                </div>

            @else
                {{-- Jika hanya ada 1 pengurus, tampilkan sebagai featured --}}
                @php $firstItem = $struktur->first(); @endphp
                <div class="max-w-md mx-auto" data-aos="fade-up">
                    <div class="group bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl p-8 text-white text-center shadow-xl shadow-blue-600/20 relative overflow-hidden">
                        <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                        <div class="relative z-10">
                            <div class="relative w-28 h-28 mx-auto mb-5">
                                <div class="absolute inset-0 bg-white/20 rounded-full transform group-hover:scale-105 transition-transform duration-300"></div>
                                <div class="relative w-full h-full rounded-full overflow-hidden ring-4 ring-white/30 shadow-lg">
                                    @if ($firstItem->foto)
                                        <img src="{{ Storage::url($firstItem->foto) }}" class="w-full h-full object-cover" alt="{{ $firstItem->nama }}">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-white font-bold text-2xl bg-blue-500/50">
                                            {{ collect(explode(' ', $firstItem->nama))->map(fn ($w) => strtoupper($w[0] ?? ''))->take(2)->implode('') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <h3 class="font-bold text-white text-xl mb-2">{{ $firstItem->nama }}</h3>
                            <span class="text-xs font-bold text-blue-100 bg-white/20 backdrop-blur-sm inline-block px-4 py-1.5 rounded-full uppercase tracking-wider">
                                {{ $firstItem->jabatan }}
                            </span>
                        </div>
                    </div>
                </div>
            @endif

            {{-- CTA Section --}}
            <div class="mt-16 text-center" data-aos="fade-up">
                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl p-8 border border-blue-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Ingin Bergabung dengan Tim Kami?</h3>
                    <p class="text-gray-600 mb-5 max-w-xl mx-auto">Kami selalu terbuka untuk kolaborasi dan kontribusi dari alumni serta mitra yang berdedikasi.</p>
                    <a href="{{ route('kontak.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-xl transition-all duration-200 shadow-lg shadow-slate-900/10">
                        Hubungi Kami
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>

        @else
            {{-- Empty State --}}
            <div class="py-20 text-center" data-aos="fade-up">
                <div class="max-w-md mx-auto">
                    <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-5">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Data Belum Tersedia</h3>
                    <p class="text-gray-500 leading-relaxed">Struktur organisasi BKK SIJAKA sedang dalam proses penyusunan. Silakan kunjungi kami kembali nanti.</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mt-6 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-xl transition shadow-lg shadow-slate-900/10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        @endif

    </section>

</x-layouts.public>