<x-layouts.admin title="Struktur Organisasi">

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Struktur Organisasi</h1>
            <p class="admin-page-subtitle">Kelola data pengurus BKK yang tampil di halaman publik.</p>
        </div>
        <a href="{{ route('admin.struktur-organisasi.create') }}" class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">+ Tambah Data</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @forelse ($struktur as $item)
            <div class="dashboard-panel p-4 text-center">
                <div class="w-16 h-16 rounded-full bg-blue-100 mx-auto mb-3 overflow-hidden flex items-center justify-center text-blue-600 font-semibold">
                    @if ($item->foto)
                        <img src="{{ Storage::url($item->foto) }}" class="w-full h-full object-cover" alt="{{ $item->nama }}">
                    @else
                        {{ collect(explode(' ', $item->nama))->map(fn ($w) => $w[0] ?? '')->take(2)->implode('') }}
                    @endif
                </div>
                <p class="font-medium text-slate-800 text-sm">{{ $item->nama }}</p>
                <p class="text-xs text-blue-600 mb-2">{{ $item->jabatan }}</p>
                <p class="text-xs text-slate-400 mb-3">Urutan: {{ $item->urutan }}</p>
                <div class="admin-action-group justify-center">
                    <a href="{{ route('admin.struktur-organisasi.edit', $item) }}" class="admin-action-link border-blue-200 text-blue-600 hover:bg-blue-50">Edit</a>
                    <form method="POST" action="{{ route('admin.struktur-organisasi.destroy', $item) }}" onsubmit="return confirm('Hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="admin-action-link border-red-200 text-red-600 hover:bg-red-50">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="col-span-full admin-empty-state">Belum ada data struktur organisasi.</p>
        @endforelse
    </div>

</x-layouts.admin>
