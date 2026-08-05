<x-layouts.admin title="Edit Lowongan">

    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Edit Lowongan</h1>
        <p class="text-sm text-gray-500">{{ $lowongan->mitra->nama_perusahaan }} &middot; Admin hanya dapat mengubah posisi, lokasi, dan status unggulan.</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 max-w-xl">
        <form method="POST" action="{{ route('admin.lowongan.update', $lowongan) }}">
            @csrf @method('PUT')

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">Posisi</label>
                <input type="text" name="posisi" value="{{ old('posisi', $lowongan->posisi) }}" required
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                @error('posisi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $lowongan->lokasi) }}" required
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                @error('lokasi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6 flex items-center gap-2">
                <input type="hidden" name="unggulan" value="0">
                <input type="checkbox" id="unggulan" name="unggulan" value="1" @checked(old('unggulan', $lowongan->unggulan))
                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <label for="unggulan" class="text-sm text-gray-700">Tampilkan sebagai lowongan unggulan di beranda</label>
            </div>

            <div class="mb-6 bg-gray-50 rounded-lg p-4 text-xs text-gray-500 space-y-1">
                <p><span class="font-medium text-gray-600">Jenis Pekerjaan:</span> {{ $lowongan->jenis_pekerjaan }}</p>
                <p><span class="font-medium text-gray-600">Deadline:</span> {{ $lowongan->deadline->translatedFormat('d F Y') }}</p>
                <p><span class="font-medium text-gray-600">Status:</span> {{ ucfirst($lowongan->status) }}</p>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition">Simpan</button>
                <a href="{{ route('admin.lowongan.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
            </div>
        </form>
    </div>

</x-layouts.admin>
