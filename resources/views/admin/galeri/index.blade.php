<x-layouts.admin title="Galeri">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">Galeri Kegiatan</h1>
            <p class="text-sm text-gray-500">Kelola dokumentasi foto kegiatan BKK.</p>
        </div>
        <a href="{{ route('admin.galeri.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition">+ Tambah Foto</a>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @forelse ($galeri as $item)
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="h-32 bg-gray-100">
                    @if ($item->foto)
                        <img src="{{ Storage::url($item->foto) }}" class="w-full h-full object-cover">
                    @endif
                </div>
                <div class="p-4">
                    <p class="text-sm font-medium text-gray-800 line-clamp-1">{{ $item->judul }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $item->kategori }} &middot; {{ $item->tanggal->translatedFormat('d M Y') }}</p>
                    <div class="flex items-center gap-2 mt-3">
                        <a href="{{ route('admin.galeri.edit', $item) }}" class="text-xs text-blue-600 border border-blue-200 rounded-lg px-3 py-1.5 hover:bg-blue-50">Edit</a>
                        <form method="POST" action="{{ route('admin.galeri.destroy', $item) }}" onsubmit="return confirm('Hapus foto ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-red-600 border border-red-200 rounded-lg px-3 py-1.5 hover:bg-red-50">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-400 text-sm py-10">Belum ada foto galeri.</p>
        @endforelse
    </div>

    <div class="mt-6">{{ $galeri->links() }}</div>

</x-layouts.admin>
