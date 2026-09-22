<x-layouts.alumni title="Dashboard & Profil Saya">
    @php
        $completionFields = [
            'headline' => !empty($alumni->headline),
            'ringkasan' => !empty($alumni->ringkasan),
            'keahlian' => !empty($alumni->keahlian),
            'foto' => !empty($alumni->foto_path),
            'cv' => !empty($alumni->cv_path),
            'portfolio' => !empty($alumni->portfolio_path) || !empty($alumni->portfolio_url),
            'sosial' => !empty($alumni->linkedin_url) || !empty($alumni->instagram_url) || !empty($alumni->tiktok_url),
        ];
        $completedCount = count(array_filter($completionFields));
        $completionPercent = round(($completedCount / count($completionFields)) * 100);
    @endphp

    <div class="max-w-4xl mx-auto space-y-6" x-data="{
        photoPreview: null,
        fileChosen(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => { this.photoPreview = e.target.result; };
                reader.readAsDataURL(file);
            }
        }
    }">

        {{-- Top Hero / Welcome Banner --}}
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 via-blue-950 to-indigo-950 p-6 sm:p-8 text-white shadow-xl border border-white/10">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                <div class="flex items-center gap-4 sm:gap-5">
                    {{-- Avatar with preview --}}
                    <div class="relative shrink-0">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl overflow-hidden bg-gradient-to-br from-blue-600 to-indigo-600 text-white flex items-center justify-center text-3xl font-bold ring-4 ring-white/15 shadow-inner">
                            <template x-if="photoPreview">
                                <img :src="photoPreview" alt="Preview Foto" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!photoPreview">
                                @if ($alumni->foto_path)
                                    <img src="{{ Storage::url($alumni->foto_path) }}" alt="{{ $alumni->nama }}" class="w-full h-full object-cover">
                                @else
                                    <span>{{ strtoupper(substr($alumni->nama, 0, 1)) }}</span>
                                @endif
                            </template>
                        </div>
                        <label for="foto" class="absolute -bottom-1.5 -right-1.5 w-7 h-7 rounded-lg bg-blue-600 hover:bg-blue-500 text-white flex items-center justify-center cursor-pointer shadow-md transition-all hover:scale-105" title="Ganti Foto">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </label>
                    </div>

                    {{-- Identity Info --}}
                    <div class="min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-blue-500/20 text-blue-300 border border-blue-400/30">
                                NIS: {{ $alumni->nis }}
                            </span>
                            @if ($alumni->tahun_lulus)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-white/10 text-slate-300 border border-white/10">
                                    Lulusan {{ $alumni->tahun_lulus }}
                                </span>
                            @endif
                            @if ($alumni->status)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold {{ $alumni->status === 'Bekerja' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-400/30' : ($alumni->status === 'Berwirausaha' ? 'bg-amber-500/20 text-amber-300 border border-amber-400/30' : 'bg-slate-500/20 text-slate-300 border border-slate-400/30') }}">
                                    {{ $alumni->status }}
                                </span>
                            @endif
                        </div>

                        <h1 class="mt-2 text-xl sm:text-2xl font-bold text-white tracking-tight truncate" title="{{ $alumni->nama }}">
                            {{ $alumni->nama }}
                        </h1>
                        <p class="text-xs sm:text-sm text-slate-300 mt-0.5 truncate">
                            {{ $alumni->jurusan ?: 'Alumni SMKN 1 Bangsri' }}
                            @if ($alumni->classroom)
                                <span class="text-slate-400">&bull; {{ $alumni->classroom }}</span>
                            @endif
                        </p>
                    </div>
                </div>

                {{-- Status Talent Pool Pill --}}
                <div class="shrink-0 w-full sm:w-auto self-stretch sm:self-center">
                    @if ($alumni->talent_approval_status === 'disetujui')
                        <div class="flex items-center justify-between sm:justify-start gap-2.5 px-4 py-2.5 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-300">
                            <span class="flex h-2.5 w-2.5 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                            </span>
                            <div class="text-left">
                                <p class="text-xs font-semibold leading-tight">Dipublikasikan</p>
                                <p class="text-[10px] text-emerald-400/80 leading-tight">Aktif di Talent Pool Mitra</p>
                            </div>
                        </div>
                    @elseif ($alumni->talent_approval_status === 'menunggu')
                        <div class="flex items-center justify-between sm:justify-start gap-2.5 px-4 py-2.5 rounded-xl bg-amber-500/15 border border-amber-500/30 text-amber-300">
                            <span class="flex h-2.5 w-2.5 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-amber-500"></span>
                            </span>
                            <div class="text-left">
                                <p class="text-xs font-semibold leading-tight">Menunggu Review</p>
                                <p class="text-[10px] text-amber-400/80 leading-tight">Sedang ditinjau Admin</p>
                            </div>
                        </div>
                    @elseif ($alumni->talent_approval_status === 'ditolak')
                        <div class="flex items-center justify-between sm:justify-start gap-2.5 px-4 py-2.5 rounded-xl bg-red-500/15 border border-red-500/30 text-red-300">
                            <span class="h-2.5 w-2.5 rounded-full bg-red-500"></span>
                            <div class="text-left">
                                <p class="text-xs font-semibold leading-tight">Pengajuan Ditolak</p>
                                <p class="text-[10px] text-red-400/80 leading-tight">Perbaiki lalu ajukan ulang</p>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center justify-between sm:justify-start gap-2.5 px-4 py-2.5 rounded-xl bg-white/10 border border-white/15 text-slate-300">
                            <span class="h-2.5 w-2.5 rounded-full bg-slate-400"></span>
                            <div class="text-left">
                                <p class="text-xs font-semibold leading-tight">Draf Profil</p>
                                <p class="text-[10px] text-slate-400 leading-tight">Belum diajukan ke Talent Pool</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Profile Completion Bar --}}
            <div class="mt-6 pt-5 border-t border-white/10">
                <div class="flex items-center justify-between text-xs mb-2">
                    <span class="font-medium text-slate-300 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Kelengkapan Profil
                    </span>
                    <span class="font-bold text-white">{{ $completionPercent }}%</span>
                </div>
                <div class="w-full h-2.5 bg-white/10 rounded-full overflow-hidden p-0.5">
                    <div class="h-full rounded-full transition-all duration-500 {{ $completionPercent >= 80 ? 'bg-gradient-to-r from-emerald-400 to-teal-400' : ($completionPercent >= 50 ? 'bg-gradient-to-r from-blue-400 to-indigo-400' : 'bg-gradient-to-r from-amber-400 to-orange-400') }}" style="width: {{ $completionPercent }}%"></div>
                </div>
                <p class="mt-2 text-[11px] text-slate-400">
                    @if ($completionPercent < 50)
                        Lengkapi headline, keahlian, dan unggah CV Anda agar profil siap dilirik perusahaan mitra BKK.
                    @elseif ($completionPercent < 80)
                        Bagus! Unggah CV dan tautkan portofolio/media sosial untuk meningkatkan peluang rekrutmen.
                    @else
                        Profil Anda sudah sangat lengkap dan siap diajukan ke Talent Pool perusahaan mitra!
                    @endif
                </p>
            </div>
        </div>

        {{-- SiPintu Password Policy Notice --}}
        <div class="rounded-2xl border border-blue-200/80 bg-gradient-to-r from-blue-50/90 to-indigo-50/70 p-4 sm:p-5 text-xs sm:text-sm text-blue-900 shadow-sm flex items-start gap-3.5">
            <div class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-sm mt-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-bold text-blue-950 text-sm">Akun Terintegrasi dengan SiPintu Single Sign-On</p>
                <p class="mt-1 text-xs sm:text-sm text-blue-800 leading-relaxed">
                    Akun alumni Anda tersinkronisasi otomatis dengan <strong>SiPintu Identity Gateway</strong>. Sesuai kebijakan keamanan terpusat sekolah, pembaruan kata sandi dilakukan secara aman melalui portal SiPintu.
                </p>
                <div class="mt-2.5">
                    <a href="{{ config('services.sipintu.base_url', 'https://sipintu.smkn1bangsri.sch.id') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 font-semibold text-xs text-blue-700 hover:text-blue-900 bg-white/80 hover:bg-white px-3 py-1.5 rounded-lg border border-blue-200 shadow-2xs transition">
                        <span>Buka Portal SiPintu Gateway</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('alumni.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Section 1: Informasi Profesional --}}
            <div class="bg-white border border-slate-200/80 rounded-2xl shadow-xs overflow-hidden transition-all hover:shadow-sm">
                <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/70">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-900">Informasi Profesional</h2>
                            <p class="text-xs text-slate-500">Data profil keahlian yang akan dilihat oleh HRD dan perusahaan mitra</p>
                        </div>
                    </div>
                </div>

                <div class="p-5 sm:p-6 space-y-5">
                    {{-- Foto Profil Input --}}
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 pb-5 border-b border-slate-100">
                        <div class="w-20 h-20 rounded-2xl overflow-hidden bg-slate-100 text-slate-500 flex items-center justify-center text-2xl font-bold shrink-0 ring-1 ring-slate-200">
                            <template x-if="photoPreview">
                                <img :src="photoPreview" alt="Preview Foto" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!photoPreview">
                                @if ($alumni->foto_path)
                                    <img src="{{ Storage::url($alumni->foto_path) }}" alt="{{ $alumni->nama }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-blue-600">{{ strtoupper(substr($alumni->nama, 0, 1)) }}</span>
                                @endif
                            </template>
                        </div>
                        <div class="flex-1">
                            <label for="foto" class="block text-sm font-semibold text-slate-900">Perbarui Foto Profil</label>
                            <input id="foto" type="file" name="foto" accept=".jpg,.jpeg,.png,.webp" @change="fileChosen" class="mt-2 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 file:cursor-pointer file:transition cursor-pointer">
                            <p class="mt-1.5 text-xs text-slate-400">Format yang didukung: JPG, PNG, atau WEBP. Maksimal 2 MB.</p>
                            @error('foto')<p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Headline --}}
                    <div>
                        <label for="headline" class="flex items-center gap-1.5 text-sm font-semibold text-slate-800 mb-1.5">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            <span>Headline Profesional</span>
                            <span class="text-red-500 text-xs">*</span>
                        </label>
                        <input id="headline" name="headline" value="{{ old('headline', $alumni->headline) }}" 
                            class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-sm transition"
                            placeholder="Contoh: Junior Web Developer | UI/UX Designer | Fresh Graduate RPL">
                        <p class="mt-1.5 text-xs text-slate-400">Deskripsi singkat 1 baris yang meringkas peran atau minat karier Anda.</p>
                        @error('headline')<p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>@enderror
                    </div>

                    {{-- Ringkasan --}}
                    <div>
                        <label for="ringkasan" class="flex items-center gap-1.5 text-sm font-semibold text-slate-800 mb-1.5">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/></svg>
                            <span>Ringkasan Profil (Bio)</span>
                        </label>
                        <textarea id="ringkasan" name="ringkasan" rows="4" 
                            class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-sm transition resize-none"
                            placeholder="Ceritakan pengalaman belajar, proyek sekolah/magang yang pernah dikerjakan, serta motivasi karier Anda...">{{ old('ringkasan', $alumni->ringkasan) }}</textarea>
                        @error('ringkasan')<p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>@enderror
                    </div>

                    {{-- Keahlian --}}
                    <div>
                        <label for="keahlian" class="flex items-center gap-1.5 text-sm font-semibold text-slate-800 mb-1.5">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                            <span>Daftar Keahlian (Skills)</span>
                            <span class="text-red-500 text-xs">*</span>
                        </label>
                        <input id="keahlian" name="keahlian" value="{{ old('keahlian', $alumni->keahlian) }}" 
                            class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-sm transition"
                            placeholder="Pisahkan dengan koma, contoh: PHP, Laravel, Tailwind CSS, Figma, MySQL, Akuntansi">
                        <p class="mt-1.5 text-xs text-slate-400">Ketik keahlian teknis maupun soft skills Anda dipisahkan dengan koma.</p>
                        @error('keahlian')<p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>@enderror
                    </div>

                    {{-- Portfolio URL --}}
                    <div>
                        <label for="portfolio_url" class="flex items-center gap-1.5 text-sm font-semibold text-slate-800 mb-1.5">
                            <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                            <span>Tautan Website Portofolio / GitHub</span>
                        </label>
                        <input id="portfolio_url" type="url" name="portfolio_url" value="{{ old('portfolio_url', $alumni->portfolio_url) }}" 
                            class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-sm transition"
                            placeholder="https://github.com/username atau https://behance.net/username">
                        @error('portfolio_url')<p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Section 2: Media Sosial --}}
            <div class="bg-white border border-slate-200/80 rounded-2xl shadow-xs overflow-hidden transition-all hover:shadow-sm">
                <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/70">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-900">Media Sosial & Jejaring Profesional</h2>
                            <p class="text-xs text-slate-500">Tautkan akun sosial media Anda untuk mempermudah mitra mengenal karya Anda (opsional)</p>
                        </div>
                    </div>
                </div>

                <div class="p-5 sm:p-6">
                    <div class="grid sm:grid-cols-1 md:grid-cols-3 gap-5">
                        {{-- LinkedIn --}}
                        <div>
                            <label for="linkedin_url" class="flex items-center gap-2 text-sm font-semibold text-slate-800 mb-1.5">
                                <svg class="w-4 h-4 text-[#0A66C2]" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/>
                                </svg>
                                <span>LinkedIn</span>
                            </label>
                            <input id="linkedin_url" type="text" name="linkedin_url" value="{{ old('linkedin_url', $alumni->linkedin_url) }}"
                                class="w-full rounded-xl border-slate-200 focus:border-[#0A66C2] focus:ring-4 focus:ring-[#0A66C2]/10 text-sm transition placeholder:text-slate-400"
                                placeholder="Username atau link profil">
                            <p class="mt-1 text-[11px] text-slate-400">Contoh: namaanda atau linkedin.com/in/nama</p>
                            @error('linkedin_url')<p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>@enderror
                        </div>

                        {{-- Instagram --}}
                        <div>
                            <label for="instagram_url" class="flex items-center gap-2 text-sm font-semibold text-slate-800 mb-1.5">
                                <svg class="w-4 h-4 text-[#E4405F]" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                                <span>Instagram</span>
                            </label>
                            <input id="instagram_url" type="text" name="instagram_url" value="{{ old('instagram_url', $alumni->instagram_url) }}"
                                class="w-full rounded-xl border-slate-200 focus:border-[#E4405F] focus:ring-4 focus:ring-[#E4405F]/10 text-sm transition placeholder:text-slate-400"
                                placeholder="@username atau link profil">
                            <p class="mt-1 text-[11px] text-slate-400">Contoh: @namaanda</p>
                            @error('instagram_url')<p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>@enderror
                        </div>

                        {{-- TikTok --}}
                        <div>
                            <label for="tiktok_url" class="flex items-center gap-2 text-sm font-semibold text-slate-800 mb-1.5">
                                <svg class="w-4 h-4 text-slate-900" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.64 1.82 2.89 3.5 2.77 1.81-.03 3.28-1.54 3.32-3.35.03-2.73.01-5.46.01-8.19l-.01-8.68h3.91z"/>
                                </svg>
                                <span>TikTok</span>
                            </label>
                            <input id="tiktok_url" type="text" name="tiktok_url" value="{{ old('tiktok_url', $alumni->tiktok_url) }}"
                                class="w-full rounded-xl border-slate-200 focus:border-slate-900 focus:ring-4 focus:ring-slate-900/10 text-sm transition placeholder:text-slate-400"
                                placeholder="@username atau link TikTok">
                            <p class="mt-1 text-[11px] text-slate-400">Contoh: @namaanda</p>
                            @error('tiktok_url')<p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 3: Upload Dokumen --}}
            <div class="bg-white border border-slate-200/80 rounded-2xl shadow-xs overflow-hidden transition-all hover:shadow-sm">
                <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/70">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-900">Dokumen Karir Pendukung</h2>
                            <p class="text-xs text-slate-500">Unggah CV dan file portofolio untuk memperkuat profil Anda saat dilirik mitra</p>
                        </div>
                    </div>
                </div>

                <div class="p-5 sm:p-6">
                    <div class="grid sm:grid-cols-2 gap-6">
                        {{-- CV Upload Card --}}
                        <div class="rounded-xl border border-slate-200 bg-slate-50/40 p-4 sm:p-5 flex flex-col justify-between space-y-3">
                            <div>
                                <div class="flex items-center justify-between gap-2 mb-2">
                                    <label for="cv" class="flex items-center gap-1.5 text-sm font-bold text-slate-900">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                        Curriculum Vitae (CV)
                                    </label>
                                    @if ($alumni->cv_path)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                            Tersimpan
                                        </span>
                                    @endif
                                </div>
                                <p class="text-xs text-slate-500 mb-3">Format file: PDF, DOC, atau DOCX. Maksimal 5 MB.</p>
                                <input id="cv" type="file" name="cv" accept=".pdf,.doc,.docx" 
                                    class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 file:cursor-pointer file:transition cursor-pointer">
                                @error('cv')<p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>@enderror
                            </div>

                            @if ($alumni->cv_path)
                                <div class="pt-2 border-t border-slate-200/80 flex items-center justify-between">
                                    <span class="text-[11px] text-slate-500 truncate max-w-[160px]">CV aktif di sistem</span>
                                    <a href="{{ route('alumni.cv.download') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 hover:text-blue-800 hover:underline">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        Unduh CV
                                    </a>
                                </div>
                            @endif
                        </div>

                        {{-- Portfolio Upload Card --}}
                        <div class="rounded-xl border border-slate-200 bg-slate-50/40 p-4 sm:p-5 flex flex-col justify-between space-y-3">
                            <div>
                                <div class="flex items-center justify-between gap-2 mb-2">
                                    <label for="portfolio" class="flex items-center gap-1.5 text-sm font-bold text-slate-900">
                                        <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        Berkas Portofolio (Karya)
                                    </label>
                                    @if ($alumni->portfolio_path)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-violet-100 text-violet-800">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                            Tersimpan
                                        </span>
                                    @endif
                                </div>
                                <p class="text-xs text-slate-500 mb-3">Format file: PDF atau ZIP. Maksimal 10 MB.</p>
                                <input id="portfolio" type="file" name="portfolio" accept=".pdf,.zip" 
                                    class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-violet-600 file:text-white hover:file:bg-violet-700 file:cursor-pointer file:transition cursor-pointer">
                                @error('portfolio')<p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>@enderror
                            </div>

                            @if ($alumni->portfolio_path)
                                <div class="pt-2 border-t border-slate-200/80 flex items-center justify-between">
                                    <span class="text-[11px] text-slate-500 truncate max-w-[160px]">Portofolio aktif</span>
                                    <a href="{{ route('alumni.portfolio.download') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-violet-600 hover:text-violet-800 hover:underline">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        Unduh Portofolio
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 4: Pengajuan ke Talent Pool --}}
            <div
                x-data="{
                    wantsPublication: @js((bool) old('is_visible', $alumni->is_visible || $alumni->talent_approval_status === 'menunggu')),
                    initialWantsPublication: @js((bool) old('is_visible', $alumni->is_visible || $alumni->talent_approval_status === 'menunggu')),
                    isDirty: false
                }"
                class="bg-white border border-slate-200/80 rounded-2xl shadow-xs overflow-hidden transition-all hover:shadow-sm">
                <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/70">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-900">Publikasi ke Talent Pool Mitra BKK</h2>
                            <p class="text-xs text-slate-500">Ajukan profil Anda agar dapat ditemukan oleh perusahaan mitra yang mencari kandidat</p>
                        </div>
                    </div>
                </div>

                <div class="p-5 sm:p-6 space-y-4">
                    <label class="flex items-start gap-3.5 p-4 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-slate-50 transition cursor-pointer">
                        <input type="checkbox" name="is_visible" value="1"
                            x-model="wantsPublication"
                            @change="isDirty = wantsPublication !== initialWantsPublication"
                            @checked(old('is_visible', $alumni->is_visible || $alumni->talent_approval_status === 'menunggu'))
                            class="mt-1 h-5 w-5 rounded-md border-slate-300 text-blue-600 focus:ring-4 focus:ring-blue-500/10 transition cursor-pointer">
                        <div class="flex-1">
                            <span class="block text-sm font-bold text-slate-900">Ajukan profil saya ke Talent Pool Resmi BKK</span>
                            <span class="block text-xs text-slate-500 mt-1 leading-relaxed">
                                Profil Anda akan ditinjau oleh Admin BKK SMKN 1 Bangsri. Setelah disetujui, perusahaan mitra dapat melihat keahlian, portofolio, dan CV Anda.
                            </span>
                        </div>
                    </label>

                    {{-- Privacy Security Badge --}}
                    <div class="flex items-center gap-2.5 p-3 rounded-xl bg-slate-100/70 text-slate-600 text-xs">
                        <svg class="w-4 h-4 text-slate-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <span><strong>Privasi Terjamin:</strong> Nomor HP dan Email pribadi Anda tidak pernah ditampilkan ke publik demi keamanan data.</span>
                    </div>

                    {{-- Dynamic status note when toggle is changed --}}
                    <div x-show="isDirty" x-cloak class="flex items-center gap-3 p-3.5 rounded-xl bg-blue-50 border border-blue-200">
                        <div class="w-7 h-7 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p x-show="wantsPublication" class="text-xs font-bold text-blue-950">Status akan diajukan ke Admin untuk ditinjau</p>
                            <p x-show="!wantsPublication" class="text-xs font-bold text-blue-950">Status profil akan disembunyikan dari Talent Pool</p>
                            <p class="text-[11px] text-blue-700">Jangan lupa klik tombol "Simpan Perubahan Profil" di bawah untuk menerapkan.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Submit Action Bar (TOMBOL BATAL TELAH DIHAPUS) --}}
            <div class="pt-2 flex flex-col sm:flex-row items-center justify-end gap-3">
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 hover:from-blue-700 hover:to-indigo-800 text-white font-semibold text-sm shadow-md hover:shadow-lg transition-all duration-200 active:scale-[0.98] cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    <span>Simpan Perubahan Profil</span>
                </button>
            </div>
        </form>
    </div>
</x-layouts.alumni>