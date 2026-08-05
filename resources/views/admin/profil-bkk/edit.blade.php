<x-layouts.admin title="Profil BKK">

    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Profil BKK</h1>
        <p class="text-sm text-gray-500">Kelola informasi profil, visi, dan misi yang tampil di halaman publik.</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 max-w-2xl">
        <form method="POST" action="{{ route('admin.profil-bkk.update') }}">
            @csrf @method('PUT')

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">Profil / Tentang Kami</label>
                <textarea name="profil" rows="5" required
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('profil', $profilBkk->profil) }}</textarea>
                @error('profil') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">Visi</label>
                <textarea name="visi" rows="3" required
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('visi', $profilBkk->visi) }}</textarea>
                @error('visi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Misi</label>
                <p class="text-xs text-gray-400 mb-1">Tulis setiap poin misi pada baris baru.</p>
                <textarea name="misi" rows="5" required
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('misi', $profilBkk->misi) }}</textarea>
                @error('misi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition">Simpan Perubahan</button>
        </form>
    </div>

</x-layouts.admin>
