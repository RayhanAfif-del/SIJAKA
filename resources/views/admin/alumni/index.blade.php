<x-layouts.admin title="Alumni">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">Data Alumni</h1>
            <p class="text-sm text-gray-500">Kelola data alumni untuk statistik penyerapan kerja.</p>
        </div>
        <a href="{{ route('admin.alumni.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition">+ Tambah Alumni</a>
    </div>

    <form method="GET" action="{{ route('admin.alumni.index') }}" class="mb-6">
        <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama alumni..."
            class="w-full sm:w-80 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
    </form>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                <tr>
                    <th class="text-left px-5 py-3">Nama</th>
                    <th class="text-left px-5 py-3">Jurusan</th>
                    <th class="text-left px-5 py-3">Tahun Lulus</th>
                    <th class="text-left px-5 py-3">Status</th>
                    <th class="text-right px-5 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($alumni as $item)
                    <tr>
                        <td class="px-5 py-3 font-medium text-gray-800">{{ $item->nama }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $item->jurusan }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $item->tahun_lulus }}</td>
                        <td class="px-5 py-3">
<span class="text-xs font-medium px-2.5 py-1 rounded-full {{ match($item->status) { 'Bekerja' => 'bg-green-100 text-green-700', 'Melanjutkan Studi' => 'bg-blue-100 text-blue-700', default => 'bg-amber-100 text-amber-700' } }}">{{ $item->status }}</span>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.alumni.edit', $item) }}" class="text-xs text-blue-600 border border-blue-200 rounded-lg px-3 py-1.5 hover:bg-blue-50">Edit</a>
                                <form method="POST" action="{{ route('admin.alumni.destroy', $item) }}" onsubmit="return confirm('Hapus data alumni ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs text-red-600 border border-red-200 rounded-lg px-3 py-1.5 hover:bg-red-50">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-gray-400">Belum ada data alumni.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $alumni->links() }}</div>

</x-layouts.admin>
