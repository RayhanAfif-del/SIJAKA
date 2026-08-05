<x-layouts.mitra title="Kelola Lowongan">

    @php
        $statusColor = [
            'menunggu' => 'bg-amber-100 text-amber-700',
            'disetujui' => 'bg-green-100 text-green-700',
            'ditolak' => 'bg-red-100 text-red-700',
        ];
    @endphp

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">Lowongan Saya</h1>
            <p class="text-sm text-gray-500">Kelola lowongan pekerjaan yang Anda ajukan.</p>
        </div>
        <a href="{{ route('mitra.lowongan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition">+ Tambah Lowongan</a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                <tr>
                    <th class="text-left px-5 py-3">Posisi</th>
                    <th class="text-left px-5 py-3">Lokasi</th>
                    <th class="text-left px-5 py-3">Deadline</th>
                    <th class="text-left px-5 py-3">Status</th>
                    <th class="text-right px-5 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($lowongan as $item)
                    <tr>
                        <td class="px-5 py-3 font-medium text-gray-800">{{ $item->posisi }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $item->lokasi }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $item->deadline->translatedFormat('d M Y') }}</td>
                        <td class="px-5 py-3">
                            <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $statusColor[$item->status] ?? 'bg-gray-100 text-gray-600' }}">{{ ucfirst($item->status) }}</span>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('mitra.lowongan.edit', $item) }}" class="text-xs text-blue-600 border border-blue-200 rounded-lg px-3 py-1.5 hover:bg-blue-50">Edit</a>
                                <form method="POST" action="{{ route('mitra.lowongan.destroy', $item) }}" onsubmit="return confirm('Hapus lowongan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs text-red-600 border border-red-200 rounded-lg px-3 py-1.5 hover:bg-red-50">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-gray-400">Anda belum memiliki lowongan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $lowongan->links() }}</div>

</x-layouts.mitra>
