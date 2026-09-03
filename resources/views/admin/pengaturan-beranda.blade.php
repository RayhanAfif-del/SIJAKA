<x-layouts.admin title="Pengaturan Beranda">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-slate-700 transition">Dashboard</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-slate-700 font-medium">Pengaturan</span>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-slate-700 font-medium">Beranda</span>
            </div>
            <h1 class="text-2xl font-semibold text-slate-900 tracking-tight">Pengaturan Beranda</h1>
            <p class="text-sm text-slate-500 mt-1">Atur teks utama, tombol, dan identitas singkat yang tampil di halaman utama web.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('admin.pengaturan-beranda.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid lg:grid-cols-3 gap-5 max-w-7xl">

            {{-- Form Panel --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Section 1: Identitas Website --}}
                <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-semibold text-slate-900">Identitas Website</h2>
                                <p class="text-xs text-slate-500 mt-0.5">Informasi dasar yang muncul di tab browser & header</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 sm:p-6 space-y-5">
                        {{-- Site Name --}}
                        <div>
                            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                                </svg>
                                Nama Website
                            </label>
                            <input type="text" name="site_name" value="{{ old('site_name', $pengaturanWebsite->site_name) }}" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition">
                            @error('site_name') <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
                        </div>

                        {{-- Tagline --}}
                        <div>
                            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-4 4z"/>
                                </svg>
                                Tagline
                            </label>
                            <input type="text" name="site_tagline" value="{{ old('site_tagline', $pengaturanWebsite->site_tagline) }}" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition" placeholder="Slogan singkat website Anda">
                            @error('site_tagline') <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
                        </div>

                        {{-- Favicon --}}
                        <div>
                            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Icon SIJAKA / Favicon
                            </label>
                            <div class="flex flex-col sm:flex-row sm:items-start gap-4 p-4 rounded-lg border border-dashed border-slate-200 bg-slate-50/50">
                                <div class="w-16 h-16 rounded-full border border-slate-200 bg-white flex items-center justify-center overflow-hidden shrink-0 shadow-sm">
                                    @if ($pengaturanWebsite->site_icon)
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($pengaturanWebsite->site_icon) }}" alt="Icon SIJAKA" class="w-full h-full rounded-full object-cover">
                                    @else
                                        <span class="text-sm font-bold text-slate-400">SI</span>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <input type="file" name="site_icon" accept=".png,.jpg,.jpeg,.ico,.webp,.svg,image/png,image/jpeg,image/x-icon,image/webp,image/svg+xml" class="block w-full text-sm text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 file:text-sm file:font-medium hover:file:bg-blue-100 file:cursor-pointer file:transition">
                                    <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                                        <span class="font-medium text-slate-700">Rekomendasi:</span> Gambar persegi (512×512px) format PNG/SVG. Kosongkan jika tidak ingin mengganti.
                                    </p>
                                </div>
                            </div>
                            @error('site_icon') <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Section 2: Hero Section --}}
                <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-semibold text-slate-900">Hero Section</h2>
                                <p class="text-xs text-slate-500 mt-0.5">Bagian utama yang pertama kali dilihat pengunjung</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 sm:p-6 space-y-5">
                        {{-- Hero Image --}}
                        <div>
                            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Foto Beranda Utama
                            </label>
                            <div class="flex flex-col sm:flex-row sm:items-start gap-4 p-4 rounded-lg border border-dashed border-slate-200 bg-slate-50/50">
                                <div class="w-full sm:w-64 h-40 rounded-xl border border-slate-200 bg-white overflow-hidden flex items-center justify-center shrink-0 shadow-sm">
                                    @if ($pengaturanWebsite->hero_image)
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($pengaturanWebsite->hero_image) }}" alt="Foto Beranda Utama" class="w-full h-full object-cover">
                                    @else
                                        <div class="flex flex-col items-center text-center p-4">
                                            <svg class="w-8 h-8 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="text-xs font-medium text-slate-400">Belum ada foto</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <input type="file" name="hero_image" accept="image/*" class="block w-full text-sm text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 file:text-sm file:font-medium hover:file:bg-blue-100 file:cursor-pointer file:transition">
                                    <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                                        <span class="font-medium text-slate-700">Rekomendasi:</span> Rasio 16:9 (1920×1080px). Jika kosong, sistem akan memakai ilustrasi dummy bawaan.
                                    </p>
                                </div>
                            </div>
                            @error('hero_image') <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
                        </div>

                        {{-- Badge --}}
                        <div class="max-w-sm">
                            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                Badge Hero
                                <span class="text-xs font-normal text-slate-400 ml-1">(opsional)</span>
                            </label>
                            <input type="text" name="hero_badge" value="{{ old('hero_badge', $pengaturanWebsite->hero_badge) }}" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition" placeholder="✨ Baru Diluncurkan">
                            @error('hero_badge') <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
                        </div>

                        {{-- Hero Title (3 parts) --}}
                        <div>
                            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/>
                                </svg>
                                Judul Hero
                                <span class="text-xs font-normal text-slate-400 ml-1">(3 bagian)</span>
                            </label>
                            <div class="grid sm:grid-cols-3 gap-3">
                                <div>
                                    <span class="text-[11px] font-medium text-slate-500 uppercase tracking-wider mb-1 block">Bagian 1</span>
                                    <input type="text" name="hero_title_prefix" value="{{ old('hero_title_prefix', $pengaturanWebsite->hero_title_prefix) }}" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition" placeholder="Membangun">
                                </div>
                                <div>
                                    <span class="text-[11px] font-medium text-amber-600 uppercase tracking-wider mb-1 block">Bagian 2 (Highlight)</span>
                                    <input type="text" name="hero_title_highlight" value="{{ old('hero_title_highlight', $pengaturanWebsite->hero_title_highlight) }}" class="w-full rounded-lg border-amber-200 bg-amber-50/30 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 text-sm transition" placeholder="Masa Depan">
                                </div>
                                <div>
                                    <span class="text-[11px] font-medium text-slate-500 uppercase tracking-wider mb-1 block">Bagian 3</span>
                                    <input type="text" name="hero_title_suffix" value="{{ old('hero_title_suffix', $pengaturanWebsite->hero_title_suffix) }}" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition" placeholder="Digital">
                                </div>
                            </div>
                            <p class="mt-2 text-xs text-slate-500">Bagian 2 akan ditampilkan dengan warna aksen untuk penekanan.</p>
                            @error('hero_title_prefix') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                            @error('hero_title_highlight') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                            @error('hero_title_suffix') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- Hero Description --}}
                        <div>
                            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Deskripsi Hero
                            </label>
                            <textarea name="hero_description" rows="4" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition resize-none" placeholder="Deskripsi singkat tentang website Anda...">{{ old('hero_description', $pengaturanWebsite->hero_description) }}</textarea>
                            @error('hero_description') <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div class="p-4 rounded-lg border border-slate-200 bg-slate-50/30">
                                <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-2.5">
                                    <span class="w-5 h-5 rounded bg-blue-600 text-white flex items-center justify-center text-[10px] font-bold">1</span>
                                    Tombol Utama
                                </label>
                                <input type="text" name="hero_primary_label" value="{{ old('hero_primary_label', $pengaturanWebsite->hero_primary_label) }}" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition mb-2" placeholder="Label tombol">
                                <input type="text" name="hero_primary_url" value="{{ old('hero_primary_url', $pengaturanWebsite->hero_primary_url) }}" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition font-mono text-xs" placeholder="/lowongan">
                                @error('hero_primary_label') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                                @error('hero_primary_url') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="p-4 rounded-lg border border-slate-200 bg-slate-50/30">
                                <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-2.5">
                                    <span class="w-5 h-5 rounded bg-slate-200 text-slate-700 flex items-center justify-center text-[10px] font-bold">2</span>
                                    Tombol Sekunder
                                </label>
                                <input type="text" name="hero_secondary_label" value="{{ old('hero_secondary_label', $pengaturanWebsite->hero_secondary_label) }}" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition mb-2" placeholder="Label tombol">
                                <input type="text" name="hero_secondary_url" value="{{ old('hero_secondary_url', $pengaturanWebsite->hero_secondary_url) }}" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition font-mono text-xs" placeholder="/tentang">
                                @error('hero_secondary_label') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                                @error('hero_secondary_url') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section 3: Footer --}}
                <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 13H5v-2h14v2z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-semibold text-slate-900">Footer</h2>
                                <p class="text-xs text-slate-500 mt-0.5">Teks yang tampil di bagian bawah halaman</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 sm:p-6">
                        <textarea name="footer_text" rows="3" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition resize-none" placeholder="© 2026 SIJAKA. All rights reserved.">{{ old('footer_text', $pengaturanWebsite->footer_text) }}</textarea>
                        @error('footer_text') <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-5 bg-white border border-slate-200/70 rounded-xl shadow-sm">
                    <p class="text-xs text-slate-500">
                        <svg class="w-3.5 h-3.5 inline text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Perubahan akan langsung diterapkan ke halaman beranda.
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

            {{-- Preview Panel (Sticky) --}}
            <div class="lg:col-span-1">
                <div class="lg:sticky lg:top-5 space-y-4">
                    <div class="flex items-center gap-2 mb-1">
                        <div class="w-6 h-6 rounded-md bg-violet-100 text-violet-600 flex items-center justify-center">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-900">Live Preview</h3>
                    </div>

                    {{-- Browser Mockup --}}
                    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                        {{-- Browser Bar --}}
                        <div class="flex items-center gap-2 px-3 py-2 bg-slate-50 border-b border-slate-200">
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-red-400"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                            </div>
                            <div class="flex-1 flex items-center gap-1.5 px-2.5 py-1 bg-white rounded-md border border-slate-200 text-[10px] text-slate-400 font-mono truncate">
                                <svg class="w-2.5 h-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                sijaka.app
                            </div>
                        </div>

                        {{-- Preview Content --}}
                        <div class="bg-gradient-to-br from-blue-950 via-blue-900 to-slate-900 text-white p-5">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-8 h-8 rounded-lg bg-white/10 border border-white/10 overflow-hidden flex items-center justify-center shrink-0">
                                    @if ($pengaturanWebsite->site_icon)
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($pengaturanWebsite->site_icon) }}" alt="Icon" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-xs font-bold text-white">SI</span>
                                    @endif
                                </div>
                                <span class="text-xs font-medium text-white/80">{{ $pengaturanWebsite->site_name ?: 'Nama Website' }}</span>
                            </div>

                            @if ($pengaturanWebsite->hero_badge)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-white/10 backdrop-blur border border-white/10 text-[10px] font-medium text-white/90 mb-3">
                                    {{ $pengaturanWebsite->hero_badge }}
                                </span>
                            @endif

                            <h2 class="text-lg font-bold leading-tight mb-2">
                                {{ $pengaturanWebsite->hero_title_prefix ?: 'Judul' }}
                                <span class="text-amber-300">{{ $pengaturanWebsite->hero_title_highlight ?: 'Highlight' }}</span>
                                {{ $pengaturanWebsite->hero_title_suffix ?: 'Suffix' }}
                            </h2>
                            <p class="text-[11px] text-blue-100/80 leading-relaxed mb-4 line-clamp-3">
                                {{ $pengaturanWebsite->hero_description ?: 'Deskripsi hero akan muncul di sini...' }}
                            </p>

                            <div class="flex flex-wrap gap-1.5 mb-4">
                                @if ($pengaturanWebsite->hero_primary_label)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-white text-blue-950 text-[10px] font-semibold">{{ $pengaturanWebsite->hero_primary_label }}</span>
                                @endif
                                @if ($pengaturanWebsite->hero_secondary_label)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-white/10 border border-white/20 text-white text-[10px] font-medium">{{ $pengaturanWebsite->hero_secondary_label }}</span>
                                @endif
                            </div>

                            <div class="rounded-lg overflow-hidden bg-white/5 border border-white/10 aspect-video flex items-center justify-center">
                                @if ($pengaturanWebsite->hero_image)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($pengaturanWebsite->hero_image) }}" alt="Preview" class="w-full h-full object-cover">
                                @else
                                    <div class="text-center p-3">
                                        <svg class="w-6 h-6 text-white/30 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="text-[10px] text-white/40">Preview foto hero</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Footer Preview --}}
                        <div class="px-4 py-3 bg-slate-900 border-t border-white/5">
                            <p class="text-[10px] text-white/50 text-center truncate">
                                {{ $pengaturanWebsite->footer_text ?: 'Teks footer akan muncul di sini...' }}
                            </p>
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
                                <p class="text-xs font-semibold text-blue-900 mb-1">Tips</p>
                                <p class="text-xs text-blue-700/80 leading-relaxed">
                                    Gunakan judul yang singkat & menarik (maks 8-10 kata per bagian). Foto hero sebaiknya rasio 16:9 dengan subjek di tengah.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</x-layouts.admin>