<div class="admin-form-grid">
    <div class="admin-form-grid-2">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Kegiatan</label>
            <input type="text" name="judul" value="{{ old('judul', $galeri->judul ?? '') }}" required
                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
            @error('judul') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
            <input type="text" name="kategori" value="{{ old('kategori', $galeri->kategori ?? '') }}" required placeholder="Kegiatan Sekolah, Kerja Sama & MoU, Pelatihan, dll"
                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
            @error('kategori') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="max-w-xs">
        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
        <input type="date" name="tanggal" value="{{ old('tanggal', isset($galeri) ? $galeri->tanggal->format('Y-m-d') : '') }}" required
            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
        @error('tanggal') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
        <div class="flex flex-col sm:flex-row gap-4 sm:items-center">
            @if (!empty($galeri->foto))
                <img src="{{ Storage::url($galeri->foto) }}" class="w-full sm:w-32 h-24 rounded-lg object-cover shrink-0">
            @endif
            <div class="flex-1">
                <input type="file" name="foto" accept="image/*"
                    class="w-full text-sm text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 file:text-sm">
                @error('foto') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    <div class="flex items-center gap-3">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition">Simpan</button>
        <a href="{{ route('admin.galeri.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
    </div>
</div>
