<div class="mb-5">
    <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
    <input type="text" name="judul" value="{{ old('judul', $artikel->judul ?? '') }}" required
        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
    @error('judul') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mb-5">
    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
    <input type="text" name="kategori" value="{{ old('kategori', $artikel->kategori ?? '') }}" required placeholder="Tips Karier, Dunia Kerja, Interview, dll"
        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
    @error('kategori') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mb-5">
    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Sampul</label>
    @if (!empty($artikel->gambar))
        <img src="{{ Storage::url($artikel->gambar) }}" class="w-28 h-20 rounded-lg object-cover mb-2">
    @endif
    <input type="file" name="gambar" accept="image/*"
        class="w-full text-sm text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 file:text-sm">
    @error('gambar') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-1">Konten</label>
    <textarea name="konten" rows="8" required
        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('konten', $artikel->konten ?? '') }}</textarea>
    @error('konten') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div class="flex items-center gap-3">
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition">Simpan</button>
    <a href="{{ route('admin.artikel.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
</div>
