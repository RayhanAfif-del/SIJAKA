<x-layouts.public title="Lowongan Pekerjaan">

    <section class="bg-blue-50">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Lowongan Pekerjaan</h1>
            <p class="text-gray-500 text-sm">Temukan peluang kerja terbaik dari perusahaan mitra SIJAKA SMK N 1 Bangsri.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-8">
        <form method="GET" action="{{ route('lowongan.index') }}" class="flex flex-col sm:flex-row gap-3 mb-10">
            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari lowongan (perusahaan, posisi)"
                class="flex-1 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
            <select name="lokasi" class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                <option value="">Semua Lokasi</option>
                @foreach ($daftarLokasi as $lokasi)
                    <option value="{{ $lokasi }}" @selected(request('lokasi') === $lokasi)>{{ $lokasi }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-6 py-2.5 rounded-lg transition">Cari</button>
        </form>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($lowongan as $item)
<div class="border border-gray-100 rounded-xl p-5 hover:shadow-md transition flex flex-col">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-sm font-semibold overflow-hidden flex-shrink-0">
                            @if ($item->mitra->logo)
                                <img src="{{ Storage::url($item->mitra->logo) }}" class="w-full h-full object-cover" alt="{{ $item->mitra->nama_perusahaan }}">
                            @else
                                {{ strtoupper(substr($item->mitra->nama_perusahaan, 0, 2)) }}
                            @endif
                        </div>
                        <p class="font-semibold text-blue-700 text-sm">{{ $item->mitra->nama_perusahaan }}</p>
                    </div>
                    <p class="font-semibold text-gray-800 mb-1">{{ $item->posisi }}</p>
                    <p class="text-xs text-gray-400 mb-3">&#128205; {{ $item->lokasi }}</p>
                    <span class="inline-block w-fit text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded mb-4">{{ $item->jenis_pekerjaan }}</span>
                    <a href="{{ route('lowongan.show', $item) }}" class="mt-auto block text-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2.5 rounded-lg transition">Lihat Detail</a>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-400 text-sm py-10">Belum ada lowongan yang tersedia saat ini.</p>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $lowongan->links() }}
        </div>
    </section>

</x-layouts.public>
