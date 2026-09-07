<x-layouts.mitra title="Profil Perusahaan">

    {{-- Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-2 text-xs text-slate-500 mb-3">
            <a href="{{ route('mitra.dashboard') }}" class="hover:text-[#024CD4] transition flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-slate-700 font-medium">Pengaturan</span>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-[#024CD4] font-semibold">Profil Perusahaan</span>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">Profil Perusahaan</h1>
                <p class="text-sm text-slate-500 mt-1.5 max-w-2xl">Kelola informasi, branding, dan deskripsi perusahaan Anda agar tampil profesional di mata para pelamar kerja.</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('mitra.profil.update') }}" enctype="multipart/form-data" class="grid lg:grid-cols-3 gap-6 max-w-7xl">
        
        {{-- Left Column: Form --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Section 1: Informasi Dasar --}}
            <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 text-[#024CD4] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-900">Informasi Dasar</h2>
                        <p class="text-xs text-slate-500">Nama resmi dan kontak utama perusahaan</p>
                    </div>
                </div>

                <div class="p-6 space-y-5">
                    <div>
                        <label class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-1.5">
                            Nama Perusahaan <span class="text-xs font-normal text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $mitra->nama_perusahaan) }}" required
                            class="w-full rounded-xl border-slate-200 focus:border-[#024CD4] focus:ring-2 focus:ring-[#024CD4]/20 text-sm transition placeholder:text-slate-400"
                            placeholder="Contoh: PT. Teknologi Maju Jaya">
                        @error('nama_perusahaan') 
                            <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p> 
                        @enderror
                    </div>

                    <div>
                        <label class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-1.5">
                            Email Akun
                        </label>
                        <div class="flex items-center gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-slate-600 text-sm select-none">
                            <svg class="w-5 h-5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <span class="font-medium">{{ $mitra->email }}</span>
                        </div>
                        <p class="text-xs text-slate-500 mt-2 flex items-start gap-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Untuk mengubah email akun, silakan hubungi admin BKK melalui halaman kontak.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Section 2: Detail & Deskripsi --}}
            <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-900">Detail & Deskripsi</h2>
                        <p class="text-xs text-slate-500">Informasi tambahan untuk menarik minat pelamar terbaik</p>
                    </div>
                </div>

                <div class="p-6 space-y-5">
                    <div>
                        <label class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-1.5">
                            Website Perusahaan
                        </label>
                        <input type="url" name="website" value="{{ old('website', $mitra->website) }}" 
                            class="w-full rounded-xl border-slate-200 focus:border-[#024CD4] focus:ring-2 focus:ring-[#024CD4]/20 text-sm transition placeholder:text-slate-400 font-mono text-xs"
                            placeholder="https://www.perusahaananda.com">
                        @error('website') 
                            <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p> 
                        @enderror
                    </div>

                    <div>
                        <label class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-1.5">
                            Alamat Kantor
                        </label>
                        <textarea name="alamat" rows="2" 
                            class="w-full rounded-xl border-slate-200 focus:border-[#024CD4] focus:ring-2 focus:ring-[#024CD4]/20 text-sm transition resize-none placeholder:text-slate-400"
                            placeholder="Jl. Contoh No. 123, Kecamatan, Kabupaten, Provinsi">{{ old('alamat', $mitra->alamat) }}</textarea>
                        @error('alamat') 
                            <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p> 
                        @enderror
                    </div>

                    <div>
                        <label class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-1.5">
                            Deskripsi Perusahaan
                        </label>
                        <textarea name="deskripsi" rows="6" 
                            class="w-full rounded-xl border-slate-200 focus:border-[#024CD4] focus:ring-2 focus:ring-[#024CD4]/20 text-sm transition resize-none placeholder:text-slate-400 leading-relaxed"
                            placeholder="Ceritakan singkat tentang bidang usaha, budaya kerja, visi, atau benefit yang ditawarkan perusahaan Anda...">{{ old('deskripsi', $mitra->deskripsi) }}</textarea>
                        @error('deskripsi') 
                            <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p> 
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Section 3: Branding (Logo) --}}
            <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-900">Branding & Logo</h2>
                        <p class="text-xs text-slate-500">Logo yang akan tampil di setiap lowongan yang Anda publikasikan</p>
                    </div>
                </div>

                <div class="p-6">
                    <div class="flex flex-col sm:flex-row gap-6 p-5 rounded-xl border-2 border-dashed border-slate-200 bg-slate-50/50 hover:border-[#024CD4]/40 hover:bg-blue-50/30 transition-colors duration-200">
                        {{-- Preview Logo --}}
                        <div class="w-24 h-24 rounded-xl border border-slate-200 bg-white overflow-hidden flex items-center justify-center shrink-0 shadow-sm relative group">
                            @if ($mitra->logo)
                                <img src="{{ Storage::url($mitra->logo) }}" alt="Logo Perusahaan" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="text-[10px] font-bold text-white uppercase tracking-wider">Saat Ini</span>
                                </div>
                            @else
                                <div class="flex flex-col items-center text-center p-2">
                                    <svg class="w-8 h-8 text-slate-300 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        {{-- Upload Area --}}
                        <div class="flex-1 min-w-0 flex flex-col justify-center">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Unggah Logo Baru</label>
                            <input type="file" name="logo" accept="image/png, image/jpeg, image/svg+xml"
                                class="block w-full text-sm text-slate-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:bg-[#024CD4] file:text-white file:text-sm file:font-semibold hover:file:bg-blue-700 file:cursor-pointer file:transition file:shadow-sm">
                            <p class="mt-3 text-xs text-slate-500 leading-relaxed flex items-start gap-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Format yang didukung: <strong class="text-slate-700">JPG, PNG, atau SVG</strong>. Ukuran maksimal <strong class="text-slate-700">2MB</strong>. Disarankan rasio 1:1 (persegi) dengan resolusi minimal 500x500px agar tampil optimal dan tidak pecah.</span>
                            </p>
                            @error('logo') 
                                <p class="mt-2 text-xs text-red-600 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Submit Actions --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 p-5 bg-white border border-slate-200/80 rounded-2xl shadow-sm">
                <p class="text-xs text-slate-500 flex items-start gap-2">
                    <svg class="w-4 h-4 text-[#024CD4] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Perubahan akan langsung diterapkan pada profil perusahaan Anda di halaman publik dan daftar lowongan.
                </p>
                <div class="flex items-center gap-3">
                    <a href="{{ route('mitra.dashboard') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 rounded-xl transition">Batal</a>
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white bg-[#024CD4] hover:bg-blue-700 rounded-xl shadow-lg shadow-blue-600/20 transition-all duration-200 hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>

        {{-- Right Column: Sidebar --}}
        <div class="lg:col-span-1">
            <div class="lg:sticky lg:top-6 space-y-5">
                
                {{-- Tips Card --}}
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 rounded-2xl p-5">
                    <div class="flex gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white text-[#024CD4] flex items-center justify-center shrink-0 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-bold text-slate-900 mb-2">Tips Profil Menarik</p>
                            <ul class="text-xs text-slate-600 leading-relaxed space-y-2">
                                <li class="flex items-start gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#024CD4] mt-1.5 shrink-0"></span>
                                    Gunakan nama perusahaan yang resmi sesuai akta.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#024CD4] mt-1.5 shrink-0"></span>
                                    Isi deskripsi dengan budaya kerja dan benefit yang ditawarkan.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#024CD4] mt-1.5 shrink-0"></span>
                                    Pastikan logo beresolusi tinggi dan tidak pecah.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#024CD4] mt-1.5 shrink-0"></span>
                                    Alamat yang jelas meningkatkan kepercayaan pelamar.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Live Preview Card --}}
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="px-5 py-3 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <p class="text-xs font-bold text-slate-700 uppercase tracking-wider">Preview Tampilan</p>
                        <span class="text-[10px] font-semibold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">Publik</span>
                    </div>
                    <div class="p-5">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="w-16 h-16 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-center overflow-hidden shrink-0">
                                @if ($mitra->logo)
                                    <img src="{{ Storage::url($mitra->logo) }}" class="w-full h-full object-cover" alt="Logo">
                                @else
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="text-base font-bold text-slate-900 truncate">{{ $mitra->nama_perusahaan ?: 'Nama Perusahaan' }}</h3>
                                @if ($mitra->website)
                                    <p class="text-xs text-[#024CD4] truncate mt-0.5">{{ $mitra->website }}</p>
                                @else
                                    <p class="text-xs text-slate-400 mt-0.5">www.website.com</p>
                                @endif
                            </div>
                        </div>
                        
                        @if ($mitra->alamat)
                            <div class="flex items-start gap-2 mb-3">
                                <svg class="w-3.5 h-3.5 text-slate-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <p class="text-xs text-slate-600 leading-relaxed">{{ $mitra->alamat }}</p>
                            </div>
                        @endif

                        <div class="pt-3 border-t border-slate-100">
                            <p class="text-xs text-slate-600 leading-relaxed line-clamp-4">
                                {{ $mitra->deskripsi ?: 'Deskripsi perusahaan Anda akan muncul di sini. Jelaskan secara singkat tentang bidang usaha, budaya kerja, dan mengapa pelamar harus bergabung dengan Anda.' }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </form>

</x-layouts.mitra>