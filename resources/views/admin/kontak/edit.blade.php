<x-layouts.admin title="Kontak">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-slate-700 transition">Dashboard</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-slate-700 font-medium">Kontak</span>
            </div>
            <h1 class="text-2xl font-semibold text-slate-900 tracking-tight">Informasi Kontak</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola alamat, nomor telepon, email, dan media sosial yang tampil di halaman publik.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('admin.kontak.update') }}" class="grid lg:grid-cols-3 gap-6">
        @csrf
        @method('PUT')

        {{-- Left Column: Forms --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Section 1: Informasi Utama --}}
            <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Informasi Utama</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Data kontak dasar untuk komunikasi pengunjung</p>
                        </div>
                    </div>
                </div>

                <div class="p-5 sm:p-6 space-y-5">
                    {{-- Alamat --}}
                    <div>
                        <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Alamat Lengkap
                            <span class="text-xs font-normal text-red-500 ml-1">*</span>
                        </label>
                        <textarea name="alamat" rows="3" required
                            class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition resize-none"
                            placeholder="Jl. Contoh No. 123, Kecamatan, Kabupaten, Provinsi">{{ old('alamat', $kontak->alamat) }}</textarea>
                        @error('alamat') 
                            <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 11-2 0 1 1 0 012 0" clip-rule="evenodd"/></svg>
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
                        <input type="email" name="email" value="{{ old('email', $kontak->email) }}" required
                            class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                            placeholder="admin@smkn1bangsri.sch.id">
                        @error('email') 
                            <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p> 
                        @enderror
                    </div>

                    {{-- Telepon --}}
                    <div>
                        <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            Telepon / WhatsApp
                        </label>
                        <input type="text" name="telepon" value="{{ old('telepon', $kontak->telepon) }}"
                            class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                            placeholder="+62 812-3456-7890">
                        @error('telepon') 
                            <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p> 
                        @enderror
                    </div>

                    {{-- Jam Operasional --}}
                    <div>
                        <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Jam Operasional
                        </label>
                        <input type="text" name="jam_operasional" value="{{ old('jam_operasional', $kontak->jam_operasional) }}"
                            class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                            placeholder="Senin - Jumat (08.00 - 16.00 WIB)">
                        @error('jam_operasional') 
                            <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p> 
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Section 2: Lokasi & Peta --}}
            <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Lokasi Google Maps</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Untuk menampilkan peta interaktif di halaman kontak</p>
                        </div>
                    </div>
                </div>

                <div class="p-5 sm:p-6">
                    <div>
                        <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                            Link / Embed Google Maps
                        </label>
                        <textarea name="map_link" rows="3" maxlength="1000"
                            class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition resize-none font-mono text-xs"
                            placeholder="https://www.google.com/maps/embed?pb=... atau FQC2+X9 Bangsri, Kabupaten Jepara">{{ old('map_link', $kontak->map_link) }}</textarea>
                        
                        <div class="mt-3 flex items-start gap-2.5 p-3 rounded-lg bg-blue-50 border border-blue-100">
                            <svg class="w-4 h-4 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-xs text-blue-800 leading-relaxed">
                                <span class="font-semibold">Cara mengisi:</span> Buka Google Maps → Cari lokasi Anda → Klik "Bagikan" → Pilih "Sematkan peta" → Salin kode HTML atau URL-nya. Bisa juga hanya diisi dengan Plus Code (contoh: <code class="bg-blue-100 px-1 rounded">FQC2+X9 Bangsri</code>).
                            </p>
                        </div>
                        @error('map_link') 
                            <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p> 
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Section 3: Media Sosial --}}
            <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Media Sosial</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Tautan ke akun resmi BKK (opsional)</p>
                        </div>
                    </div>
                </div>

                <div class="p-5 sm:p-6 space-y-5">
                    {{-- Instagram --}}
                    <div>
                        <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                            <span class="w-5 h-5 rounded bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-500 flex items-center justify-center text-white">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </span>
                            Instagram
                        </label>
                        <input type="url" name="instagram" value="{{ old('instagram', $kontak->instagram) }}"
                            class="w-full rounded-lg border-slate-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 text-sm transition"
                            placeholder="https://instagram.com/username">
                        @error('instagram') 
                            <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p> 
                        @enderror
                    </div>

                    {{-- TikTok --}}
                    <div>
                        <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                            <span class="w-5 h-5 rounded bg-slate-950 flex items-center justify-center text-white">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M16.6 5.82c-.4-.44-.7-.96-.86-1.53a4.5 4.5 0 01-.11-.79h-3.24v12.67a2.65 2.65 0 01-2.65 2.63 2.65 2.65 0 01-2.65-2.63c0-1.46 1.19-2.64 2.65-2.64.28 0 .55.04.8.12v-3.3a5.91 5.91 0 00-.8-.06A5.89 5.89 0 003.86 16.2 5.89 5.89 0 009.74 22a5.89 5.89 0 005.89-5.81V9.77a7.7 7.7 0 004.5 1.44V7.97a4.53 4.53 0 01-3.53-2.15z"/></svg>
                            </span>
                            TikTok
                        </label>
                        <input type="url" name="tiktok" value="{{ old('tiktok', $kontak->tiktok) }}"
                            class="w-full rounded-lg border-slate-200 focus:border-slate-700 focus:ring-2 focus:ring-slate-700/20 text-sm transition"
                            placeholder="https://tiktok.com/@username">
                        @error('tiktok') 
                            <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p> 
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-5 bg-white border border-slate-200/70 rounded-xl shadow-sm">
                <p class="text-xs text-slate-500">
                    <svg class="w-3.5 h-3.5 inline text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Perubahan akan langsung diterapkan di halaman kontak publik dan footer website.
                </p>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition">Batal</a>
                    <button type="submit" class="inline-flex items-center gap-1.5 px-5 py-2 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>

        {{-- Right Column: Preview Panel (Sticky) --}}
        <div class="lg:col-span-1">
            <div class="lg:sticky lg:top-5 space-y-4">
                <div class="flex items-center gap-2 mb-1">
                    <div class="w-6 h-6 rounded-md bg-emerald-100 text-emerald-600 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900">Preview Publik</h3>
                </div>

                {{-- Contact Card Mockup --}}
                <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-slate-900 px-5 py-4">
                        <h3 class="text-sm font-semibold text-white">Kontak Kami</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Hubungi tim BKK SIJAKA SMK N 1 Bangsri untuk informasi lebih lanjut seputar layanan karier.</p>
                    </div>
                    
                    <div class="p-5 space-y-4">
                        {{-- Alamat --}}
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-slate-900">Alamat</p>
                                <p class="text-sm text-slate-600 mt-0.5 leading-relaxed">{{ $kontak->alamat ?: 'Alamat belum diisi' }}</p>
                            </div>
                        </div>

                        {{-- Kontak --}}
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-slate-900">Kontak</p>
                                <p class="text-sm text-slate-600 mt-0.5">{{ $kontak->telepon ?: 'Telepon belum diisi' }}</p>
                                <p class="text-sm text-slate-600">{{ $kontak->email ?: 'Email belum diisi' }}</p>
                                @if($kontak->jam_operasional)
                                    <p class="text-xs text-slate-500 mt-1 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ $kontak->jam_operasional }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        {{-- Social Media --}}
                        @if($kontak->instagram || $kontak->tiktok)
                            <div class="pt-4 border-t border-slate-100">
                                <p class="text-xs font-semibold text-slate-900 mb-2">Ikuti Kami</p>
                                <div class="flex items-center gap-2">
                                    @if($kontak->instagram)
                                        <span class="w-8 h-8 rounded-lg bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-500 flex items-center justify-center text-white" title="Instagram">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                        </span>
                                    @endif
                                    @if($kontak->tiktok)
                                        <span class="w-8 h-8 rounded-lg bg-slate-950 flex items-center justify-center text-white" title="TikTok">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385h-3.047v-3.47h3.047v-2.642c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953h-1.513c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385c5.737-.9 10.126-5.864 10.126-11.854z"/></svg>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Map Placeholder --}}
                        @if($kontak->map_link)
                            <div class="pt-4 border-t border-slate-100">
                                <div class="w-full h-32 bg-slate-100 rounded-lg flex items-center justify-center border border-slate-200 border-dashed">
                                    <div class="text-center">
                                        <svg class="w-6 h-6 text-slate-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                        </svg>
                                        <span class="text-[10px] text-slate-500 font-medium">Peta akan ditampilkan di sini</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Info Card --}}
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                    <div class="flex gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold text-blue-900 mb-1">Tips Pengisian</p>
                            <ul class="text-xs text-blue-700/80 leading-relaxed space-y-1">
                                <li>• Gunakan format nomor HP yang jelas (+62)</li>
                                <li>• Link media sosial harus diawali <code class="bg-blue-100 px-1 rounded">https://</code></li>
                                <li>• Pastikan alamat mudah ditemukan di Maps</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</x-layouts.admin>