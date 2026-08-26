<x-layouts.public title="Lowongan Pekerjaan">

    <section class="bg-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <h1 class="text-3xl font-bold mb-2">Lowongan Pekerjaan</h1>
            <p class="text-blue-200 text-sm">Temukan peluang kerja terbaik dari perusahaan mitra SIJAKA SMK N 1 Bangsri.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-8">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-5 mb-10">
            <form method="GET" action="{{ route('lowongan.index') }}" class="grid gap-3 lg:grid-cols-[1fr_260px_auto_auto] items-end">
                <div>
                    <label for="cari" class="block text-sm font-medium text-gray-700 mb-1">Cari lowongan</label>
                    <input
                        id="cari"
                        type="text"
                        name="cari"
                        value="{{ request('cari') }}"
                        placeholder="Posisi, perusahaan, lokasi, atau jenis pekerjaan"
                    >
                </div>

                <div>
                    <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                    <select id="lokasi" name="lokasi">
                        <option value="">Semua lokasi</option>
                        @foreach ($daftarLokasi as $lokasi)
                            <option value="{{ $lokasi }}" @selected(request('lokasi') === $lokasi)>{{ $lokasi }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                    Cari
                </button>

                @if (request()->filled('cari') || request()->filled('lokasi'))
                    <a href="{{ route('lowongan.index') }}" class="inline-flex items-center justify-center rounded-xl border border-gray-200 px-6 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                        Reset
                    </a>
                @endif
            </form>

            @if (request()->filled('cari') || request()->filled('lokasi'))
                <div class="mt-4 flex flex-wrap items-center gap-2 text-xs text-gray-500">
                    <span class="font-medium text-gray-700">Filter aktif:</span>
                    @if (request()->filled('cari'))
                        <span class="rounded-full bg-blue-50 px-3 py-1 text-blue-700">Kata kunci: {{ request('cari') }}</span>
                    @endif
                    @if (request()->filled('lokasi'))
                        <span class="rounded-full bg-amber-50 px-3 py-1 text-amber-700">Lokasi: {{ request('lokasi') }}</span>
                    @endif
                    <span class="rounded-full bg-gray-100 px-3 py-1 text-gray-600">{{ $lowongan->total() }} hasil</span>
                </div>
            @endif
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($lowongan as $item)
                <div class="border border-gray-100 rounded-xl p-5 hover:shadow-md transition flex flex-col bg-white">
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
