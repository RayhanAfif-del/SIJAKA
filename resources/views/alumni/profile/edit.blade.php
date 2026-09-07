<x-layouts.alumni title="Profil Talenta Saya">
    <div class="max-w-4xl mx-auto">
        
        {{-- Header Section --}}
        <div class="mb-6">
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                <a href="{{ route('alumni.dashboard') }}" class="hover:text-slate-700 transition flex items-center gap-1">
                    Dashboard
                </a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-slate-700 font-medium">Profil Talenta</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#024CD4]/10 text-[#024CD4] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div>
                    <h1 class="text-2xl font-semibold text-slate-900 tracking-tight">Profil Talenta Saya</h1>
                    <p class="text-sm text-slate-500 mt-0.5">Lengkapi profil agar mitra dapat menemukan keahlian Anda. Kontak pribadi tidak ditampilkan.</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('alumni.profile.update') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Section 1: Informasi Profesional --}}
            <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-[#024CD4] flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Informasi Profesional</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Data utama yang akan dilihat oleh perusahaan mitra</p>
                        </div>
                    </div>
                </div>

                <div class="p-5 sm:p-6 space-y-5">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 pb-5 border-b border-slate-100">
                        <div class="w-20 h-20 rounded-2xl overflow-hidden bg-blue-50 text-[#024CD4] flex items-center justify-center text-2xl font-bold shrink-0 ring-1 ring-blue-100">
                            @if ($alumni->foto_path)
                                <img src="{{ Storage::url($alumni->foto_path) }}" alt="Foto profil {{ $alumni->nama }}" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr($alumni->nama, 0, 1)) }}
                            @endif
                        </div>
                        <div class="flex-1">
                            <label for="foto" class="block text-sm font-semibold text-slate-900">Foto Profil</label>
                            <input id="foto" type="file" name="foto" accept=".jpg,.jpeg,.png,.webp" class="mt-2 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#024CD4]/10 file:text-[#024CD4] hover:file:bg-[#024CD4]/20 file:cursor-pointer file:transition cursor-pointer">
                            <p class="mt-1.5 text-xs text-slate-500">JPG, PNG, atau WEBP. Maksimal 2 MB.</p>
                            @error('foto')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Headline --}}
                    <div>
                        <label for="headline" class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            Headline Profesional
                            <span class="text-xs font-normal text-red-500 ml-1">*</span>
                        </label>
                        <input id="headline" name="headline" value="{{ old('headline', $alumni->headline) }}" 
                            class="w-full rounded-lg border-slate-200 focus:border-[#024CD4] focus:ring-2 focus:ring-[#024CD4]/20 text-sm transition"
                            placeholder="Contoh: Junior Web Developer | Lulusan RPL 2024">
                        @error('headline')<p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 11-2 0 1 1 0 012 0" clip-rule="evenodd"/></svg>{{ $message }}</p>@enderror
                    </div>

                    {{-- Ringkasan --}}
                    <div>
                        <label for="ringkasan" class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/></svg>
                            Ringkasan Profil
                        </label>
                        <textarea id="ringkasan" name="ringkasan" rows="4" 
                            class="w-full rounded-lg border-slate-200 focus:border-[#024CD4] focus:ring-2 focus:ring-[#024CD4]/20 text-sm transition resize-none"
                            placeholder="Ceritakan pengalaman, keahlian, dan tujuan karier Anda secara singkat...">{{ old('ringkasan', $alumni->ringkasan) }}</textarea>
                        @error('ringkasan')<p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 11-2 0 1 1 0 012 0" clip-rule="evenodd"/></svg>{{ $message }}</p>@enderror
                    </div>

                    {{-- Keahlian --}}
                    <div>
                        <label for="keahlian" class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                            Keahlian
                            <span class="text-xs font-normal text-red-500 ml-1">*</span>
                        </label>
                        <input id="keahlian" name="keahlian" value="{{ old('keahlian', $alumni->keahlian) }}" 
                            class="w-full rounded-lg border-slate-200 focus:border-[#024CD4] focus:ring-2 focus:ring-[#024CD4]/20 text-sm transition"
                            placeholder="Pisahkan dengan koma, contoh: PHP, Laravel, UI Design, MySQL">
                        @error('keahlian')<p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 11-2 0 1 1 0 012 0" clip-rule="evenodd"/></svg>{{ $message }}</p>@enderror
                    </div>

                    {{-- Portfolio URL --}}
                    <div>
                        <label for="portfolio_url" class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                            Tautan Portofolio
                        </label>
                        <input id="portfolio_url" type="url" name="portfolio_url" value="{{ old('portfolio_url', $alumni->portfolio_url) }}" 
                            class="w-full rounded-lg border-slate-200 focus:border-[#024CD4] focus:ring-2 focus:ring-[#024CD4]/20 text-sm transition"
                            placeholder="https://github.com/username atau https://behance.net/username">
                        @error('portfolio_url')<p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 11-2 0 1 1 0 012 0" clip-rule="evenodd"/></svg>{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Section 2: Upload Dokumen --}}
            <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Dokumen Pendukung</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Upload CV dan portofolio untuk memperkuat profil Anda</p>
                        </div>
                    </div>
                </div>

                <div class="p-5 sm:p-6">
                    <div class="grid sm:grid-cols-2 gap-5">
                        {{-- CV Upload --}}
                        <div>
                            <label for="cv" class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                Curriculum Vitae (CV)
                            </label>
                            <input id="cv" type="file" name="cv" accept=".pdf,.doc,.docx" 
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#024CD4]/10 file:text-[#024CD4] hover:file:bg-[#024CD4]/20 file:cursor-pointer file:transition cursor-pointer">
                            <p class="mt-1.5 text-xs text-slate-500 flex items-center gap-1">
                                @if ($alumni->cv_path)
                                    <svg class="w-3 h-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    CV tersimpan. Upload baru untuk mengganti.
                                @else
                                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Format: PDF, DOC, DOCX. Maksimal 5 MB.
                                @endif
                            </p>
                            @error('cv')<p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 11-2 0 1 1 0 012 0" clip-rule="evenodd"/></svg>{{ $message }}</p>@enderror
                        </div>

                        {{-- Portfolio Upload --}}
                        <div>
                            <label for="portfolio" class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Portofolio
                            </label>
                            <input id="portfolio" type="file" name="portfolio" accept=".pdf,.zip" 
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-violet-100 file:text-violet-700 hover:file:bg-violet-200 file:cursor-pointer file:transition cursor-pointer">
                            <p class="mt-1.5 text-xs text-slate-500 flex items-center gap-1">
                                @if ($alumni->portfolio_path)
                                    <svg class="w-3 h-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    Portofolio tersimpan. Upload baru untuk mengganti.
                                @else
                                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Format: PDF, ZIP. Maksimal 10 MB.
                                @endif
                            </p>
                            @error('portfolio')<p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 11-2 0 1 1 0 012 0" clip-rule="evenodd"/></svg>{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 3: Pengajuan Profil --}}
            <div
                x-data="{
                    wantsPublication: @js((bool) old('is_visible', $alumni->is_visible || $alumni->talent_approval_status === 'menunggu')),
                    initialWantsPublication: @js((bool) old('is_visible', $alumni->is_visible || $alumni->talent_approval_status === 'menunggu')),
                    isDirty: false
                }"
                class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Pengajuan ke Talent Pool</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Kirim profil Anda untuk ditinjau admin sebelum dipublikasikan</p>
                        </div>
                    </div>
                </div>

                <div class="p-5 sm:p-6">
                    <label class="flex items-start gap-3 p-4 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-slate-50 transition cursor-pointer">
                        <input type="checkbox" name="is_visible" value="1"
                            x-model="wantsPublication"
                            @change="isDirty = wantsPublication !== initialWantsPublication"
                            @checked(old('is_visible', $alumni->is_visible || $alumni->talent_approval_status === 'menunggu'))
                            class="mt-0.5 h-4 w-4 rounded border-slate-300 text-[#024CD4] focus:ring-2 focus:ring-[#024CD4]/20 transition cursor-pointer">
                        <div class="flex-1">
                            <span class="block text-sm font-semibold text-slate-900">Ajukan profil saya ke Talent Pool</span>
                            <span class="block text-xs text-slate-500 mt-1">Profil akan ditinjau admin terlebih dahulu. Mitra hanya dapat melihat data profesional setelah disetujui. Kontak pribadi Anda tetap aman dan tidak dipublikasikan.</span>
                        </div>
                    </label>

                    {{-- Preview status after changing the submission option --}}
                    <div x-show="isDirty" x-cloak class="mt-4 flex items-center gap-3 p-3.5 rounded-xl bg-blue-50 border border-blue-200">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p x-show="wantsPublication" class="text-xs font-semibold text-blue-900">Akan diajukan untuk persetujuan</p>
                            <p x-show="!wantsPublication" class="text-xs font-semibold text-blue-900">Akan disembunyikan dari Talent Pool</p>
                            <p class="text-xs text-blue-700 mt-0.5">Klik Simpan Profil untuk menerapkan perubahan ini.</p>
                        </div>
                    </div>

                    {{-- Status Indicator --}}
                    <div x-show="!isDirty">
                    @if ($alumni->talent_approval_status === 'menunggu')
                        <div class="mt-4 flex items-center gap-3 p-3.5 rounded-xl bg-amber-50 border border-amber-200">
                            <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-amber-900">Menunggu Persetujuan</p>
                                <p class="text-xs text-amber-700 mt-0.5">Profil Anda sedang ditinjau oleh admin BKK.</p>
                            </div>
                        </div>
                    @elseif ($alumni->talent_approval_status === 'disetujui')
                        <div class="mt-4 flex items-center gap-3 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-emerald-900">Profil Dipublikasikan</p>
                                <p class="text-xs text-emerald-700 mt-0.5">Profil Anda sudah dapat dilihat oleh perusahaan mitra.</p>
                            </div>
                        </div>
                    @elseif ($alumni->talent_approval_status === 'ditolak')
                        <div class="mt-4 flex items-center gap-3 p-3.5 rounded-xl bg-red-50 border border-red-200">
                            <div class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-red-900">Pengajuan Ditolak</p>
                                <p class="text-xs text-red-700 mt-0.5">Silakan perbaiki profil dan ajukan kembali.</p>
                            </div>
                        </div>
                    @else
                        <div class="mt-4 flex items-center gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-slate-900">Belum Diajukan</p>
                                <p class="text-xs text-slate-600 mt-0.5">Centang opsi di atas untuk mengajukan profil Anda.</p>
                            </div>
                        </div>
                    @endif
                    </div>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('alumni.dashboard') }}" class="px-5 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition">Batal</a>
                <button type="submit" class="inline-flex items-center gap-1.5 px-6 py-2.5 text-sm font-semibold text-white bg-[#024CD4] hover:bg-[#013ba8] rounded-lg shadow-sm shadow-blue-600/20 transition-all duration-200 hover:shadow-md active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Simpan Profil
                </button>
            </div>
        </form>

        @if (false)
        {{-- Section 4: Permintaan Wawancara --}}
        <div class="mt-8 bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
            <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Permintaan Wawancara</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Daftar perusahaan yang tertarik dengan profil Anda</p>
                        </div>
                    </div>
                    @if ($requests->count() > 0)
                        <span class="inline-flex items-center justify-center min-w-[24px] h-6 px-2 text-xs font-semibold bg-emerald-100 text-emerald-700 rounded-full">
                            {{ $requests->count() }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="p-5 sm:p-6">
                <div class="space-y-3">
                    @forelse($requests as $item)
                        <div class="border border-slate-200 rounded-xl p-4 hover:border-slate-300 hover:shadow-sm transition-all duration-200">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                <div class="flex items-start gap-3 flex-1 min-w-0">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#024CD4] to-blue-700 text-white flex items-center justify-center shrink-0 font-bold text-sm">
                                        {{ strtoupper(substr($item->mitra->nama_perusahaan ?? '?', 0, 1)) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-slate-900 truncate">{{ $item->mitra->nama_perusahaan ?? 'Perusahaan' }}</p>
                                        <p class="text-xs text-slate-500 mt-1 line-clamp-2">{{ $item->message ?: 'Tidak ada pesan tambahan.' }}</p>
                                        @if ($item->created_at)
                                            <p class="text-[10px] text-slate-400 mt-1.5 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                {{ $item->created_at->diffForHumans() }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 sm:shrink-0">
                                    @php
                                        $statusBadge = match($item->status) {
                                            'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                            'accepted' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                            'rejected' => 'bg-red-50 text-red-700 border-red-200',
                                            default => 'bg-slate-50 text-slate-700 border-slate-200',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full border text-xs font-semibold {{ $statusBadge }}">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current opacity-60"></span>
                                        {{ ucfirst($item->status ?? 'pending') }}
                                    </span>
                                    @if($item->status === 'pending')
                                        <div class="flex items-center gap-1.5 ml-1">
                                            <form method="POST" action="{{ route('alumni.interview.respond', [$item, 'accepted']) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200 hover:bg-emerald-100 transition-colors">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                    Terima
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('alumni.interview.respond', [$item, 'rejected']) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-red-700 bg-red-50 border border-red-200 hover:bg-red-100 transition-colors">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center text-center py-10">
                            <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center mb-3">
                                <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-slate-700">Belum ada permintaan wawancara</p>
                            <p class="text-xs text-slate-500 mt-1">Permintaan dari perusahaan akan muncul di sini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        @endif
    </div>
</x-layouts.alumni>