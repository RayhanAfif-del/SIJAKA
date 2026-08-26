<div class="space-y-5 max-w-4xl mx-auto">
    
    {{-- Section 1: Informasi Akun --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Informasi Akun</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Data login dan identitas utama perusahaan mitra</p>
                </div>
            </div>
        </div>

        <div class="p-5 sm:p-6 space-y-5">
            <div class="grid sm:grid-cols-2 gap-5">
                {{-- Nama Perusahaan --}}
                <div class="sm:col-span-2">
                    <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Nama Perusahaan
                        <span class="text-xs font-normal text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $mitra->nama_perusahaan ?? '') }}" required
                        class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                        placeholder="Contoh: PT. Teknologi Maju Jaya">
                    @error('nama_perusahaan') 
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Email
                        <span class="text-xs font-normal text-red-500 ml-1">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email', $mitra->email ?? '') }}" required
                        class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                        placeholder="hrd@perusahaan.com">
                    @error('email') 
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Password
                        @if(isset($mitra))
                            <span class="text-xs font-normal text-slate-500 ml-1">(Opsional)</span>
                        @else
                            <span class="text-xs font-normal text-red-500 ml-1">*</span>
                        @endif
                    </label>
                    <input type="password" name="password"
                        class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                        placeholder="{{ isset($mitra) ? 'Kosongkan jika tidak ingin mengubah' : 'Minimal 8 karakter' }}">
                    @if(isset($mitra))
                        <p class="mt-1.5 text-xs text-slate-500">Kosongkan field ini jika Anda tidak ingin mengubah password mitra.</p>
                    @endif
                    @error('password') 
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Section 2: Detail Perusahaan --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Detail Perusahaan</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Informasi tambahan yang akan ditampilkan di profil publik</p>
                </div>
            </div>
        </div>

        <div class="p-5 sm:p-6 space-y-5">
            {{-- Website --}}
            <div>
                <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                    </svg>
                    Website Perusahaan
                </label>
                <input type="url" name="website" value="{{ old('website', $mitra->website ?? '') }}"
                    class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                    placeholder="https://www.perusahaan.com">
                @error('website') 
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p> 
                @enderror
            </div>

            {{-- Alamat --}}
            <div>
                <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Alamat Kantor
                </label>
                <textarea name="alamat" rows="2"
                    class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition resize-none"
                    placeholder="Jl. Contoh No. 123, Kota, Provinsi">{{ old('alamat', $mitra->alamat ?? '') }}</textarea>
                @error('alamat') 
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p> 
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Deskripsi Perusahaan
                </label>
                <textarea name="deskripsi" rows="4"
                    class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition resize-none"
                    placeholder="Ceritakan singkat tentang bidang usaha, visi, atau kegiatan perusahaan...">{{ old('deskripsi', $mitra->deskripsi ?? '') }}</textarea>
                @error('deskripsi') 
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p> 
                @enderror
            </div>
        </div>
    </div>

    {{-- Section 3: Logo Perusahaan --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Logo Perusahaan</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Logo yang akan ditampilkan di daftar lowongan dan profil publik</p>
                </div>
            </div>
        </div>

        <div class="p-5 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:items-start gap-5 p-4 rounded-lg border border-dashed border-slate-200 bg-slate-50/50">
                {{-- Preview Logo --}}
                <div class="w-20 h-20 rounded-xl border border-slate-200 bg-white overflow-hidden flex items-center justify-center shrink-0 shadow-sm">
                    @if (!empty($mitra->logo))
                        <img src="{{ Storage::url($mitra->logo) }}" alt="Logo Perusahaan" class="w-full h-full object-cover">
                    @else
                        <div class="flex flex-col items-center text-center">
                            <svg class="w-8 h-8 text-slate-300 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>
                
                {{-- Upload Area --}}
                <div class="flex-1 min-w-0">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Unggah Logo Baru</label>
                    <input type="file" name="logo" accept="image/*"
                        class="block w-full text-sm text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 file:text-sm file:font-medium hover:file:bg-blue-100 file:cursor-pointer file:transition">
                    <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                        <span class="font-medium text-slate-700">Rekomendasi:</span> Format JPG/PNG/SVG, ukuran maksimal 2MB, rasio 1:1 (persegi) agar tampil optimal.
                    </p>
                    @error('logo') 
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Section 4: Aksi --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-5 bg-white border border-slate-200/70 rounded-xl shadow-sm">
        <p class="text-xs text-slate-500 flex items-start gap-1.5">
            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Pastikan data yang dimasukkan sudah benar sebelum menyimpan perubahan.
        </p>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.mitra.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition">Batal</a>
            <button type="submit" class="inline-flex items-center gap-1.5 px-5 py-2 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </div>

</div>