<x-layouts.admin title="Galeri">

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Galeri Kegiatan</h1>
            <p class="admin-page-subtitle">Kelola dokumentasi foto kegiatan BKK.</p>
        </div>
        <a href="{{ route('admin.galeri.create') }}" class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">+ Tambah Foto</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @forelse ($galeri as $item)
            <div class="dashboard-panel overflow-hidden">
                <div class="h-32 bg-slate-100">
                    @if ($item->foto)
                        <img src="{{ Storage::url($item->foto) }}" class="w-full h-full object-cover" alt="{{ $item->judul }}">
                    @endif
                </div>
                <div class="p-4">
                    <p class="text-sm font-medium text-slate-800 line-clamp-1">{{ $item->judul }}</p>
                    <p class="text-xs text-slate-400 mt-1">{{ $item->kategori }} &middot; {{ $item->tanggal->translatedFormat('d M Y') }}</p>
                    <div class="admin-action-group justify-start mt-3">
                        <a href="{{ route('admin.galeri.edit', $item) }}" class="admin-action-link border-blue-200 text-blue-600 hover:bg-blue-50">Edit</a>
                        <form method="POST" action="{{ route('admin.galeri.destroy', $item) }}" onsubmit="return confirm('Hapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-action-link border-red-200 text-red-600 hover:bg-red-50">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="col-span-full admin-empty-state">Belum ada foto galeri.</p>
        @endforelse
    </div>

    <div class="mt-6">{{ $galeri->links() }}</div>

</x-layouts.admin>
