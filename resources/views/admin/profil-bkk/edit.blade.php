<x-layouts.admin title="Profil BKK">

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
                <span class="text-slate-700 font-medium">Profil BKK</span>
            </div>
            <h1 class="text-2xl font-semibold text-slate-900 tracking-tight">Profil BKK</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola informasi profil, visi, dan misi yang tampil di halaman publik.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('admin.profil-bkk.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid lg:grid-cols-3 gap-5 max-w-7xl">

            {{-- Form Panel --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Section 1: Gambar Profil --}}
                <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-semibold text-slate-900">Gambar Profil</h2>
                                <p class="text-xs text-slate-500 mt-0.5">Foto kegiatan atau gambar profil BKK</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 sm:p-6">
                        <div class="flex flex-col sm:flex-row sm:items-start gap-5 p-4 rounded-lg border border-dashed border-slate-200 bg-slate-50/50">
                            <div class="w-full sm:w-56 h-40 rounded-xl border border-slate-200 bg-white overflow-hidden flex items-center justify-center shrink-0 shadow-sm">
                                @if ($profilBkk->gambar)
                                    <img src="{{ Storage::url($profilBkk->gambar) }}" alt="Gambar Profil BKK" class="w-full h-full object-cover">
                                @else
                                    <div class="flex flex-col items-center text-center p-4">
                                        <svg class="w-8 h-8 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="text-xs font-medium text-slate-400">Belum ada gambar</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <input type="file" name="gambar" accept="image/*" class="block w-full text-sm text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 file:text-sm file:font-medium hover:file:bg-blue-100 file:cursor-pointer file:transition">
                                <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                                    <span class="font-medium text-slate-700">Rekomendasi:</span> Rasio 16:9 atau 4:3 (minimal 800×600px) format JPG/PNG. Kosongkan jika tidak ingin mengubah.
                                </p>
                                @error('gambar') <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section 2: Profil / Tentang Kami --}}
                <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-semibold text-slate-900">Profil / Tentang Kami</h2>
                                <p class="text-xs text-slate-500 mt-0.5">Deskripsi singkat tentang BKK</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 sm:p-6">
                        <div>
                            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Deskripsi Profil
                                <span class="text-xs font-normal text-red-500 ml-1">*</span>
                            </label>
                            <textarea name="profil" rows="5" required
                                class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition resize-none"
                                placeholder="Tuliskan profil lengkap BKK di sini...">{{ old('profil', $profilBkk->profil) }}</textarea>
                            <p class="mt-1.5 text-xs text-slate-500">Ceritakan sejarah, tujuan, dan kegiatan utama BKK.</p>
                            @error('profil') <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Section 3: Visi & Misi --}}
                <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-semibold text-slate-900">Visi & Misi</h2>
                                <p class="text-xs text-slate-500 mt-0.5">Arah dan tujuan jangka panjang BKK</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 sm:p-6 space-y-5">
                        {{-- Visi --}}
                        <div>
                            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Visi
                                <span class="text-xs font-normal text-red-500 ml-1">*</span>
                            </label>
                            <textarea name="visi" rows="3" required
                                class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition resize-none"
                                placeholder="Tuliskan visi BKK di sini...">{{ old('visi', $profilBkk->visi) }}</textarea>
                            <p class="mt-1.5 text-xs text-slate-500">Visi adalah cita-cita jangka panjang yang ingin dicapai.</p>
                            @error('visi') <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
                        </div>

                        {{-- Misi --}}
                        <div>
                            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                                Misi
                                <span class="text-xs font-normal text-red-500 ml-1">*</span>
                            </label>
                            <textarea name="misi" rows="6" required
                                class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition resize-none"
                                placeholder="1. Misi pertama&#10;2. Misi kedua&#10;3. Misi ketiga">{{ old('misi', $profilBkk->misi) }}</textarea>
                            <div class="mt-2 flex items-start gap-2 p-2.5 rounded-lg bg-amber-50 border border-amber-100">
                                <svg class="w-4 h-4 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-xs text-amber-800 leading-relaxed">
                                    <span class="font-semibold">Tips format:</span> Tulis setiap poin misi pada baris baru. Bisa menggunakan nomor (1. 2. 3.) atau bullet (•).
                                </p>
                            </div>
                            @error('misi') <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-5 bg-white border border-slate-200/70 rounded-xl shadow-sm">
                    <p class="text-xs text-slate-500">
                        <svg class="w-3.5 h-3.5 inline text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Perubahan akan langsung diterapkan ke halaman profil publik.
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
                        <h3 class="text-sm font-semibold text-slate-900">Preview Publik</h3>
                    </div>

                    {{-- Preview Card --}}
                    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                        {{-- Hero Image --}}
                        <div class="aspect-video bg-gradient-to-br from-blue-100 to-violet-100 flex items-center justify-center overflow-hidden">
                            @if ($profilBkk->gambar)
                                <img src="{{ Storage::url($profilBkk->gambar) }}" alt="Preview" class="w-full h-full object-cover">
                            @else
                                <div class="text-center p-4">
                                    <svg class="w-10 h-10 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-xs text-slate-400">Preview gambar profil</span>
                                </div>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="p-5 space-y-4">
                            {{-- Profil --}}
                            <div>
                                <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Tentang Kami</h4>
                                <p class="text-sm text-slate-700 leading-relaxed line-clamp-4">
                                    {{ $profilBkk->profil ?: 'Deskripsi profil akan muncul di sini...' }}
                                </p>
                            </div>

                            {{-- Visi --}}
                            <div class="pt-4 border-t border-slate-100">
                                <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Visi
                                </h4>
                                <p class="text-sm text-slate-700 leading-relaxed line-clamp-3">
                                    {{ $profilBkk->visi ?: 'Visi akan muncul di sini...' }}
                                </p>
                            </div>

                            {{-- Misi --}}
                            <div class="pt-4 border-t border-slate-100">
                                <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                    </svg>
                                    Misi
                                </h4>
                                @if ($profilBkk->misi)
                                    <ul class="space-y-1.5">
                                        @foreach (explode("\n", trim($profilBkk->misi)) as $misiItem)
                                            @if (trim($misiItem))
                                                <li class="flex items-start gap-2 text-sm text-slate-700">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>
                                                    <span class="line-clamp-2">{{ preg_replace('/^[\d\.\-\•\s]+/', '', trim($misiItem)) }}</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-sm text-slate-400 italic">Misi akan muncul di sini...</p>
                                @endif
                            </div>
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
                                <p class="text-xs font-semibold text-blue-900 mb-1">Tips Konten</p>
                                <ul class="text-xs text-blue-700/80 leading-relaxed space-y-1">
                                    <li>• Profil: 100-200 kata, jelas & informatif</li>
                                    <li>• Visi: 1-2 kalimat, inspiratif</li>
                                    <li>• Misi: 3-5 poin, actionable</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</x-layouts.admin>