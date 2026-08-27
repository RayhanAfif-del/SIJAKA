<x-layouts.public title="Kontak Kami">

    {{-- Hero Section --}}
    <section class="relative bg-slate-900 text-white overflow-hidden">
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
                <span class="text-white font-medium">Kontak Kami</span>
            </nav>
            
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight mb-4">
                Hubungi <span class="text-blue-400">Kami</span>
            </h1>
            <p class="text-blue-100 text-lg leading-relaxed max-w-2xl">
                Punya pertanyaan seputar layanan karier, lowongan, atau kerja sama? Tim BKK SIJAKA SMK N 1 Bangsri siap membantu Anda.
            </p>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
        <div class="grid lg:grid-cols-5 gap-10 lg:gap-12">
            
            {{-- Left Column: Contact Info --}}
            <div class="lg:col-span-2 space-y-5">
                
                {{-- Alamat --}}
                <div class="group flex items-start gap-4 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300" data-aos="fade-up">
                    <span class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </span>
                    <div>
                        <p class="font-bold text-gray-900 mb-1">Alamat Kantor</p>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $kontak->alamat }}</p>
                    </div>
                </div>

                {{-- Email --}}
                <div class="group flex items-start gap-4 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300" data-aos="fade-up" data-aos-delay="50">
                    <span class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </span>
                    <div>
                        <p class="font-bold text-gray-900 mb-1">Email</p>
                        <a href="mailto:{{ $kontak->email }}" class="text-sm text-gray-600 hover:text-emerald-600 transition-colors break-all">
                            {{ $kontak->email }}
                        </a>
                    </div>
                </div>

                {{-- Telepon --}}
                <div class="group flex items-start gap-4 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                    <span class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </span>
                    <div>
                        <p class="font-bold text-gray-900 mb-1">Telepon / WhatsApp</p>
                        <a href="tel:{{ preg_replace('/[^0-9]/', '', $kontak->telepon) }}" class="text-sm text-gray-600 hover:text-amber-600 transition-colors">
                            {{ $kontak->telepon }}
                        </a>
                    </div>
                </div>

                {{-- Jam Operasional --}}
                @if ($kontak->jam_operasional)
                    <div class="group flex items-start gap-4 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300" data-aos="fade-up" data-aos-delay="150">
                        <span class="w-12 h-12 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </span>
                        <div>
                            <p class="font-bold text-gray-900 mb-1">Jam Operasional</p>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $kontak->jam_operasional }}</p>
                        </div>
                    </div>
                @endif

                {{-- Social Media Links --}}
                <div class="pt-4" data-aos="fade-up" data-aos-delay="200">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Ikuti Kami</p>
                    <div class="flex flex-wrap gap-3">
                        @if ($kontak->facebook)
                            <a href="{{ $kontak->facebook }}" target="_blank" class="w-11 h-11 rounded-full bg-gray-50 text-gray-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-0.5" aria-label="Facebook">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                        @endif
                        @if ($kontak->instagram)
                            <a href="{{ $kontak->instagram }}" target="_blank" class="w-11 h-11 rounded-full bg-gray-50 text-gray-600 flex items-center justify-center hover:bg-pink-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-0.5" aria-label="Instagram">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            </a>
                        @endif
                        @if ($kontak->youtube)
                            <a href="{{ $kontak->youtube }}" target="_blank" class="w-11 h-11 rounded-full bg-gray-50 text-gray-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-0.5" aria-label="YouTube">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Right Column: Map --}}
            <div class="lg:col-span-3" data-aos="fade-up" data-aos-delay="100">
                @php
                    $mapSource = trim((string) ($kontak->map_link ?: $kontak->alamat));
                    $isMapUrl = filter_var($mapSource, FILTER_VALIDATE_URL);
                    $mapQuery = $mapSource;

                    if ($isMapUrl) {
                        $parsed = parse_url($mapSource);
                        $mapQuery = $parsed['query'] ?? $parsed['path'] ?? $kontak->alamat;
                        $mapQuery = trim((string) $mapQuery);
                    }

                    $mapEmbedUrl = 'https://www.google.com/maps?q=' . urlencode($mapQuery) . '&output=embed';
                    $mapOpenUrl = $isMapUrl
                        ? $mapSource
                        : 'https://www.google.com/maps/search/?api=1&query=' . urlencode($mapSource);
                @endphp

                <div class="rounded-2xl overflow-hidden bg-white border border-gray-100 shadow-sm h-full min-h-[400px] lg:min-h-0 relative group">
                    @if ($mapSource !== '')
                        <div class="absolute inset-0 z-10">
                            <iframe
                                title="Peta Lokasi BKK SMK N 1 Bangsri"
                                src="{{ $mapEmbedUrl }}"
                                class="w-full h-full pointer-events-none grayscale-[20%] group-hover:grayscale-0 transition-all duration-500"
                                style="border: 0;"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                            ></iframe>
                            
                            {{-- Click Overlay --}}
                            <a href="{{ $mapOpenUrl }}" target="_blank" rel="noopener noreferrer" class="absolute inset-0 flex items-center justify-center bg-black/0 group-hover:bg-black/10 transition-all duration-300" aria-label="Buka lokasi di Google Maps">
                                <span class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-2.5 text-sm font-semibold text-gray-800 shadow-lg opacity-0 group-hover:opacity-100 group-hover:translate-y-0 translate-y-2 transition-all duration-300">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                    Buka di Google Maps
                                </span>
                            </a>
                        </div>
                        
                        {{-- Map Footer Info --}}
                        <div class="absolute bottom-0 left-0 right-0 bg-white/90 backdrop-blur-sm border-t border-gray-100 px-5 py-3 flex items-center justify-between gap-3 z-20">
                            <div class="flex items-center gap-2 min-w-0">
                                <svg class="w-4 h-4 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/></svg>
                                <span class="text-xs text-gray-600 truncate">{{ $kontak->map_link ? 'Link Peta Kustom' : $kontak->alamat }}</span>
                            </div>
                            <a href="{{ $mapOpenUrl }}" target="_blank" rel="noopener noreferrer" class="text-xs font-semibold text-blue-600 hover:text-blue-700 whitespace-nowrap flex-shrink-0">
                                Tab Baru &nearr;
                            </a>
                        </div>
                    @else
                        <div class="h-full min-h-[400px] flex flex-col items-center justify-center text-center p-8 bg-slate-50">
                            <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <p class="text-gray-900 font-semibold mb-1">Peta Belum Tersedia</p>
                            <p class="text-sm text-gray-500">Silakan gunakan alamat di samping untuk menemukan lokasi kami.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>