<div class="mb-5">
    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
    <input type="text" name="nama" value="{{ old('nama', $strukturOrganisasi->nama ?? '') }}" required
        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
    @error('nama') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mb-5">
    <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
    <input type="text" name="jabatan" value="{{ old('jabatan', $strukturOrganisasi->jabatan ?? '') }}" required
        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
    @error('jabatan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mb-5">
    <label class="block text-sm font-medium text-gray-700 mb-1">Urutan Tampil</label>
    <input type="number" name="urutan" value="{{ old('urutan', $strukturOrganisasi->urutan ?? 0) }}" min="0" required
        class="w-full sm:w-40 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
    @error('urutan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
    @if (!empty($strukturOrganisasi->foto))
        <img src="{{ Storage::url($strukturOrganisasi->foto) }}" class="w-16 h-16 rounded-full object-cover mb-2">
    @endif
    <input type="file" name="foto" accept="image/*"
        class="w-full text-sm text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 file:text-sm">
    @error('foto') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div class="flex items-center gap-3">
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition">Simpan</button>
    <a href="{{ route('admin.struktur-organisasi.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
</div>
