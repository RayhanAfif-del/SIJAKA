<x-layouts.admin title="Artikel">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">Artikel</h1>
            <p class="text-sm text-gray-500">Kelola artikel dunia kerja yang tampil di halaman publik.</p>
        </div>
        <a href="{{ route('admin.artikel.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition">+ Tulis Artikel</a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                <tr>
                    <th class="text-left px-5 py-3">Judul</th>
                    <th class="text-left px-5 py-3">Kategori</th>
                    <th class="text-left px-5 py-3">Tanggal</th>
                    <th class="text-right px-5 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($artikel as $item)
                    <tr>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                                    @if ($item->gambar)
                                        <img src="{{ Storage::url($item->gambar) }}" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <span class="font-medium text-gray-800 line-clamp-1">{{ $item->judul }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-gray-500">{{ $item->kategori }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $item->created_at->translatedFormat('d M Y') }}</td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.artikel.edit', $item) }}" class="text-xs text-blue-600 border border-blue-200 rounded-lg px-3 py-1.5 hover:bg-blue-50">Edit</a>
                                <form method="POST" action="{{ route('admin.artikel.destroy', $item) }}" onsubmit="return confirm('Hapus artikel ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs text-red-600 border border-red-200 rounded-lg px-3 py-1.5 hover:bg-red-50">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-5 py-8 text-center text-gray-400">Belum ada artikel.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $artikel->links() }}</div>

</x-layouts.admin>
