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

    <div class="max-w-6xl mx-auto space-y-6" x-data="{
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

        {{-- Hero Banner dengan Gradient Modern --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 p-8 text-white shadow-2xl">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl -mr-20 -mt-20"></div>
            <div class="absolute bottom-0 left-0 w-72 h-72 bg-indigo-500/20 rounded-full blur-3xl -ml-10 -mb-10"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center gap-6">
                {{-- Avatar dengan Upload --}}
                <div class="relative group">
                    <div class="w-28 h-28 rounded-2xl bg-gradient-to-br from-white/20 to-white/5 backdrop-blur-sm border-2 border-white/30 flex items-center justify-center text-5xl font-bold shadow-xl overflow-hidden">
                        <template x-if="photoPreview">
                            <img :src="photoPreview" alt="Preview" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!photoPreview">
                            @if ($alumni->foto_path)
                                <img src="{{ Storage::url($alumni->foto_path) }}" alt="{{ $alumni->nama }}" class="w-full h-full object-cover">
                            @else
                                <span>{{ strtoupper(substr($alumni->nama, 0, 1)) }}</span>
                            @endif
                        </template>
                    </div>
                    <label for="foto" class="absolute -bottom-2 -right-2 w-9 h-9 bg-blue-500 hover:bg-blue-600 rounded-xl flex items-center justify-center cursor-pointer shadow-lg transition-all hover:scale-110 border-2 border-white">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </label>
                    <input type="file" id="foto" name="foto" accept="image/*" @change="fileChosen" class="hidden">
                </div>

                {{-- Info Profil --}}
                <div class="flex-1">
                    <div class="flex flex-wrap items-center gap-2 mb-2">
                        <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-sm text-xs font-semibold border border-white/30">
                            NIS: {{ $alumni->nis }}
                        </span>
                        <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-sm text-xs font-semibold border border-white/30">
                            Lulusan {{ $alumni->tahun_lulus }}
                        </span>
                        @if ($alumni->status)
                            <span class="px-3 py-1 rounded-full {{ $alumni->status === 'Bekerja' ? 'bg-emerald-500/30 border-emerald-400/50' : ($alumni->status === 'Berwirausaha' ? 'bg-amber-500/30 border-amber-400/50' : 'bg-slate-500/30 border-slate-400/50') }} backdrop-blur-sm text-xs font-semibold border">
                                {{ $alumni->status }}
                            </span>
                        @endif
                    </div>
                    <h1 class="text-3xl font-bold mb-1">{{ $alumni->nama }}</h1>
                    <p class="text-blue-100 text-sm">
                        {{ $alumni->jurusan }} 
                        @if ($alumni->classroom)
                            <span class="mx-2">•</span>
                            <span>{{ $alumni->classroom }}</span>
                        @endif
                    </p>
                </div>

                {{-- Status Talent Pool --}}
                <div class="shrink-0">
                    @if ($alumni->talent_approval_status === 'disetujui')
                        <div class="px-5 py-3 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 backdrop-blur-sm">
                            <div class="flex items-center gap-2">
                                <span class="relative flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                                </span>
                                <div>
                                    <p class="text-sm font-bold text-emerald-300">Aktif</p>
                                    <p class="text-xs text-emerald-200/80">Talent Pool</p>
                                </div>
                            </div>
                        </div>
                    @elseif ($alumni->talent_approval_status === 'menunggu')
                        <div class="px-5 py-3 rounded-2xl bg-amber-500/20 border border-amber-400/30 backdrop-blur-sm">
                            <div class="flex items-center gap-2">
                                <span class="flex h-3 w-3 rounded-full bg-amber-500"></span>
                                <div>
                                    <p class="text-sm font-bold text-amber-300">Review</p>
                                    <p class="text-xs text-amber-200/80">Menunggu</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="px-5 py-3 rounded-2xl bg-white/10 border border-white/20 backdrop-blur-sm">
                            <div class="flex items-center gap-2">
                                <span class="flex h-3 w-3 rounded-full bg-slate-400"></span>
                                <div>
                                    <p class="text-sm font-bold text-slate-300">Draf</p>
                                    <p class="text-xs text-slate-400">Belum diajukan</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Progress Bar --}}
            <div class="relative z-10 mt-8 pt-6 border-t border-white/20">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Kelengkapan Profil
                    </span>
                    <span class="text-2xl font-bold">{{ $completionPercent }}%</span>
                </div>
                <div class="h-3 bg-black/20 rounded-full overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-700 {{ $completionPercent >= 80 ? 'bg-gradient-to-r from-emerald-400 to-teal-400' : ($completionPercent >= 50 ? 'bg-gradient-to-r from-blue-400 to-indigo-400' : 'bg-gradient-to-r from-amber-400 to-orange-400') }}" style="width: {{ $completionPercent }}%"></div>
                </div>
                <p class="mt-3 text-sm text-blue-100">
                    @if ($completionPercent < 50)
                        <span class="font-semibold text-amber-300">Tip:</span> Lengkapi headline, keahlian, dan unggah CV agar profil siap dilirik perusahaan!
                    @elseif ($completionPercent < 80)
                        <span class="font-semibold text-blue-300">Bagus!</span> Tambahkan portofolio dan media sosial untuk peluang lebih besar.
                    @else
                        <span class="font-semibold text-emerald-300">Sempurna!</span> Profil Anda sudah siap bersaing di dunia kerja!
                    @endif
                </p>
            </div>
        </div>

        {{-- Info SiPintu --}}
        <div class="rounded-2xl border border-blue-200 bg-gradient-to-r from-blue-50 to-indigo-50 p-5 flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <div class="flex-1">
                <p class="font-bold text-blue-900 text-sm">Akun Terintegrasi dengan SiPintu</p>
                <p class="mt-1 text-xs text-blue-800/80 leading-relaxed">
                    Akun Anda tersinkronisasi dengan <strong>SiPintu Identity Gateway</strong>. Untuk mengubah password, silakan akses portal SiPintu.
                </p>
                <a href="{{ config('services.sipintu.base_url', 'https://sipintu.smkn1bangsri.sch.id') }}" target="_blank" class="inline-flex items-center gap-1.5 mt-3 px-4 py-2 bg-white rounded-lg text-blue-700 text-xs font-semibold hover:bg-blue-50 transition border border-blue-200 shadow-sm">
                    <span>Buka Portal SiPintu</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
            </div>
        </div>

        <form method="POST" action="{{ route('alumni.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Section 1: Informasi Profesional --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/80 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-900">Informasi Profesional</h2>
                        <p class="text-xs text-slate-500">Data yang akan dilihat oleh HRD dan perusahaan mitra</p>
                    </div>
                </div>

                <div class="p-6 space-y-5">
                    {{-- Headline --}}
                    <div x-data="{ len: {{ strlen(old('headline', $alumni->headline)) }} }">
                        <label class="block text-sm font-bold text-slate-800 mb-1.5">
                            Headline Profesional <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="headline" value="{{ old('headline', $alumni->headline) }}" 
                            @input="len = $el.value.length"
                            maxlength="100"
                            class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-sm transition"
                            placeholder="Contoh: Junior Web Developer | UI/UX Designer">
                        <div class="flex justify-between mt-1.5">
                            <p class="text-xs text-slate-400">Deskripsi singkat 1 baris tentang peran/minat karier Anda</p>
                            <p class="text-xs font-semibold" :class="len > 90 ? 'text-amber-600' : 'text-slate-400'">
                                <span x-text="len"></span>/100
                            </p>
                        </div>
                        @error('headline')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Ringkasan --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-800 mb-1.5">Ringkasan Profil</label>
                        <textarea name="ringkasan" rows="5" 
                            class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-sm transition resize-none"
                            placeholder="Ceritakan pengalaman, proyek, dan motivasi karier Anda...">{{ old('ringkasan', $alumni->ringkasan) }}</textarea>
                        @error('ringkasan')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Keahlian --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-800 mb-1.5">
                            Keahlian <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="keahlian" value="{{ old('keahlian', $alumni->keahlian) }}" 
                            class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-sm transition"
                            placeholder="PHP, Laravel, Tailwind CSS, Figma, MySQL">
                        <p class="mt-1.5 text-xs text-slate-400">Pisahkan dengan koma untuk setiap keahlian</p>
                        @error('keahlian')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Portfolio URL --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-800 mb-1.5">Tautan Portofolio/GitHub</label>
                        <input type="url" name="portfolio_url" value="{{ old('portfolio_url', $alumni->portfolio_url) }}" 
                            class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-sm transition font-mono text-xs"
                            placeholder="https://github.com/username">
                        @error('portfolio_url')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Section 2: Media Sosial --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/80 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-pink-100 text-pink-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-900">Media Sosial</h2>
                        <p class="text-xs text-slate-500">Tautkan akun untuk mempermudah mitra mengenal Anda</p>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid md:grid-cols-3 gap-5">
                        {{-- LinkedIn --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-800 mb-1.5 flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#0A66C2]" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                                LinkedIn
                            </label>
                            <input type="text" name="linkedin_url" value="{{ old('linkedin_url', $alumni->linkedin_url) }}"
                                class="w-full rounded-xl border-slate-200 focus:border-[#0A66C2] focus:ring-4 focus:ring-[#0A66C2]/10 text-sm transition"
                                placeholder="linkedin.com/in/username">
                        </div>

                        {{-- Instagram --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-800 mb-1.5 flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#E4405F]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                Instagram
                            </label>
                            <input type="text" name="instagram_url" value="{{ old('instagram_url', $alumni->instagram_url) }}"
                                class="w-full rounded-xl border-slate-200 focus:border-[#E4405F] focus:ring-4 focus:ring-[#E4405F]/10 text-sm transition"
                                placeholder="@username">
                        </div>

                        {{-- TikTok --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-800 mb-1.5 flex items-center gap-2">
                                <svg class="w-4 h-4 text-slate-900" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.64 1.82 2.89 3.5 2.77 1.81-.03 3.28-1.54 3.32-3.35.03-2.73.01-5.46.01-8.19l-.01-8.68h3.91z"/></svg>
                                TikTok
                            </label>
                            <input type="text" name="tiktok_url" value="{{ old('tiktok_url', $alumni->tiktok_url) }}"
                                class="w-full rounded-xl border-slate-200 focus:border-slate-900 focus:ring-4 focus:ring-slate-900/10 text-sm transition"
                                placeholder="@username">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 3: Upload Dokumen --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/80 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-violet-100 text-violet-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-900">Dokumen Pendukung</h2>
                        <p class="text-xs text-slate-500">Unggah CV dan portofolio untuk memperkuat profil</p>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- CV Upload --}}
                        <div class="rounded-xl border-2 border-dashed border-slate-300 p-5 hover:border-blue-400 transition bg-slate-50/50">
                            <div class="flex items-center justify-between mb-3">
                                <label class="flex items-center gap-2 text-sm font-bold text-slate-900">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    Curriculum Vitae
                                </label>
                                @if ($alumni->cv_path)
                                    <span class="px-2 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold">Tersimpan</span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-500 mb-3">Format: PDF, DOC, DOCX (Max 5MB)</p>
                            <input type="file" name="cv" accept=".pdf,.doc,.docx" 
                                class="block w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700 file:cursor-pointer file:transition cursor-pointer">
                            @error('cv')<p class="mt-2 text-xs text-red-600">{{ $message }}</p>@enderror
                            @if ($alumni->cv_path)
                                <div class="flex items-center gap-3 mt-3">
                                    <a href="{{ route('alumni.cv.view') }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-700 hover:text-blue-600 hover:underline">
                                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        Lihat CV
                                    </a>
                                    <span class="text-slate-300">•</span>
                                    <a href="{{ route('alumni.cv.download') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-600 hover:underline">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        Unduh CV
                                    </a>
                                </div>
                            @endif
                        </div>

                        {{-- Portfolio Upload --}}
                        <div class="rounded-xl border-2 border-dashed border-slate-300 p-5 hover:border-violet-400 transition bg-slate-50/50">
                            <div class="flex items-center justify-between mb-3">
                                <label class="flex items-center gap-2 text-sm font-bold text-slate-900">
                                    <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Berkas Portofolio
                                </label>
                                @if ($alumni->portfolio_path)
                                    <span class="px-2 py-1 rounded-full bg-violet-100 text-violet-700 text-xs font-bold">Tersimpan</span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-500 mb-3">Format: PDF atau ZIP (Max 10MB)</p>
                            <input type="file" name="portfolio" accept=".pdf,.zip" 
                                class="block w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-violet-600 file:text-white hover:file:bg-violet-700 file:cursor-pointer file:transition cursor-pointer">
                            @error('portfolio')<p class="mt-2 text-xs text-red-600">{{ $message }}</p>@enderror
                            @if ($alumni->portfolio_path)
                                <div class="flex items-center gap-3 mt-3">
                                    <a href="{{ route('alumni.portfolio.view') }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-700 hover:text-violet-600 hover:underline">
                                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        Lihat Portofolio
                                    </a>
                                    <span class="text-slate-300">•</span>
                                    <a href="{{ route('alumni.portfolio.download') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-violet-600 hover:underline">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        Unduh Portofolio
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 4: Talent Pool --}}
            <div x-data="{
                wantsPublication: @js((bool) old('is_visible', $alumni->is_visible || $alumni->talent_approval_status === 'menunggu')),
                initialWantsPublication: @js((bool) old('is_visible', $alumni->is_visible || $alumni->talent_approval_status === 'menunggu')),
                isDirty: false
            }" class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/80 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-900">Publikasi ke Talent Pool</h2>
                        <p class="text-xs text-slate-500">Ajukan profil agar ditemukan perusahaan mitra</p>
                    </div>
                </div>

                <div class="p-6 space-y-4">
                    <label class="flex items-start gap-4 p-5 rounded-xl border-2 border-slate-200 hover:border-blue-300 hover:bg-blue-50/30 transition cursor-pointer">
                        <input type="checkbox" name="is_visible" value="1"
                            x-model="wantsPublication"
                            @change="isDirty = wantsPublication !== initialWantsPublication"
                            @checked(old('is_visible', $alumni->is_visible || $alumni->talent_approval_status === 'menunggu'))
                            class="mt-1 h-5 w-5 rounded-md border-slate-300 text-blue-600 focus:ring-4 focus:ring-blue-500/10 transition">
                        <div class="flex-1">
                            <span class="block text-sm font-bold text-slate-900">Ajukan profil ke Talent Pool BKK</span>
                            <span class="block text-xs text-slate-500 mt-1.5">Profil akan ditinjau Admin. Setelah disetujui, perusahaan mitra dapat melihat keahlian, portofolio, dan CV Anda.</span>
                        </div>
                    </label>

                    <div class="flex items-start gap-3 p-4 rounded-xl bg-slate-100 border border-slate-200">
                        <svg class="w-5 h-5 text-slate-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <span class="text-xs text-slate-600"><strong>Privasi Terjamin:</strong> Nomor HP dan Email tidak ditampilkan ke publik.</span>
                    </div>

                    <div x-show="isDirty" x-cloak class="flex items-start gap-3 p-4 rounded-xl bg-blue-50 border border-blue-200">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p x-show="wantsPublication" class="text-sm font-bold text-blue-950">Status akan diajukan ke Admin</p>
                            <p x-show="!wantsPublication" class="text-sm font-bold text-blue-950">Profil akan disembunyikan dari Talent Pool</p>
                            <p class="text-xs text-blue-700 mt-1">Klik tombol "Simpan" di bawah untuk menerapkan.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-end pt-4">
                <button type="submit" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold text-sm shadow-lg shadow-blue-600/25 hover:shadow-blue-600/40 transition-all duration-200 active:scale-[0.98]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    <span>Simpan Perubahan Profil</span>
                </button>
            </div>
        </form>
    </div>
</x-layouts.alumni>