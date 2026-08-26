<x-layouts.admin title="Kontak">

    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Kontak</h1>
        <p class="text-sm text-gray-500">Kelola informasi kontak yang tampil di halaman publik.</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 max-w-xl">
        <form method="POST" action="{{ route('admin.kontak.update') }}">
            @csrf @method('PUT')

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <textarea name="alamat" rows="2" required
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('alamat', $kontak->alamat) }}</textarea>
                @error('alamat') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $kontak->email) }}" required
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                <input type="text" name="telepon" value="{{ old('telepon', $kontak->telepon) }}" required
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                @error('telepon') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">Jam Operasional</label>
                <input type="text" name="jam_operasional" value="{{ old('jam_operasional', $kontak->jam_operasional) }}" placeholder="Senin-Jumat (08.00-16.00)"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                @error('jam_operasional') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi Google Maps</label>
                <input type="text" name="map_link" value="{{ old('map_link', $kontak->map_link) }}" placeholder="FQC2+X9 Bangsri, Kabupaten Jepara, Jawa Tengah"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                <p class="mt-1 text-xs text-gray-500">Isi dengan alamat, plus code, atau link Google Maps. Ini akan dipakai untuk menampilkan peta langsung di halaman kontak.</p>
                @error('map_link') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid sm:grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                    <input type="url" name="instagram" value="{{ old('instagram', $kontak->instagram) }}" placeholder="https://instagram.com/..."
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @error('instagram') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Facebook</label>
                    <input type="url" name="facebook" value="{{ old('facebook', $kontak->facebook) }}" placeholder="https://facebook.com/..."
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @error('facebook') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">YouTube</label>
                    <input type="url" name="youtube" value="{{ old('youtube', $kontak->youtube) }}" placeholder="https://youtube.com/..."
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @error('youtube') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition">Simpan Perubahan</button>
        </form>
    </div>

</x-layouts.admin>
