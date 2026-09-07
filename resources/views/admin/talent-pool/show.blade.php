<x-layouts.admin title="Detail Talenta Alumni">
    @php
        $decodedSkills = json_decode((string) $alumni->keahlian, true);
        $skills = is_array($decodedSkills)
            ? $decodedSkills
            : preg_split('/\s*,\s*/', (string) $alumni->keahlian, -1, PREG_SPLIT_NO_EMPTY);
        $status = $alumni->talent_approval_status ?? 'menunggu';
        $badge = [
            'menunggu'  => 'bg-amber-50 text-amber-700 border border-amber-200',
            'disetujui' => 'bg-emerald-50 text-emerald-700 border border-emerald-200',
            'ditolak'   => 'bg-red-50 text-red-700 border border-red-200',
        ];
    @endphp

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                <a href="{{ route('admin.talent-pool.index') }}" class="hover:text-slate-700 transition flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Talenta Alumni
                </a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-slate-700 font-medium">Detail Profil</span>
            </div>
            <h1 class="text-2xl font-semibold text-slate-900 tracking-tight">Detail Talenta Alumni</h1>
            <p class="text-sm text-slate-500 mt-1">Tinjau kelengkapan dan kesesuaian profil sebelum memberikan persetujuan publikasi.</p>
        </div>
        <a href="{{ route('admin.talent-pool.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 rounded-lg transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar
        </a>
    </div>

    <div class="grid lg:grid-cols-[1fr_320px] gap-6 items-start">
        
        {{-- Left Column: Profile Details --}}
        <div class="space-y-6">
            
            {{-- Card 1: Identitas & Ringkasan --}}
            <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-semibold text-slate-900">Identitas & Ringkasan</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Data dasar dan deskripsi profesional alumni</p>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-5 pb-6 border-b border-slate-100">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-100 flex items-center justify-center text-3xl font-bold text-blue-700 shrink-0 overflow-hidden">
                            @if ($alumni->foto_path)
                                <img src="{{ Storage::url($alumni->foto_path) }}" alt="Foto {{ $alumni->nama }}" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr($alumni->nama, 0, 1)) }}
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-xl font-bold text-slate-900">{{ $alumni->nama }}</h3>
                            <p class="text-sm font-medium text-blue-600 mt-1">{{ $alumni->headline ?: 'Headline belum diisi' }}</p>
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-2 text-xs text-slate-500">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                                    {{ $alumni->jurusan }}
                                </span>
                                <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Lulus {{ $alumni->tahun_lulus }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <h4 class="text-sm font-semibold text-slate-900 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                            Ringkasan Profil
                        </h4>
                        <div class="prose prose-sm prose-slate max-w-none text-slate-600 leading-relaxed bg-slate-50/50 rounded-lg p-4 border border-slate-100">
                            {!! nl2br(e($alumni->ringkasan ?: 'Alumni belum menambahkan ringkasan profil.')) !!}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card 2: Keahlian --}}
            <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-semibold text-slate-900">Keahlian & Kompetensi</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Kemampuan teknis dan non-teknis yang dimiliki</p>
                    </div>
                </div>
                <div class="p-6">
                    @if ($skills)
                        <div class="flex flex-wrap gap-2">
                            @foreach ($skills as $skill)
                                <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-slate-50 border border-slate-200 text-sm font-medium text-slate-700 hover:border-blue-300 hover:text-blue-700 hover:bg-blue-50 transition-colors duration-200">
                                    {{ trim($skill) }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <div class="flex items-center gap-3 p-4 rounded-lg bg-slate-50 border border-dashed border-slate-200">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            <p class="text-sm text-slate-500">Belum ada keahlian yang ditambahkan oleh alumni.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- Right Column: Actions & Documents --}}
        <aside class="space-y-5 lg:sticky lg:top-6">
            
            {{-- Status & Actions Card --}}
            <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-sm font-semibold text-slate-900">Status Publikasi</h3>
                </div>
                <div class="p-5 space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold {{ $badge[$status] ?? $badge['menunggu'] }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-current opacity-60"></span>
                            {{ ucfirst($status) }}
                        </span>
                    </div>
                    
                    <p class="text-xs text-slate-500 leading-relaxed">
                        @if ($status === 'menunggu')
                            Profil ini sedang menunggu tinjauan Anda. Pastikan data yang diisi sudah sesuai dan profesional sebelum disetujui.
                        @elseif ($status === 'disetujui')
                            Profil ini telah dipublikasikan dan dapat dilihat oleh mitra perusahaan di direktori talenta.
                        @else
                            Profil ini telah ditolak. Alumni perlu memperbaiki data dan mengajukan kembali.
                        @endif
                    </p>

                    <div class="pt-4 border-t border-slate-100 space-y-2">
                        @if ($status !== 'disetujui')
                            <form method="POST" action="{{ route('admin.talent-pool.approve', $alumni) }}" onsubmit="return confirm('Setujui dan publikasikan talenta ini ke direktori publik?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-700 transition shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Setujui & Publikasikan
                                </button>
                            </form>
                        @endif
                        
                        @if ($status !== 'ditolak')
                            <form method="POST" action="{{ route('admin.talent-pool.reject', $alumni) }}" onsubmit="return confirm('Tolak pengajuan talenta ini?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-white border border-red-200 px-4 py-2.5 text-sm font-semibold text-red-700 hover:bg-red-50 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    Tolak Pengajuan
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Documents Card --}}
            <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-sm font-semibold text-slate-900">Dokumen Pendukung</h3>
                </div>
                <div class="p-5 space-y-3">
                    @if ($alumni->cv_path)
                        <a href="{{ route('admin.talent-pool.document', [$alumni, 'cv']) }}" target="_blank" class="group flex items-center gap-3 p-3 rounded-lg border border-slate-200 hover:border-blue-300 hover:bg-blue-50/50 transition-all duration-200">
                            <div class="w-10 h-10 rounded-lg bg-red-50 text-red-600 flex items-center justify-center shrink-0 group-hover:bg-red-100 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-900 group-hover:text-blue-700 transition-colors">Curriculum Vitae</p>
                                <p class="text-xs text-slate-500 truncate">Klik untuk melihat / unduh</p>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4m-5-5l5-5m0 0v4m0-4h-4"/></svg>
                        </a>
                    @endif

                    @if ($alumni->portfolio_path)
                        <a href="{{ route('admin.talent-pool.document', [$alumni, 'portfolio']) }}" target="_blank" class="group flex items-center gap-3 p-3 rounded-lg border border-slate-200 hover:border-blue-300 hover:bg-blue-50/50 transition-all duration-200">
                            <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 group-hover:bg-amber-100 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-900 group-hover:text-blue-700 transition-colors">File Portofolio</p>
                                <p class="text-xs text-slate-500 truncate">Klik untuk melihat / unduh</p>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4m-5-5l5-5m0 0v4m0-4h-4"/></svg>
                        </a>
                    @endif

                    @if ($alumni->portfolio_url)
                        <a href="{{ $alumni->portfolio_url }}" target="_blank" rel="noopener noreferrer" class="group flex items-center gap-3 p-3 rounded-lg border border-slate-200 hover:border-blue-300 hover:bg-blue-50/50 transition-all duration-200">
                            <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 group-hover:bg-blue-100 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-900 group-hover:text-blue-700 transition-colors">Tautan Portofolio</p>
                                <p class="text-xs text-slate-500 truncate">{{ Str::limit($alumni->portfolio_url, 30) }}</p>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4m-5-5l5-5m0 0v4m0-4h-4"/></svg>
                        </a>
                    @endif

                    @if (!$alumni->cv_path && !$alumni->portfolio_path && !$alumni->portfolio_url)
                        <div class="flex flex-col items-center justify-center text-center py-6 px-4 rounded-lg bg-slate-50 border border-dashed border-slate-200">
                            <svg class="w-8 h-8 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <p class="text-sm text-slate-500">Belum ada dokumen atau tautan yang diunggah.</p>
                        </div>
                    @endif
                </div>
            </div>

        </aside>
    </div>
</x-layouts.admin>