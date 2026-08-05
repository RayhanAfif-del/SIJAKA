<div class="mb-5">
    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
    <input type="text" name="nama" value="{{ old('nama', $alumni->nama ?? '') }}" required
        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
    @error('nama') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mb-5">
    <label class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
    <input type="text" name="jurusan" value="{{ old('jurusan', $alumni->jurusan ?? '') }}" required
        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
    @error('jurusan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mb-5">
    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Lulus</label>
    <input type="text" name="tahun_lulus" value="{{ old('tahun_lulus', $alumni->tahun_lulus ?? '') }}" required maxlength="4" placeholder="2024"
        class="w-full sm:w-40 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
    @error('tahun_lulus') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
    <select name="status" required class="w-full sm:w-56 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
@foreach (['Bekerja', 'Melanjutkan Studi', 'Belum Bekerja'] as $status)
            <option value="{{ $status }}" @selected(old('status', $alumni->status ?? '') === $status)>{{ $status }}</option>
        @endforeach
    </select>
    @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div class="flex items-center gap-3">
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition">Simpan</button>
    <a href="{{ route('admin.alumni.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
</div>
