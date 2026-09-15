<x-layouts.public :title="'Detail Talenta - ' . $alumni->nama">
    @php
        $pengaturanWebsite = $pengaturanWebsite ?? \App\Models\PengaturanWebsite::singleton();
        $heroImageUrl = $pengaturanWebsite?->hero_image ? \Illuminate\Support\Facades\Storage::url($pengaturanWebsite->hero_image) : null;
        
        // Safer WhatsApp fallback
        $whatsappNumber = $whatsappNumber ?? ($pengaturanWebsite?->whatsapp ?? null);
        $cleanWhatsApp = $whatsappNumber ? preg_replace('/\D/', '', $whatsappNumber) : null;

        // Robust skills parsing
        $skills = [];
        if (!empty($alumni->keahlian)) {
            $decoded = json_decode($alumni->keahlian, true);
            $skills = (is_array($decoded) && json_last_error() === JSON_ERROR_NONE) 
                ? $decoded 
                : preg_split('/\s*,\s*/', $alumni->keahlian, -1, PREG_SPLIT_NO_EMPTY);
        }

        // Cleaner empty state check
        $hasDocuments = !empty($alumni->portfolio_url) || !empty($alumni->cv_path);
    @endphp

    {{-- Hero Section --}}
    <section class="relative bg-slate-900 text-white overflow-hidden">
        @if ($heroImageUrl)
            <div class="absolute inset-0">
                <img src="{{ $heroImageUrl }}" alt="Background" class="w-full h-full object-cover opacity-40" loading="eager">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-slate-900/90 to-slate-900/90"></div>
            </div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-slate-900 to-slate-900"></div>
        @endif
        
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 32px 32px;"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16" data-aos="fade-up">
            <nav class="flex items-center gap-2 text-sm text-blue-200 mb-6 flex-wrap" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('talenta.index') }}" class="hover:text-white transition">Talenta Alumni</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white font-medium truncate max-w-[200px] sm:max-w-md" aria-current="page">{{ $alumni->nama }}</span>
            </nav>
            
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-3">
                {{ $alumni->nama }}
            </h1>
            <p class="text-blue-100 text-lg leading-relaxed max-w-2xl">
                {{ $alumni->headline ?: 'Profil profesional dan portofolio alumni SMK Negeri 1 Bangsri.' }}
            </p>
        </div>
    </section>

    {{-- Main Content Layout --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16">
        <div class="grid lg:grid-cols-3 gap-8 lg:gap-12 items-start">
            
            {{-- Left Column: Detailed Information --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Header Card --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm" data-aos="fade-up">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-6">
                        <div class="relative shrink-0">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-gradient-to-br from-blue-500 to-[#024CD4] flex items-center justify-center text-3xl sm:text-4xl font-bold text-white shadow-lg shadow-blue-600/20 ring-4 ring-slate-50 overflow-hidden">
                                @if ($alumni->foto_path)
                                    <img src="{{ Storage::url($alumni->foto_path) }}" alt="Foto {{ $alumni->nama }}" class="w-full h-full object-cover" loading="eager">
                                @else
                                    {{ strtoupper(mb_substr(trim($alumni->nama ?? ''), 0, 1)) }}
                                @endif
                            </div>
                            <div class="absolute -bottom-1.5 -right-1.5 bg-emerald-500 text-white p-1 rounded-full ring-2 ring-white" title="Alumni Terverifikasi" aria-label="Alumni Terverifikasi">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </div>
                        
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2 mb-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                    Alumni SMK N 1 Bangsri
                                </span>
                                @if ($alumni->is_open_to_work)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse" aria-hidden="true"></span>
                                        Open to Work
                                    </span>
                                @endif
                            </div>
                            <h2 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">{{ $alumni->nama }}</h2>
                            <p class="mt-1 text-sm sm:text-base text-slate-600 leading-relaxed">
                                {{ $alumni->headline ?: 'Siap berkontribusi dan berkembang di dunia profesional.' }}
                            </p>
                        </div>
                    </div>
                </div>
                
                {{-- Card 1: Tentang Saya --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#024CD4] flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-slate-900">Tentang Saya</h2>
                            <p class="text-xs text-slate-500">Ringkasan profesional dan tujuan karier</p>
                        </div>
                    </div>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
                        <p class="whitespace-pre-line">{{ $alumni->ringkasan ?: 'Alumni ini belum menambahkan ringkasan profil. Silakan lihat bagian keahlian untuk mengetahui potensi yang dimiliki.' }}</p>
                    </div>
                </div>

                {{-- Card 2: Keahlian --}}
                @if (!empty($skills))
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-slate-900">Keahlian & Kompetensi</h2>
                                <p class="text-xs text-slate-500">Kemampuan teknis dan non-teknis</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2.5">
                            @foreach ($skills as $skill)
                                <span class="inline-flex items-center px-3.5 py-1.5 rounded-lg bg-slate-50 border border-slate-200 text-sm font-medium text-slate-700 hover:border-[#024CD4] hover:text-[#024CD4] hover:bg-blue-50 transition-colors duration-200 cursor-default">
                                    {{ trim($skill) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Card 3: Dokumen & Portofolio --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-slate-900">Dokumen & Portofolio</h2>
                            <p class="text-xs text-slate-500">Bukti karya dan riwayat profesional</p>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        @if (!empty($alumni->portfolio_url))
                            <a href="{{ $alumni->portfolio_url }}" target="_blank" rel="noopener noreferrer" class="group flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:border-[#024CD4] hover:bg-blue-50/50 transition-all duration-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center group-hover:bg-[#024CD4] group-hover:text-white transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900 group-hover:text-[#024CD4]">Lihat Portofolio Online</p>
                                        <p class="text-xs text-slate-500 truncate max-w-[200px] sm:max-w-xs">{{ $alumni->portfolio_url }}</p>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-slate-400 group-hover:text-[#024CD4] group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4m-5-5l5-5m0 0v4m0-4h-4"/></svg>
                            </a>
                        @endif

                        @if (!empty($alumni->cv_path))
                            <a href="{{ route('talenta.document', [$alumni, 'cv']) }}" class="group flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:border-emerald-500 hover:bg-emerald-50/50 transition-all duration-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900 group-hover:text-emerald-700">Unduh Curriculum Vitae (CV)</p>
                                        <p class="text-xs text-slate-500">Format PDF / DOCX</p>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-slate-400 group-hover:text-emerald-600 group-hover:translate-y-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            </a>
                        @endif

                        @if (!$hasDocuments)
                            <div class="text-center py-8 bg-slate-50 rounded-xl border border-dashed border-slate-300">
                                <svg class="w-10 h-10 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <p class="text-sm text-slate-500">Belum ada dokumen atau portofolio yang diunggah.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Right Column: Sticky Action Sidebar --}}
            <aside class="lg:sticky lg:top-6 space-y-6">
                
                {{-- Action Card --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-lg shadow-slate-200/50">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4">Tertarik dengan profil ini?</h3>
                    
                    <div class="space-y-3">
                        @if ($cleanWhatsApp)
                            <a href="https://wa.me/{{ $cleanWhatsApp }}?text={{ rawurlencode('Halo Admin BKK, saya tertarik dengan profil talenta ' . $alumni->nama . '.') }}" target="_blank" rel="noopener noreferrer" class="flex min-h-12 w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-3 text-sm font-bold text-white hover:bg-emerald-700 transition-all duration-200 shadow-lg shadow-emerald-600/20 hover:shadow-emerald-600/40 active:scale-[0.98]">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.52 3.48A11.86 11.86 0 0012.08 0C5.55.0.24 5.31.24 11.84c0 2.09.55 4.13 1.59 5.93L.14 24l6.38-1.67a11.86 11.86 0 005.56 1.41h.01c6.53 0 11.84-5.31 11.84-11.84 0-3.17-1.23-6.15-3.41-8.42z"/></svg>
                                Hubungi Admin BKK via WhatsApp
                            </a>
                        @else
                            <a href="{{ route('kontak.index') }}" class="flex min-h-12 w-full items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-all duration-200 active:scale-[0.98]">
                                Hubungi Admin BKK
                            </a>
                        @endif
                    </div>

                    <div class="mt-6 pt-6 border-t border-slate-100">
                        <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Informasi Cepat</h4>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 text-sm">
                                <svg class="w-5 h-5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <div>
                                    <p class="font-medium text-slate-900">{{ $alumni->jurusan ?? 'Belum diisi' }}</p>
                                    <p class="text-xs text-slate-500">Kompetensi Keahlian</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3 text-sm">
                                <svg class="w-5 h-5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <div>
                                    <p class="font-medium text-slate-900">Angkatan {{ $alumni->tahun_lulus ?? 'Belum diisi' }}</p>
                                    <p class="text-xs text-slate-500">Tahun Lulus</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3 text-sm">
                                <svg class="w-5 h-5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                <div>
                                    <p class="font-medium text-emerald-600">Terverifikasi oleh BKK</p>
                                    <p class="text-xs text-slate-500">Status Akun</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    @if (!empty($alumni->linkedin_url) || !empty($alumni->instagram_url) || !empty($alumni->tiktok_url))
                        <div class="mt-6 pt-6 border-t border-slate-100">
                            <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Media Sosial</h4>
                            <div class="flex items-center gap-2.5">
                                @if (!empty($alumni->linkedin_url))
                                    <a href="{{ $alumni->linkedin_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-[#0A66C2]/10 text-[#0A66C2] hover:bg-[#0A66C2] hover:text-white transition-all duration-200 shadow-sm hover:shadow" title="LinkedIn" aria-label="LinkedIn">
                                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                                    </a>
                                @endif
                                @if (!empty($alumni->instagram_url))
                                    <a href="{{ $alumni->instagram_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-pink-50 text-[#E4405F] hover:bg-[#E4405F] hover:text-white transition-all duration-200 shadow-sm hover:shadow" title="Instagram" aria-label="Instagram">
                                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                    </a>
                                @endif
                                @if (!empty($alumni->tiktok_url))
                                    <a href="{{ $alumni->tiktok_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-slate-100 text-slate-800 hover:bg-slate-900 hover:text-white transition-all duration-200 shadow-sm hover:shadow" title="TikTok" aria-label="TikTok">
                                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.64 1.82 2.89 3.5 2.77 1.81-.03 3.28-1.54 3.32-3.35.03-2.73.01-5.46.01-8.19l-.01-8.68h3.91z"/></svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Back Link --}}
                <a href="{{ route('talenta.index') }}" class="w-full inline-flex min-h-11 items-center justify-center gap-2 hover:bg-blue-700 bg-blue-600 text-white text-sm font-semibold py-2.5 px-4 rounded-xl transition-all duration-200 shadow-lg shadow-slate-900/10 hover:shadow-blue-600/20 active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Direktori Talenta
                </a>
            </aside>
        </div>
    </main>
</x-layouts.public>