<x-layouts.admin title="Pengaturan Beranda">

    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Pengaturan Beranda</h1>
        <p class="text-sm text-gray-500">Atur teks utama, tombol, dan identitas singkat yang tampil di halaman utama web.</p>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <form method="POST" action="{{ route('admin.pengaturan-beranda.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid sm:grid-cols-2 gap-5">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Website</label>
                        <input type="text" name="site_name" value="{{ old('site_name', $pengaturanWebsite->site_name) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                        @error('site_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tagline</label>
                        <input type="text" name="site_tagline" value="{{ old('site_tagline', $pengaturanWebsite->site_tagline) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                        @error('site_tagline') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Icon SIJAKA / Favicon</label>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                            <div class="w-16 h-16 rounded-2xl border border-gray-200 bg-gray-50 flex items-center justify-center overflow-hidden shrink-0">
                                @if ($pengaturanWebsite->site_icon)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($pengaturanWebsite->site_icon) }}" alt="Icon SIJAKA" class="w-full h-full object-cover">
                                @else
                                    <span class="text-sm font-semibold text-gray-400">SI</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <input type="file" name="site_icon" accept="image/*" class="w-full text-sm text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 file:text-sm">
                                <p class="mt-2 text-xs text-gray-400">Upload gambar persegi agar tampil bagus sebagai ikon situs. Kosongkan jika tidak ingin mengganti.</p>
                                @error('site_icon') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto Beranda Utama</label>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                            <div class="w-full sm:w-56 h-40 rounded-2xl border border-gray-200 bg-gray-50 overflow-hidden flex items-center justify-center shrink-0">
                                @if ($pengaturanWebsite->hero_image)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($pengaturanWebsite->hero_image) }}" alt="Foto Beranda Utama" class="w-full h-full object-cover">
                                @else
                                    <span class="text-sm font-semibold text-gray-400">Belum ada foto</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <input type="file" name="hero_image" accept="image/*" class="w-full text-sm text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 file:text-sm">
                                <p class="mt-2 text-xs text-gray-400">Upload foto hero yang tampil di halaman utama. Jika kosong, sistem akan memakai ilustrasi dummy bawaan.</p>
                                @error('hero_image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Badge Hero</label>
                        <input type="text" name="hero_badge" value="{{ old('hero_badge', $pengaturanWebsite->hero_badge) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                        @error('hero_badge') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2 grid sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Hero 1</label>
                            <input type="text" name="hero_title_prefix" value="{{ old('hero_title_prefix', $pengaturanWebsite->hero_title_prefix) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                            @error('hero_title_prefix') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Hero 2</label>
                            <input type="text" name="hero_title_highlight" value="{{ old('hero_title_highlight', $pengaturanWebsite->hero_title_highlight) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                            @error('hero_title_highlight') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Hero 3</label>
                            <input type="text" name="hero_title_suffix" value="{{ old('hero_title_suffix', $pengaturanWebsite->hero_title_suffix) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                            @error('hero_title_suffix') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Hero</label>
                        <textarea name="hero_description" rows="4" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('hero_description', $pengaturanWebsite->hero_description) }}</textarea>
                        @error('hero_description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tombol Utama</label>
                        <input type="text" name="hero_primary_label" value="{{ old('hero_primary_label', $pengaturanWebsite->hero_primary_label) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm mb-3">
                        <input type="text" name="hero_primary_url" value="{{ old('hero_primary_url', $pengaturanWebsite->hero_primary_url) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                        @error('hero_primary_label') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        @error('hero_primary_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tombol Sekunder</label>
                        <input type="text" name="hero_secondary_label" value="{{ old('hero_secondary_label', $pengaturanWebsite->hero_secondary_label) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm mb-3">
                        <input type="text" name="hero_secondary_url" value="{{ old('hero_secondary_url', $pengaturanWebsite->hero_secondary_url) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                        @error('hero_secondary_label') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        @error('hero_secondary_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Teks Footer</label>
                        <textarea name="footer_text" rows="3" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('footer_text', $pengaturanWebsite->footer_text) }}</textarea>
                        @error('footer_text') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition">Simpan Perubahan</button>
                    <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">Kembali ke dashboard</a>
                </div>
            </form>
        </div>

        <div class="bg-blue-950 text-white rounded-xl p-6 shadow-sm">
            <p class="text-sm text-blue-200 uppercase tracking-wide mb-2">Preview</p>
            <div class="w-16 h-16 rounded-2xl bg-white/10 border border-white/10 overflow-hidden flex items-center justify-center mb-4">
                @if ($pengaturanWebsite->site_icon)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($pengaturanWebsite->site_icon) }}" alt="Icon SIJAKA" class="w-full h-full object-cover">
                @else
                    <span class="text-lg font-semibold text-white">SI</span>
                @endif
            </div>
            <h2 class="text-2xl font-bold leading-tight mb-3">
                {{ $pengaturanWebsite->hero_title_prefix }}
                <span class="text-amber-300">{{ $pengaturanWebsite->hero_title_highlight }}</span>
                {{ $pengaturanWebsite->hero_title_suffix }}
            </h2>
            <p class="text-sm text-blue-100 leading-relaxed mb-5">{{ $pengaturanWebsite->hero_description }}</p>
            <div class="flex flex-wrap gap-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 text-xs">{{ $pengaturanWebsite->hero_badge }}</span>
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 text-xs">{{ $pengaturanWebsite->site_name }}</span>
            </div>
            <div class="mt-5 rounded-2xl overflow-hidden bg-white/10 border border-white/10 h-44 flex items-center justify-center">
                @if ($pengaturanWebsite->hero_image)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($pengaturanWebsite->hero_image) }}" alt="Preview Foto Beranda" class="w-full h-full object-cover">
                @else
                    <span class="text-sm text-blue-100/80">Preview foto beranda</span>
                @endif
            </div>
        </div>
    </div>

</x-layouts.admin>
