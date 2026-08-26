<x-layouts.admin title="Artikel">

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Artikel</h1>
            <p class="admin-page-subtitle">Kelola artikel dunia kerja yang tampil di halaman publik.</p>
        </div>
        <a href="{{ route('admin.artikel.create') }}" class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">+ Tulis Artikel</a>
    </div>

    <div class="admin-table-shell">
        <table class="admin-table">
            <thead class="admin-table-head">
                <tr>
                    <th class="text-left">Judul</th>
                    <th class="text-left">Kategori</th>
                    <th class="text-left">Tanggal</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($artikel as $item)
                    <tr class="admin-table-row">
                        <td class="admin-table-cell">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-10 h-10 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0">
                                    @if ($item->gambar)
                                        <img src="{{ Storage::url($item->gambar) }}" class="w-full h-full object-cover" alt="{{ $item->judul }}">
                                    @endif
                                </div>
                                <span class="font-medium text-slate-800 line-clamp-1">{{ $item->judul }}</span>
                            </div>
                        </td>
                        <td class="admin-table-cell">{{ $item->kategori }}</td>
                        <td class="admin-table-cell">{{ $item->created_at->translatedFormat('d M Y') }}</td>
                        <td class="admin-table-cell">
                            <div class="admin-action-group">
                                <a href="{{ route('admin.artikel.edit', $item) }}" class="admin-action-link border-blue-200 text-blue-600 hover:bg-blue-50">Edit</a>
                                <form method="POST" action="{{ route('admin.artikel.destroy', $item) }}" onsubmit="return confirm('Hapus artikel ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-action-link border-red-200 text-red-600 hover:bg-red-50">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="admin-empty-state">Belum ada artikel.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $artikel->links() }}</div>

</x-layouts.admin>
