<div class="space-y-5 max-w-4xl mx-auto">
    
    {{-- Section 1: Detail Pekerjaan --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Detail Pekerjaan</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Informasi dasar tentang posisi yang dibuka</p>
                </div>
            </div>
        </div>

        <div class="p-5 sm:p-6 space-y-5">
            <div class="grid sm:grid-cols-2 gap-5">
                {{-- Posisi --}}
                <div class="sm:col-span-2">
                    <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Posisi / Jabatan
                        <span class="text-xs font-normal text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" name="posisi" value="{{ old('posisi', $lowongan->posisi ?? '') }}" required
                        class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                        placeholder="Contoh: Frontend Developer, Staff Administrasi">
                    @error('posisi') 
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Lokasi
                        <span class="text-xs font-normal text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $lowongan->lokasi ?? '') }}" required
                        class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                        placeholder="Kota, Provinsi">
                    @error('lokasi') 
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>

                {{-- Jenis Pekerjaan --}}
                <div>
                    <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Jenis Pekerjaan
                        <span class="text-xs font-normal text-red-500 ml-1">*</span>
                    </label>
                    <select name="jenis_pekerjaan" required
                        class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition bg-white">
                        @foreach (['Full Time', 'Part Time', 'Magang', 'Kontrak'] as $jenis)
                            <option value="{{ $jenis }}" @selected(old('jenis_pekerjaan', $lowongan->jenis_pekerjaan ?? '') === $jenis)>{{ $jenis }}</option>
                        @endforeach
                    </select>
                    @error('jenis_pekerjaan') 
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>

                {{-- Gaji --}}
                <div>
                    <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Rentang Gaji <span class="text-xs font-normal text-slate-400 ml-1">(Opsional)</span>
                    </label>
                    <input type="text" name="gaji" value="{{ old('gaji', $lowongan->gaji ?? '') }}"
                        class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                        placeholder="Contoh: Rp 3.000.000 - 4.000.000">
                    @error('gaji') 
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>

                {{-- Batas Melamar --}}
                <div>
                    <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Batas Melamar
                        <span class="text-xs font-normal text-red-500 ml-1">*</span>
                    </label>
                    <input type="date" name="deadline" value="{{ old('deadline', isset($lowongan) ? $lowongan->deadline->format('Y-m-d') : '') }}" required
                        class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition">
                    @error('deadline') 
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Section 2: Deskripsi & Persyaratan --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Deskripsi & Persyaratan</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Jelaskan tanggung jawab dan kualifikasi yang dibutuhkan</p>
                </div>
            </div>
        </div>

        <div class="p-5 sm:p-6 space-y-5">
            {{-- Deskripsi Pekerjaan --}}
            <div>
                <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/>
                    </svg>
                    Deskripsi Pekerjaan
                    <span class="text-xs font-normal text-red-500 ml-1">*</span>
                </label>
                <textarea name="deskripsi" rows="5" required
                    class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition resize-none"
                    placeholder="Jelaskan secara rinci tanggung jawab, tugas harian, dan target dari posisi ini...">{{ old('deskripsi', $lowongan->deskripsi ?? '') }}</textarea>
                @error('deskripsi') 
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p> 
                @enderror
            </div>

            {{-- Persyaratan --}}
            <div>
                <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    Persyaratan Kandidat
                    <span class="text-xs font-normal text-red-500 ml-1">*</span>
                </label>
                <textarea name="persyaratan" rows="5" required
                    class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition resize-none"
                    placeholder="1. Minimal lulusan SMK/SMA&#10;2. Menguasai Microsoft Office&#10;3. Memiliki motivasi tinggi">{{ old('persyaratan', $lowongan->persyaratan ?? '') }}</textarea>
                <div class="mt-2 flex items-start gap-2 p-2.5 rounded-lg bg-blue-50 border border-blue-100">
                    <svg class="w-4 h-4 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-xs text-blue-800 leading-relaxed">
                        <span class="font-semibold">Tips:</span> Tulis setiap poin persyaratan pada baris baru agar sistem dapat menampilkannya sebagai daftar (bullet points) yang rapi di halaman publik.
                    </p>
                </div>
                @error('persyaratan') 
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p> 
                @enderror
            </div>
        </div>
    </div>

    {{-- Section 3: Proses Lamaran --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Proses Lamaran</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Panduan bagi pelamar untuk mengirimkan aplikasi</p>
                </div>
            </div>
        </div>

        <div class="p-5 sm:p-6">
            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                </svg>
                Cara Melamar
                <span class="text-xs font-normal text-red-500 ml-1">*</span>
            </label>
            <textarea name="cara_melamar" rows="4" required
                class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition resize-none"
                placeholder="Contoh:&#10;Kirimkan CV dan Portofolio ke email: hrd@perusahaan.com&#10;Subjek: Lamaran [Posisi] - [Nama Lengkap]">{{ old('cara_melamar', $lowongan->cara_melamar ?? '') }}</textarea>
            <p class="mt-2 text-xs text-slate-500">Sertakan email, link formulir, atau instruksi spesifik agar pelamar tidak bingung.</p>
            @error('cara_melamar') 
                <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    {{ $message }}
                </p> 
            @enderror
        </div>
    </div>

    {{-- Warning Box (Edit Mode Only) --}}
    @if (isset($lowongan))
        <div class="flex items-start gap-3 p-4 rounded-xl bg-amber-50 border border-amber-200">
            <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <div>
                <p class="text-sm font-semibold text-amber-900">Perhatian</p>
                <p class="text-xs text-amber-800 mt-1 leading-relaxed">
                    Mengubah data lowongan yang sudah pernah disetujui akan mengembalikan statusnya menjadi <span class="font-bold">"Menunggu Persetujuan"</span>. Admin akan meninjau ulang perubahan Anda sebelum lowongan kembali ditampilkan ke publik.
                </p>
            </div>
        </div>
    @endif

    {{-- Section 4: Aksi --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-5 bg-white border border-slate-200/70 rounded-xl shadow-sm">
        <p class="text-xs text-slate-500 flex items-start gap-1.5">
            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Pastikan semua informasi sudah benar dan jelas sebelum mengirimkan untuk ditinjau.
        </p>
        <div class="flex items-center gap-2">
            <a href="{{ route('mitra.lowongan.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition">Batal</a>
            <button type="submit" class="inline-flex items-center gap-1.5 px-5 py-2 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Lowongan
            </button>
        </div>
    </div>

</div>