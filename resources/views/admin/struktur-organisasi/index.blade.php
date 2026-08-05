<x-layouts.admin title="Struktur Organisasi">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">Struktur Organisasi</h1>
            <p class="text-sm text-gray-500">Kelola data pengurus BKK yang tampil di halaman publik.</p>
        </div>
        <a href="{{ route('admin.struktur-organisasi.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition">+ Tambah Data</a>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @forelse ($struktur as $item)
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 text-center">
                <div class="w-16 h-16 rounded-full bg-blue-100 mx-auto mb-3 overflow-hidden flex items-center justify-center text-blue-600 font-semibold">
                    @if ($item->foto)
                        <img src="{{ Storage::url($item->foto) }}" class="w-full h-full object-cover" alt="{{ $item->nama }}">
                    @else
                        {{ collect(explode(' ', $item->nama))->map(fn ($w) => $w[0] ?? '')->take(2)->implode('') }}
                    @endif
                </div>
                <p class="font-medium text-gray-800 text-sm">{{ $item->nama }}</p>
                <p class="text-xs text-blue-600 mb-3">{{ $item->jabatan }}</p>
                <p class="text-xs text-gray-400 mb-3">Urutan: {{ $item->urutan }}</p>
                <div class="flex items-center justify-center gap-2">
                    <a href="{{ route('admin.struktur-organisasi.edit', $item) }}" class="text-xs text-blue-600 border border-blue-200 rounded-lg px-3 py-1.5 hover:bg-blue-50">Edit</a>
                    <form method="POST" action="{{ route('admin.struktur-organisasi.destroy', $item) }}" onsubmit="return confirm('Hapus data ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-red-600 border border-red-200 rounded-lg px-3 py-1.5 hover:bg-red-50">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-400 text-sm py-10">Belum ada data struktur organisasi.</p>
        @endforelse
    </div>

</x-layouts.admin>
