<div class="admin-form-grid">
    <div class="admin-form-grid-2">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Perusahaan</label>
            <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $mitra->nama_perusahaan ?? '') }}" required
                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
            @error('nama_perusahaan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $mitra->email ?? '') }}" required
                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Password {{ isset($mitra) ? '(kosongkan jika tidak diubah)' : '' }}
            </label>
            <input type="password" name="password"
                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
            @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
            <input type="url" name="website" value="{{ old('website', $mitra->website ?? '') }}" placeholder="https://"
                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
            @error('website') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
        <textarea name="alamat" rows="2" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('alamat', $mitra->alamat ?? '') }}</textarea>
        @error('alamat') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Perusahaan</label>
        <textarea name="deskripsi" rows="3" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('deskripsi', $mitra->deskripsi ?? '') }}</textarea>
        @error('deskripsi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Logo Perusahaan</label>
        <div class="flex flex-col sm:flex-row gap-4 sm:items-center">
            @if (!empty($mitra->logo))
                <img src="{{ Storage::url($mitra->logo) }}" class="w-16 h-16 rounded-lg object-cover shrink-0">
            @endif
            <div class="flex-1">
                <input type="file" name="logo" accept="image/*"
                    class="w-full text-sm text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 file:text-sm">
                @error('logo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    <div class="flex items-center gap-3">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition">Simpan</button>
        <a href="{{ route('admin.mitra.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
    </div>
</div>
