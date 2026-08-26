<x-layouts.admin title="Pengaturan Beranda">

    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Pengaturan Beranda</h1>
        <p class="text-sm text-gray-500">Atur teks utama, tombol, dan identitas singkat yang tampil di halaman utama web.</p>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <form method="POST" action="{{ route('admin.pengaturan-beranda.update') }}">
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
        </div>
    </div>

</x-layouts.admin>
