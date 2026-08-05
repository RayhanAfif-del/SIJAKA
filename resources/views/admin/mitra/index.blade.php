<x-layouts.admin title="Mitra Perusahaan">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">Mitra Perusahaan</h1>
            <p class="text-sm text-gray-500">Kelola akun perusahaan mitra SIJAKA.</p>
        </div>
        <a href="{{ route('admin.mitra.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition">+ Tambah Mitra</a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                <tr>
                    <th class="text-left px-5 py-3">Perusahaan</th>
                    <th class="text-left px-5 py-3">Email</th>
                    <th class="text-left px-5 py-3">Total Lowongan</th>
                    <th class="text-right px-5 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($mitra as $item)
                    <tr>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-xs font-semibold overflow-hidden">
                                    @if ($item->logo)
                                        <img src="{{ Storage::url($item->logo) }}" class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr($item->nama_perusahaan, 0, 2)) }}
                                    @endif
                                </div>
                                <span class="font-medium text-gray-800">{{ $item->nama_perusahaan }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-gray-500">{{ $item->email }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $item->lowongan_count }}</td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.mitra.edit', $item) }}" class="text-xs text-blue-600 border border-blue-200 rounded-lg px-3 py-1.5 hover:bg-blue-50">Edit</a>
                                <form method="POST" action="{{ route('admin.mitra.reset-password', $item) }}" onsubmit="return confirm('Reset password mitra ini?')">
                                    @csrf
                                    <button type="submit" class="text-xs text-amber-600 border border-amber-200 rounded-lg px-3 py-1.5 hover:bg-amber-50">Reset Password</button>
                                </form>
                                <form method="POST" action="{{ route('admin.mitra.destroy', $item) }}" onsubmit="return confirm('Hapus akun mitra ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs text-red-600 border border-red-200 rounded-lg px-3 py-1.5 hover:bg-red-50">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-5 py-8 text-center text-gray-400">Belum ada mitra terdaftar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $mitra->links() }}</div>

</x-layouts.admin>
