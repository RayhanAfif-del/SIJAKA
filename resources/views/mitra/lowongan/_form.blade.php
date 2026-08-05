<div class="grid sm:grid-cols-2 gap-5 mb-5">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Posisi</label>
        <input type="text" name="posisi" value="{{ old('posisi', $lowongan->posisi ?? '') }}" required
            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
        @error('posisi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
        <input type="text" name="lokasi" value="{{ old('lokasi', $lowongan->lokasi ?? '') }}" required placeholder="Kota, Provinsi"
            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
        @error('lokasi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="grid sm:grid-cols-3 gap-5 mb-5">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Pekerjaan</label>
        <select name="jenis_pekerjaan" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
            @foreach (['Full Time', 'Part Time', 'Magang', 'Kontrak'] as $jenis)
                <option value="{{ $jenis }}" @selected(old('jenis_pekerjaan', $lowongan->jenis_pekerjaan ?? '') === $jenis)>{{ $jenis }}</option>
            @endforeach
        </select>
        @error('jenis_pekerjaan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Gaji (opsional)</label>
        <input type="text" name="gaji" value="{{ old('gaji', $lowongan->gaji ?? '') }}" placeholder="Rp 3.000.000 - 4.000.000"
            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
        @error('gaji') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Batas Melamar</label>
        <input type="date" name="deadline" value="{{ old('deadline', isset($lowongan) ? $lowongan->deadline->format('Y-m-d') : '') }}" required
            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
        @error('deadline') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mb-5">
    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Pekerjaan</label>
    <textarea name="deskripsi" rows="4" required
        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('deskripsi', $lowongan->deskripsi ?? '') }}</textarea>
    @error('deskripsi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mb-5">
    <label class="block text-sm font-medium text-gray-700 mb-1">Persyaratan</label>
    <p class="text-xs text-gray-400 mb-1">Tulis setiap poin persyaratan pada baris baru.</p>
    <textarea name="persyaratan" rows="4" required
        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('persyaratan', $lowongan->persyaratan ?? '') }}</textarea>
    @error('persyaratan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-1">Cara Melamar</label>
    <textarea name="cara_melamar" rows="3" required placeholder="Email, link, atau langkah melamar"
        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('cara_melamar', $lowongan->cara_melamar ?? '') }}</textarea>
    @error('cara_melamar') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

@if (isset($lowongan))
    <div class="mb-6 px-4 py-3 rounded-lg bg-amber-50 text-amber-700 text-xs border border-amber-100">
        Perubahan data akan mengembalikan status lowongan ke "Menunggu" untuk direview ulang oleh admin.
    </div>
@endif

<div class="flex items-center gap-3">
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition">Simpan</button>
    <a href="{{ route('mitra.lowongan.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
</div>
