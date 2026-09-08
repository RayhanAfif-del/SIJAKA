<x-layouts.public title="Detail Talenta - {{ $alumni->nama }}">
    @php
        $decodedSkills = json_decode((string) $alumni->keahlian, true);
        $skills = is_array($decodedSkills)
            ? $decodedSkills
            : preg_split('/\s*,\s*/', (string) $alumni->keahlian, -1, PREG_SPLIT_NO_EMPTY);
    @endphp

    {{-- Hero Section: Premium Profile Header --}}
    <section class="relative overflow-hidden bg-slate-900 text-white">
        {{-- Background Pattern & Gradient --}}
        <div class="absolute inset-0 bg-gradient-to-br from-[#024CD4] via-slate-900 to-slate-950"></div>
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.3) 1px, transparent 0); background-size: 24px 24px;"></div>
        
        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20" data-aos="fade-up">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-blue-200 mb-8">
                <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('talenta.index') }}" class="hover:text-white transition">Talenta</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white font-medium">Detail Profil</span>
            </nav>

            {{-- Profile Header Block --}}
            <div class="flex flex-col md:flex-row md:items-end gap-6">
                <div class="relative shrink-0">
                    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-3xl bg-gradient-to-br from-blue-400 to-[#024CD4] flex items-center justify-center text-4xl sm:text-5xl font-bold text-white shadow-2xl shadow-blue-900/50 ring-4 ring-white/10">
                        @if ($alumni->foto_path)
                            <img src="{{ Storage::url($alumni->foto_path) }}" alt="Foto {{ $alumni->nama }}" class="w-full h-full object-cover rounded-3xl">
                        @else
                            {{ strtoupper(substr($alumni->nama, 0, 1)) }}
                        @endif
                    </div>
                    {{-- Verified Badge --}}
                    <div class="absolute -bottom-2 -right-2 bg-emerald-500 text-white p-1.5 rounded-full ring-4 ring-slate-900" title="Alumni Terverifikasi">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                </div>
                
                <div class="flex-1 pb-1">
                    <div class="flex flex-wrap items-center gap-3 mb-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-500/20 text-blue-200 border border-blue-400/30">
                            Alumni SMK N 1 Bangsri
                        </span>
                        @if ($alumni->is_open_to_work)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-400/30">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                Open to Work
                            </span>
                        @endif
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white">{{ $alumni->nama }}</h1>
                    <p class="mt-3 text-lg sm:text-xl text-blue-100 font-medium leading-relaxed max-w-3xl">
                        {{ $alumni->headline ?: 'Siap berkontribusi dan berkembang di dunia profesional.' }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Main Content Layout --}}
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16">
        <div class="grid lg:grid-cols-[1fr_340px] gap-8 items-start">
            
            {{-- Left Column: Detailed Information --}}
            <div class="space-y-6">
                
                {{-- Card 1: Tentang Saya --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#024CD4] flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
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
                @if ($skills)
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
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
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-slate-900">Dokumen & Portofolio</h2>
                            <p class="text-xs text-slate-500">Bukti karya dan riwayat profesional</p>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        @if ($alumni->portfolio_url)
                            <a href="{{ $alumni->portfolio_url }}" target="_blank" rel="noopener noreferrer" class="group flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:border-[#024CD4] hover:bg-blue-50/50 transition-all duration-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center group-hover:bg-[#024CD4] group-hover:text-white transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900 group-hover:text-[#024CD4]">Lihat Portofolio Online</p>
                                        <p class="text-xs text-slate-500 truncate max-w-[200px] sm:max-w-xs">{{ $alumni->portfolio_url }}</p>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-slate-400 group-hover:text-[#024CD4] group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4m-5-5l5-5m0 0v4m0-4h-4"/></svg>
                            </a>
                        @endif

                        @if (!empty($alumni->cv_path))
                            <a href="{{ route('talenta.document', [$alumni, 'cv']) }}" class="group flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:border-emerald-500 hover:bg-emerald-50/50 transition-all duration-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900 group-hover:text-emerald-700">Unduh Curriculum Vitae (CV)</p>
                                        <p class="text-xs text-slate-500">Format PDF / DOCX</p>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-slate-400 group-hover:text-emerald-600 group-hover:translate-y-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            </a>
                        @endif

                        @if (empty($alumni->portfolio_url) && empty($alumni->cv_path))
                            <div class="text-center py-8 bg-slate-50 rounded-xl border border-dashed border-slate-300">
                                <svg class="w-10 h-10 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
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
                        @if ($whatsappNumber)
                            <a href="https://wa.me/{{ $whatsappNumber }}?text={{ rawurlencode('Halo Admin BKK, saya tertarik dengan profil talenta '.$alumni->nama.'.') }}" target="_blank" rel="noopener noreferrer" class="flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-3.5 text-sm font-bold text-white hover:bg-emerald-700 transition-all duration-200 shadow-lg shadow-emerald-600/20 hover:shadow-emerald-600/40 hover:-translate-y-0.5">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.52 3.48A11.86 11.86 0 0012.08 0C5.55.0.24 5.31.24 11.84c0 2.09.55 4.13 1.59 5.93L.14 24l6.38-1.67a11.86 11.86 0 005.56 1.41h.01c6.53 0 11.84-5.31 11.84-11.84 0-3.17-1.23-6.15-3.41-8.42z"/></svg>
                                Hubungi Admin BKK via WhatsApp
                            </a>
                        @else
                            <a href="{{ route('kontak.index') }}" class="flex w-full items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-all duration-200">
                                Hubungi Admin BKK
                            </a>
                        @endif
                    </div>

                    <div class="mt-6 pt-6 border-t border-slate-100">
                        <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Informasi Cepat</h4>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 text-sm">
                                <svg class="w-5 h-5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <div>
                                    <p class="font-medium text-slate-900">{{ $alumni->jurusan }}</p>
                                    <p class="text-xs text-slate-500">Kompetensi Keahlian</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3 text-sm">
                                <svg class="w-5 h-5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <div>
                                    <p class="font-medium text-slate-900">Angkatan {{ $alumni->tahun_lulus }}</p>
                                    <p class="text-xs text-slate-500">Tahun Lulus</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3 text-sm">
                                <svg class="w-5 h-5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                <div>
                                    <p class="font-medium text-emerald-600">Terverifikasi oleh BKK</p>
                                    <p class="text-xs text-slate-500">Status Akun</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Back Link --}}
                <a href="{{ route('talenta.index') }}" class="w-full inline-flex items-center justify-center gap-2 hover:bg-blue-700 bg-blue-600 text-white text-sm font-semibold py-3 rounded-xl transition-all duration-200 shadow-lg shadow-slate-900/10 hover:shadow-blue-600/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Direktori Talenta
                </a>

            </aside>
        </div>
    </main>
</x-layouts.public>