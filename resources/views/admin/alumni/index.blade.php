<x-layouts.admin title="Alumni">

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Data Alumni</h1>
            <p class="admin-page-subtitle">Kelola data alumni untuk statistik penyerapan kerja.</p>
        </div>
        <a href="{{ route('admin.alumni.create') }}" class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">+ Tambah Alumni</a>
    </div>

    <form method="GET" action="{{ route('admin.alumni.index') }}" class="mb-4">
        <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama alumni..." class="w-full sm:w-80 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
    </form>

    <div class="admin-table-shell">
        <table class="admin-table">
            <thead class="admin-table-head">
                <tr>
                    <th class="text-left">Nama</th>
                    <th class="text-left">Jurusan</th>
                    <th class="text-left">Tahun Lulus</th>
                    <th class="text-left">Status</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($alumni as $item)
                    <tr class="admin-table-row">
                        <td class="admin-table-cell font-medium text-slate-800">{{ $item->nama }}</td>
                        <td class="admin-table-cell">{{ $item->jurusan }}</td>
                        <td class="admin-table-cell">{{ $item->tahun_lulus }}</td>
                        <td class="admin-table-cell">
                            <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ match($item->status) { 'Bekerja' => 'bg-green-100 text-green-700', 'Melanjutkan Studi' => 'bg-blue-100 text-blue-700', default => 'bg-amber-100 text-amber-700' } }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="admin-table-cell">
                            <div class="admin-action-group">
                                <a href="{{ route('admin.alumni.edit', $item) }}" class="admin-action-link border-blue-200 text-blue-600 hover:bg-blue-50">Edit</a>
                                <form method="POST" action="{{ route('admin.alumni.destroy', $item) }}" onsubmit="return confirm('Hapus data alumni ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-action-link border-red-200 text-red-600 hover:bg-red-50">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="admin-empty-state">Belum ada data alumni.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $alumni->links() }}</div>

</x-layouts.admin>
