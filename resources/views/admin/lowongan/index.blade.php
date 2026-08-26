<x-layouts.admin title="Kelola Lowongan">

    @php
        $statusColor = [
            'menunggu' => 'bg-amber-100 text-amber-700',
            'disetujui' => 'bg-green-100 text-green-700',
            'ditolak' => 'bg-red-100 text-red-700',
        ];
        $statusFilters = [
            'Semua' => null,
            'Menunggu' => 'menunggu',
            'Disetujui' => 'disetujui',
            'Ditolak' => 'ditolak',
        ];
    @endphp

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Kelola Lowongan</h1>
            <p class="admin-page-subtitle">Verifikasi dan kelola lowongan yang diajukan oleh mitra.</p>
        </div>
    </div>

    <div class="admin-toolbar mb-4">
        @foreach ($statusFilters as $label => $value)
            <a href="{{ is_null($value) ? route('admin.lowongan.index') : route('admin.lowongan.index', ['status' => $value]) }}"
               class="admin-filter-chip {{ request('status') === $value || (is_null($value) && !request('status')) ? 'bg-blue-600 border-blue-600 text-white' : 'border-slate-200 bg-white text-slate-600 hover:bg-slate-50' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <div class="admin-table-shell">
        <table class="admin-table">
            <thead class="admin-table-head">
                <tr>
                    <th class="text-left">Posisi</th>
                    <th class="text-left">Mitra</th>
                    <th class="text-left">Lokasi</th>
                    <th class="text-left">Status</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lowongan as $item)
                    <tr class="admin-table-row">
                        <td class="admin-table-cell font-medium text-slate-800">{{ $item->posisi }}</td>
                        <td class="admin-table-cell">{{ $item->mitra->nama_perusahaan }}</td>
                        <td class="admin-table-cell">{{ $item->lokasi }}</td>
                        <td class="admin-table-cell">
                            <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $statusColor[$item->status] ?? 'bg-slate-100 text-slate-600' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="admin-table-cell">
                            <div class="admin-action-group">
                                @if ($item->status === 'menunggu')
                                    <form method="POST" action="{{ route('admin.lowongan.approve', $item) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="admin-action-link border-green-200 text-green-700 hover:bg-green-50">Setujui</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.lowongan.reject', $item) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="admin-action-link border-red-200 text-red-600 hover:bg-red-50">Tolak</button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.lowongan.edit', $item) }}" class="admin-action-link border-blue-200 text-blue-600 hover:bg-blue-50">Edit</a>
                                <form method="POST" action="{{ route('admin.lowongan.destroy', $item) }}" onsubmit="return confirm('Hapus lowongan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-action-link border-red-200 text-red-600 hover:bg-red-50">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="admin-empty-state">Tidak ada data lowongan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $lowongan->links() }}</div>

</x-layouts.admin>
