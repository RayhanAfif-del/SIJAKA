<x-layouts.public title="Profil SIJAKA">

    {{-- Hero Section --}}
    <section class="relative bg-slate-900 text-white overflow-hidden">
        {{-- Hero Background Image --}}
        @if ($profilBkk->gambar)
            <div class="absolute inset-0">
                <img src="{{ Storage::url($profilBkk->gambar) }}" alt="Background Profil" class="w-full h-full object-cover opacity-40">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-slate-900/90 to-slate-900/90"></div>
            </div>
        @else
            {{-- Decorative Background --}}
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-slate-900 to-slate-900"></div>
        @endif
        
        {{-- Dot Pattern --}}
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 32px 32px;"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24" data-aos="fade-up">
            <nav class="flex items-center gap-2 text-sm text-blue-200 mb-6">
                <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white font-medium">Profil SIJAKA</span>
            </nav>
            
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight mb-4">
                Profil <span class="text-blue-400">SIJAKA</span><br>SMKN 1 Bangsri
            </h1>
            <p class="text-blue-100 text-lg leading-relaxed max-w-2xl">
                SIJAKA (Sistem Informasi Jejaring Karier) adalah platform resmi BKK SMKN 1 Bangsri yang menghubungkan pencari kerja dengan dunia usaha dan industri secara profesional dan transparan.
            </p>
        </div>
    </section>

    {{-- Tentang Kami --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            {{-- Image Side --}}
            <div class="relative" data-aos="fade-right">
                <div class="absolute -inset-4 bg-blue-100 rounded-3xl transform -rotate-2"></div>
                <div class="relative rounded-2xl overflow-hidden shadow-2xl shadow-blue-900/10 ring-1 ring-gray-900/5">
                    @if ($profilBkk->gambar)
                        <img src="{{ Storage::url($profilBkk->gambar) }}" class="w-full h-80 lg:h-96 object-cover" alt="Gambar Profil BKK">
                    @else
                        <div class="w-full h-80 lg:h-96 bg-gradient-to-br from-blue-50 to-slate-100 flex items-center justify-center">
                            <svg class="w-20 h-20 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                </div>
                {{-- Floating Badge --}}
                <div class="absolute -bottom-6 -right-6 bg-white rounded-xl shadow-xl p-4 border border-gray-100 hidden sm:block" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Terakreditasi</p>
                            <p class="text-sm font-bold text-gray-900">BKK SMKN 1 Bangsri</p>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Text Side --}}
            <div data-aos="fade-left">
                <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold uppercase tracking-wider mb-4">Tentang Kami</span>
                <h2 class="text-3xl font-bold text-gray-900 mb-6 tracking-tight">Membangun Jembatan Karier untuk Masa Depan</h2>
                <div class="prose prose-slate text-gray-600 leading-relaxed space-y-4">
                    {!! nl2br(e($profilBkk->profil)) !!}
                </div>
            </div>
        </div>
    </section>

    {{-- Visi & Misi --}}
    <section class="bg-slate-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="inline-block px-3 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-bold uppercase tracking-wider mb-3">Arah & Tujuan</span>
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Visi & Misi</h2>
            </div>
            
            <div class="grid lg:grid-cols-2 gap-8" data-aos="fade-up" data-aos-delay="100">
                {{-- Visi Card --}}
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl p-8 lg:p-10 text-white shadow-xl shadow-blue-600/20 relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center mb-6 backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4 text-blue-100 uppercase tracking-wider text-xs">Visi Kami</h3>
                        <p class="text-xl lg:text-2xl font-semibold leading-relaxed">
                            {{ $profilBkk->visi }}
                        </p>
                    </div>
                </div>

                {{-- Misi Card --}}
                <div class="bg-white rounded-2xl p-8 lg:p-10 border border-gray-100 shadow-sm flex flex-col justify-center">
                    <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-6 text-gray-900 uppercase tracking-wider text-xs">Misi Kami</h3>
                    <ul class="space-y-4">
                        @foreach (preg_split('/\r\n|\r|\n/', trim($profilBkk->misi)) as $poin)
                            @if (trim($poin) !== '')
                                <li class="flex items-start gap-3 text-gray-600">
                                    <span class="mt-1 w-5 h-5 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    </span>
                                    <span class="leading-relaxed">{{ trim($poin) }}</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Struktur Organisasi --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
        <div class="text-center mb-12" data-aos="fade-up">
            <span class="inline-block px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold uppercase tracking-wider mb-3">Tim Kami</span>
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Susunan Pengurus BKK</h2>
            <p class="text-gray-500 mt-3 max-w-2xl mx-auto">Dipimpin oleh tenaga profesional yang berdedikasi untuk menjembatani siswa dan alumni dengan dunia industri.</p>
        </div>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6" data-aos="fade-up" data-aos-delay="100">
            @forelse ($struktur as $item)
                <div class="group bg-white rounded-2xl border border-gray-100 p-6 text-center hover:shadow-xl hover:border-blue-100 hover:-translate-y-1 transition-all duration-300">
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
            @empty
                <div class="col-span-full py-12 text-center bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <p class="text-gray-500 font-medium">Data struktur organisasi belum tersedia.</p>
                </div>
            @endforelse
        </div>
        
        {{-- Tombol Lihat Halaman Penuh (Diperbaiki) --}}
        @if (isset($struktur) && $struktur->count() > 0)
            <div class="text-center mt-10" data-aos="fade-up">
                <a href="{{ route('struktur-organisasi.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-700 hover:underline transition-all duration-200">
                    Lihat Halaman Penuh
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        @endif
    </section>
    
</x-layouts.public>