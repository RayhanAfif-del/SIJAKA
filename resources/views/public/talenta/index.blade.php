<x-layouts.public title="Talenta Alumni">
    @php
        $pengaturanWebsite = $pengaturanWebsite ?? \App\Models\PengaturanWebsite::singleton();
        $heroImageUrl = $pengaturanWebsite->hero_image ? \Illuminate\Support\Facades\Storage::url($pengaturanWebsite->hero_image) : null;
    @endphp

    <section class="relative bg-slate-900 text-white overflow-hidden">
        @if ($heroImageUrl)
            <div class="absolute inset-0">
                <img src="{{ $heroImageUrl }}" alt="Background" class="w-full h-full object-cover opacity-40">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-slate-900/90 to-slate-900/90"></div>
            </div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-slate-900 to-slate-900"></div>
        @endif

        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 32px 32px;"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20" data-aos="fade-up">
            <nav class="flex items-center gap-2 text-sm text-blue-200 mb-6">
                <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white font-medium">Talenta</span>
            </nav>

            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight mb-4">Talenta <span class="text-blue-400">Alumni</span></h1>
            <p class="text-blue-100 text-lg leading-relaxed max-w-2xl">Kenali talenta alumni SMK N 1 Bangsri berdasarkan keahlian dan bidang profesional mereka.</p>
        </div>
    </section>

    {{-- Floating Search Bar --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10 mb-12" data-aos="fade-up" data-aos-delay="100">
        <form method="GET" action="{{ route('talenta.index') }}" class="bg-white rounded-2xl shadow-xl border border-slate-200/60 p-4 sm:p-5 flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="search" name="cari" value="{{ request('cari') }}" 
                    placeholder="Cari nama, jurusan, atau keahlian (contoh: Laravel, Akuntansi)..." 
                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:border-[#024CD4] focus:ring-2 focus:ring-[#024CD4]/20 text-sm outline-none transition placeholder:text-slate-400">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#024CD4] px-6 py-3 text-sm font-semibold text-white hover:bg-blue-700 transition shadow-lg shadow-blue-600/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Cari
                </button>
                @if (request()->filled('cari'))
                    <a href="{{ route('talenta.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition" title="Reset pencarian">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
            </div>
        </form>
    </section>

    {{-- Talent Grid --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="flex items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-xl font-bold text-slate-900">Profil Talenta</h2>
                <p class="text-sm text-slate-500 mt-1">{{ $talenta->total() }} alumni terverifikasi tersedia</p>
            </div>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($talenta as $item)
                @php
                    $decodedSkills = json_decode((string) $item->keahlian, true);
                    $skills = is_array($decodedSkills)
                        ? $decodedSkills
                        : preg_split('/\s*,\s*/', (string) $item->keahlian, -1, PREG_SPLIT_NO_EMPTY);
                @endphp

                <article class="group bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-xl hover:border-[#024CD4]/30 hover:-translate-y-1 transition-all duration-300 flex flex-col" data-aos="fade-up">
                    
                    {{-- Header: Avatar & Info --}}
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center text-[#024CD4] text-lg font-bold shrink-0 ring-1 ring-blue-100">
                                @if ($item->foto_path)
                                    <img src="{{ Storage::url($item->foto_path) }}" alt="Foto {{ $item->nama }}" class="w-full h-full object-cover">
                                @else
                                    {{ strtoupper(substr($item->nama, 0, 1)) }}
                                @endif
                            </div>
                            <div class="min-w-0">
                                <h3 class="font-bold text-slate-900 truncate group-hover:text-[#024CD4] transition-colors">{{ $item->nama }}</h3>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $item->jurusan }} · Lulus {{ $item->tahun_lulus }}</p>
                            </div>
                        </div>
                        
                        {{-- Open to Work Badge --}}
                        @if($item->is_open_to_work)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-100 shrink-0">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                Open to Work
                            </span>
                        @endif
                    </div>

                    {{-- Headline --}}
                    @if ($item->headline)
                        <p class="text-sm font-semibold text-slate-800 mb-2 line-clamp-1">{{ $item->headline }}</p>
                    @endif

                    {{-- Summary --}}
                    @if ($item->ringkasan)
                        <p class="text-sm text-slate-600 leading-relaxed line-clamp-3 mb-4">{{ $item->ringkasan }}</p>
                    @endif

                    {{-- Skills --}}
                    @if ($skills)
                        <div class="mt-auto pt-4 border-t border-slate-100">
                            <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-2">Keahlian Utama</p>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach (array_slice($skills, 0, 4) as $skill)
                                    <span class="px-2.5 py-1 rounded-lg bg-slate-50 text-slate-600 text-xs font-medium border border-slate-100">{{ $skill }}</span>
                                @endforeach
                                @if (count($skills) > 4)
                                    <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-500 text-xs font-medium">+{{ count($skills) - 4 }}</span>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Action Button --}}
                    <a href="{{ route('talenta.show', $item) }}" class="mt-5 w-full inline-flex items-center justify-center gap-2 hover:bg-blue-700 bg-blue-600 text-white text-sm font-semibold py-3 rounded-xl transition-all duration-200 shadow-lg shadow-slate-900/10 hover:shadow-blue-600/20">
                        Lihat Profil Lengkap
                        <svg class="w-4 h-4 transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                </article>
            @empty
                {{-- Empty State --}}
                <div class="sm:col-span-2 lg:col-span-3 bg-white rounded-2xl border border-slate-200 p-12 text-center">
                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <p class="text-base font-semibold text-slate-800">Talenta belum tersedia</p>
                    <p class="text-sm text-slate-500 mt-1 max-w-md mx-auto">Belum ada profil alumni yang dipublikasikan atau sesuai dengan kata kunci pencarian Anda.</p>
                    @if (request()->filled('cari'))
                        <a href="{{ route('talenta.index') }}" class="mt-4 inline-flex items-center gap-1.5 text-sm font-medium text-[#024CD4] hover:underline">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            Reset Pencarian
                        </a>
                    @endif
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($talenta->hasPages())
            <div class="mt-10 flex justify-center">
                {{ $talenta->links() }}
            </div>
        @endif
    </section>

</x-layouts.public>