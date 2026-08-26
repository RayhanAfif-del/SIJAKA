<div class="space-y-5 max-w-4xl mx-auto">
    
    {{-- Section 1: Informasi Dasar --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Informasi Dasar</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Data pribadi dan jabatan dalam struktur organisasi</p>
                </div>
            </div>
        </div>

        <div class="p-5 sm:p-6 space-y-5">
            <div class="grid sm:grid-cols-2 gap-5">
                {{-- Nama --}}
                <div class="sm:col-span-2">
                    <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Nama Lengkap
                        <span class="text-xs font-normal text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" name="nama" value="{{ old('nama', $strukturOrganisasi->nama ?? '') }}" required
                        class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                        placeholder="Masukkan nama lengkap">
                    @error('nama') 
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>

                {{-- Jabatan --}}
                <div>
                    <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Jabatan
                        <span class="text-xs font-normal text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" name="jabatan" value="{{ old('jabatan', $strukturOrganisasi->jabatan ?? '') }}" required
                        class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                        placeholder="Contoh: Kepala BKK">
                    @error('jabatan') 
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>

                {{-- Urutan Tampil --}}
                <div>
                    <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                        </svg>
                        Urutan Tampil
                        <span class="text-xs font-normal text-red-500 ml-1">*</span>
                    </label>
                    <input type="number" name="urutan" value="{{ old('urutan', $strukturOrganisasi->urutan ?? 0) }}" min="0" required
                        class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                        placeholder="0">
                    <p class="mt-1.5 text-xs text-slate-500">Angka lebih kecil akan ditampilkan lebih awal.</p>
                    @error('urutan') 
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Section 2: Foto Profil --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Foto Profil</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Foto resmi yang akan ditampilkan di halaman struktur organisasi</p>
                </div>
            </div>
        </div>

        <div class="p-5 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:items-start gap-5 p-4 rounded-lg border border-dashed border-slate-200 bg-slate-50/50">
                {{-- Preview Foto --}}
                <div class="w-24 h-24 rounded-full border-2 border-slate-200 bg-white overflow-hidden flex items-center justify-center shrink-0 shadow-sm">
                    @if (!empty($strukturOrganisasi->foto))
                        <img src="{{ Storage::url($strukturOrganisasi->foto) }}" alt="Foto Profil" class="w-full h-full object-cover">
                    @else
                        <div class="flex flex-col items-center text-center">
                            <svg class="w-8 h-8 text-slate-300 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    @endif
                </div>
                
                {{-- Upload Area --}}
                <div class="flex-1 min-w-0">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Unggah Foto Baru</label>
                    <input type="file" name="foto" accept="image/*"
                        class="block w-full text-sm text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 file:text-sm file:font-medium hover:file:bg-blue-100 file:cursor-pointer file:transition">
                    <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                        <span class="font-medium text-slate-700">Rekomendasi:</span> Format JPG/PNG, ukuran maksimal 2MB, rasio 1:1 (persegi) agar tampil optimal sebagai foto profil.
                    </p>
                    @error('foto') 
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Section 3: Aksi --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-5 bg-white border border-slate-200/70 rounded-xl shadow-sm">
        <p class="text-xs text-slate-500 flex items-start gap-1.5">
            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Pastikan data yang dimasukkan sudah benar sebelum menyimpan perubahan.
        </p>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.struktur-organisasi.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition">Batal</a>
            <button type="submit" class="inline-flex items-center gap-1.5 px-5 py-2 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </div>

</div>