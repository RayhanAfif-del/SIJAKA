<x-layouts.admin title="Mitra Perusahaan">

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Mitra Perusahaan</h1>
            <p class="admin-page-subtitle">Kelola akun perusahaan mitra SIJAKA.</p>
        </div>
        <a href="{{ route('admin.mitra.create') }}" class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">+ Tambah Mitra</a>
    </div>

    <div class="admin-table-shell">
        <table class="admin-table">
            <thead class="admin-table-head">
                <tr>
                    <th class="text-left">Perusahaan</th>
                    <th class="text-left">Email</th>
                    <th class="text-left">Total Lowongan</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mitra as $item)
                    <tr class="admin-table-row">
                        <td class="admin-table-cell">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-9 h-9 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-xs font-semibold overflow-hidden shrink-0">
                                    @if ($item->logo)
                                        <img src="{{ Storage::url($item->logo) }}" class="w-full h-full object-cover" alt="{{ $item->nama_perusahaan }}">
                                    @else
                                        {{ strtoupper(substr($item->nama_perusahaan, 0, 2)) }}
                                    @endif
                                </div>
                                <span class="font-medium text-slate-800 line-clamp-1">{{ $item->nama_perusahaan }}</span>
                            </div>
                        </td>
                        <td class="admin-table-cell">{{ $item->email }}</td>
                        <td class="admin-table-cell">{{ $item->lowongan_count }}</td>
                        <td class="admin-table-cell">
                            <div class="admin-action-group">
                                <a href="{{ route('admin.mitra.edit', $item) }}" class="admin-action-link border-blue-200 text-blue-600 hover:bg-blue-50">Edit</a>
                                <form method="POST" action="{{ route('admin.mitra.reset-password', $item) }}" onsubmit="return confirm('Reset password mitra ini?')">
                                    @csrf
                                    <button type="submit" class="admin-action-link border-amber-200 text-amber-600 hover:bg-amber-50">Reset Password</button>
                                </form>
                                <form method="POST" action="{{ route('admin.mitra.destroy', $item) }}" onsubmit="return confirm('Hapus akun mitra ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-action-link border-red-200 text-red-600 hover:bg-red-50">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="admin-empty-state">Belum ada mitra terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $mitra->links() }}</div>

</x-layouts.admin>
