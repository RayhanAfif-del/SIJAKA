<x-layouts.admin title="Kelola Lowongan">

    @php
        $statusColor = [
            'menunggu' => 'bg-amber-100 text-amber-700',
            'disetujui' => 'bg-green-100 text-green-700',
            'ditolak' => 'bg-red-100 text-red-700',
        ];
    @endphp

    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Kelola Lowongan</h1>
        <p class="text-sm text-gray-500">Verifikasi dan kelola lowongan yang diajukan oleh mitra.</p>
    </div>

    <div class="flex flex-wrap gap-2 mb-6">
        <a href="{{ route('admin.lowongan.index') }}" class="px-4 py-1.5 rounded-full text-sm {{ !request('status') ? 'bg-blue-600 text-white' : 'border border-gray-200 text-gray-600 hover:bg-gray-50' }}">Semua</a>
        <a href="{{ route('admin.lowongan.index', ['status' => 'menunggu']) }}" class="px-4 py-1.5 rounded-full text-sm {{ request('status') === 'menunggu' ? 'bg-blue-600 text-white' : 'border border-gray-200 text-gray-600 hover:bg-gray-50' }}">Menunggu</a>
        <a href="{{ route('admin.lowongan.index', ['status' => 'disetujui']) }}" class="px-4 py-1.5 rounded-full text-sm {{ request('status') === 'disetujui' ? 'bg-blue-600 text-white' : 'border border-gray-200 text-gray-600 hover:bg-gray-50' }}">Disetujui</a>
        <a href="{{ route('admin.lowongan.index', ['status' => 'ditolak']) }}" class="px-4 py-1.5 rounded-full text-sm {{ request('status') === 'ditolak' ? 'bg-blue-600 text-white' : 'border border-gray-200 text-gray-600 hover:bg-gray-50' }}">Ditolak</a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                <tr>
                    <th class="text-left px-5 py-3">Posisi</th>
                    <th class="text-left px-5 py-3">Mitra</th>
                    <th class="text-left px-5 py-3">Lokasi</th>
                    <th class="text-left px-5 py-3">Status</th>
                    <th class="text-right px-5 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($lowongan as $item)
                    <tr>
                        <td class="px-5 py-3 font-medium text-gray-800">{{ $item->posisi }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $item->mitra->nama_perusahaan }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $item->lokasi }}</td>
                        <td class="px-5 py-3">
                            <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $statusColor[$item->status] ?? 'bg-gray-100 text-gray-600' }}">{{ ucfirst($item->status) }}</span>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-2 flex-wrap">
                                @if ($item->status === 'menunggu')
                                    <form method="POST" action="{{ route('admin.lowongan.approve', $item) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="text-xs text-green-700 border border-green-200 rounded-lg px-3 py-1.5 hover:bg-green-50">Setujui</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.lowongan.reject', $item) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="text-xs text-red-600 border border-red-200 rounded-lg px-3 py-1.5 hover:bg-red-50">Tolak</button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.lowongan.edit', $item) }}" class="text-xs text-blue-600 border border-blue-200 rounded-lg px-3 py-1.5 hover:bg-blue-50">Edit</a>
                                <form method="POST" action="{{ route('admin.lowongan.destroy', $item) }}" onsubmit="return confirm('Hapus lowongan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs text-red-600 border border-red-200 rounded-lg px-3 py-1.5 hover:bg-red-50">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-gray-400">Tidak ada data lowongan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $lowongan->links() }}</div>

</x-layouts.admin>
