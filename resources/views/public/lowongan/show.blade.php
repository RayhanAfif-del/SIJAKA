<x-layouts.public :title="$lowongan->posisi . ' - ' . $lowongan->mitra->nama_perusahaan">

    @php
        $pengaturanWebsite = $pengaturanWebsite ?? \App\Models\PengaturanWebsite::singleton();
        $heroImageUrl = $pengaturanWebsite->hero_image ? \Illuminate\Support\Facades\Storage::url($pengaturanWebsite->hero_image) : null;
    @endphp

    {{-- Hero Section --}}
    <section class="relative bg-slate-900 text-white overflow-hidden">
        {{-- Hero Background Image --}}
        @if ($heroImageUrl)
            <div class="absolute inset-0">
                <img src="{{ $heroImageUrl }}" alt="Background" class="w-full h-full object-cover opacity-40">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-slate-900/90 to-slate-900/90"></div>
            </div>
        @else
            {{-- Decorative Background --}}
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-slate-900 to-slate-900"></div>
        @endif
        
        {{-- Dot Pattern --}}
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 32px 32px;"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16" data-aos="fade-up">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-blue-200 mb-6 flex-wrap">
                <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('lowongan.index') }}" class="hover:text-white transition">Lowongan Pekerjaan</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white font-medium truncate max-w-[200px] sm:max-w-md">{{ $lowongan->posisi }}</span>
            </nav>
            
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-3">
                {{ $lowongan->posisi }}
            </h1>
            <p class="text-blue-100 text-lg leading-relaxed max-w-2xl">
                Bergabunglah dengan {{ $lowongan->mitra->nama_perusahaan }} dan kembangkan karier Anda bersama tim profesional.
            </p>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16">
        <div class="grid lg:grid-cols-3 gap-8 lg:gap-12">
            
            {{-- Left Column: Details --}}
            <div class="lg:col-span-2 space-y-8">
                
                {{-- Header Card --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sm:p-8" data-aos="fade-up">
                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <div class="w-16 h-16 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 text-lg font-bold overflow-hidden flex-shrink-0 ring-1 ring-blue-100">
                                @if ($lowongan->mitra->logo)
                                    <img src="{{ Storage::url($lowongan->mitra->logo) }}" class="w-full h-full object-cover" alt="{{ $lowongan->mitra->nama_perusahaan }}">
                                @else
                                    {{ strtoupper(substr($lowongan->mitra->nama_perusahaan, 0, 2)) }}
                                @endif
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-1">{{ $lowongan->posisi }}</h2>
                                <p class="text-blue-600 font-medium mb-3">{{ $lowongan->mitra->nama_perusahaan }}</p>
                                <div class="flex flex-wrap gap-3 text-sm text-gray-600">
                                    <span class="inline-flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ $lowongan->lokasi }}
                                    </span>
                                    <span class="inline-flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        {{ $lowongan->jenis_pekerjaan }}
                                    </span>
                                    @if ($lowongan->gaji)
                                        <span class="inline-flex items-center gap-1.5 text-emerald-600 font-medium">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            {{ $lowongan->gaji }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if ($lowongan->unggulan)
                            <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 text-xs font-bold px-3 py-1.5 rounded-full border border-amber-100 shrink-0">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                Unggulan
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Deskripsi Pekerjaan
                    </h3>
                    <div class="prose prose-slate max-w-none text-gray-600 leading-relaxed">
                        {!! nl2br(e($lowongan->deskripsi)) !!}
                    </div>
                </div>

                {{-- Persyaratan --}}
                <div data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        Persyaratan Kandidat
                    </h3>
                    <ul class="space-y-3">
                        @foreach (preg_split('/\r\n|\r|\n/', trim($lowongan->persyaratan)) as $poin)
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

                {{-- Cara Melamar --}}
                <div data-aos="fade-up" data-aos-delay="300">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Cara Melamar
                    </h3>
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl border border-blue-100 p-6 text-gray-700 leading-relaxed shadow-sm">
                        {!! nl2br(e($lowongan->cara_melamar)) !!}
                    </div>
                </div>

            </div>

            {{-- Right Column: Sidebar --}}
            <div class="space-y-6 lg:sticky lg:top-24 lg:self-start">
                
                {{-- Ringkasan Lowongan --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6" data-aos="fade-left">
                    <h3 class="font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Ringkasan Lowongan
                    </h3>
                    <dl class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500 font-medium uppercase tracking-wider">Mitra Perusahaan</dt>
                                <dd class="text-sm font-semibold text-gray-900 mt-0.5">{{ $lowongan->mitra->nama_perusahaan }}</dd>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500 font-medium uppercase tracking-wider">Lokasi</dt>
                                <dd class="text-sm font-semibold text-gray-900 mt-0.5">{{ $lowongan->lokasi }}</dd>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500 font-medium uppercase tracking-wider">Tipe Pekerjaan</dt>
                                <dd class="text-sm font-semibold text-gray-900 mt-0.5">{{ $lowongan->jenis_pekerjaan }}</dd>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500 font-medium uppercase tracking-wider">Batas Melamar</dt>
                                <dd class="text-sm font-semibold text-amber-700 mt-0.5">{{ $lowongan->deadline->translatedFormat('d F Y') }}</dd>
                            </div>
                        </div>
                    </dl>

                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <a href="{{ route('lowongan.index') }}" class="w-full inline-flex items-center justify-center gap-2 hover:bg-blue-700 bg-blue-600 text-white text-sm font-semibold py-3 rounded-xl transition-all duration-200 shadow-lg shadow-slate-900/10 hover:shadow-blue-600/20">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>

                {{-- Lowongan Lainnya --}}
                @if (isset($lowonganLainnya) && $lowonganLainnya->isNotEmpty())
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6" data-aos="fade-left" data-aos-delay="100">
                        <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            Lowongan Lainnya
                        </h3>
                        <ul class="space-y-3">
                            @foreach ($lowonganLainnya as $item)
                                <li class="group">
                                    <a href="{{ route('lowongan.show', $item) }}" class="block p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 transition-all duration-200">
                                        <div class="flex items-start justify-between gap-3">
                                            <div class="min-w-0 flex-1">
                                                <p class="text-sm font-semibold text-gray-900 group-hover:text-blue-700 transition-colors line-clamp-1">{{ $item->posisi }}</p>
                                                <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                                    {{ $item->mitra->nama_perusahaan }}
                                                </p>
                                            </div>
                                            <svg class="w-4 h-4 text-gray-300 group-hover:text-blue-600 group-hover:translate-x-1 transition-all duration-200 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-layouts.public>