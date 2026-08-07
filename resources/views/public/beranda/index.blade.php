<x-layouts.public title="Beranda">

    {{-- Hero --}}
    <section class="bg-blue-50">
        <div class="max-w-7xl mx-auto px-4 py-14 grid lg:grid-cols-2 gap-10 items-center">
            <div>
                <span class="inline-block bg-amber-400 text-amber-900 text-xs font-semibold px-3 py-1 rounded-full mb-4">BKK SMKN 1 Bangsri</span>
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 leading-tight mb-4">
                    Jembatan Karier <span class="text-blue-600">untuk Masa Depan</span> Gemilang
                </h1>
                <p class="text-gray-500 mb-6">Kami siap membantu siswa, alumni, dan masyarakat dalam mendapatkan informasi dunia kerja terkini dan peluang karier terbaik.</p>
                <div class="flex flex-wrap gap-3 mb-8">
                    <a href="{{ route('lowongan.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-3 rounded-lg transition">Lihat Lowongan</a>
                    <a href="{{ route('profil.index') }}" class="bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-sm font-medium px-5 py-3 rounded-lg transition">Tentang BKK</a>
                </div>
                <div class="flex flex-wrap gap-6 text-sm text-gray-600">
                    <span class="flex items-center gap-2"><span class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">&#128101;</span> Terpercaya</span>
                    <span class="flex items-center gap-2"><span class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">&#128188;</span> Peluang Kerja</span>
                    <span class="flex items-center gap-2"><span class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">&#128200;</span> Karier Sukses</span>
                    <span class="flex items-center gap-2"><span class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">&#128200;</span> Di Isi Opo Iki</span>
                </div>
            </div>
            <div class="rounded-2xl overflow-hidden shadow-lg">
                <div class="bg-blue-600 h-64 sm:h-80 flex items-center justify-center text-white text-lg font-semibold">
                    BKK SMK N 1 Bangsri
                </div>
            </div>
        </div>
    </section>

    {{-- Quick links --}}
    <section class="max-w-7xl mx-auto px-4 -mt-8 relative z-10">
        <div class="bg-white rounded-xl shadow-md border border-gray-100 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 divide-x divide-y sm:divide-y-0 divide-gray-100">
            @foreach ([
                ['label' => 'Lowongan Pekerjaan', 'desc' => 'Temukan peluang kerja sesuai minat Anda'],
                ['label' => 'Artikel Dunia Kerja', 'desc' => 'Tips, berita, dan informasi seputar dunia kerja'],
                ['label' => 'Galeri Kegiatan', 'desc' => 'Dokumentasi kegiatan BKK terbaru'],
                ['label' => 'Mitra Perusahaan', 'desc' => 'Perusahaan terbaik yang bekerja sama dengan kami'],
                ['label' => 'Statistik Alumni', 'desc' => 'Data penyerapan alumni dan capaian BKK'],
            ] as $item)
            <div class="p-5 flex items-start gap-3 hover:bg-blue-50/50 transition">
                <span class="w-9 h-9 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0">&#9679;</span>
                    <span>
                        <span class="block text-sm font-semibold text-gray-800">{{ $item['label'] }}</span>
                        <span class="block text-xs text-gray-400 mt-0.5">{{ $item['desc'] }}</span>
                </span>
            </div>
            @endforeach
        </div>
    </section>

    {{-- Lowongan unggulan --}}
    @if ($lowonganUnggulan->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 py-14 grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-semibold text-blue-900 flex items-center gap-2">&#9733; Lowongan Unggulan</h2>
                    <a href="{{ route('lowongan.index') }}" class="text-sm text-blue-600 hover:underline">Lihat Semua &rarr;</a>
                </div>
                <div class="grid sm:grid-cols-3 gap-4">
@foreach ($lowonganUnggulan as $item)
                        <div class="border border-gray-100 rounded-xl p-4 hover:shadow-md transition">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-9 h-9 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-xs font-semibold overflow-hidden flex-shrink-0">
                                    @if ($item->mitra->logo)
                                        <img src="{{ Storage::url($item->mitra->logo) }}" class="w-full h-full object-cover" alt="{{ $item->mitra->nama_perusahaan }}">
                                    @else
                                        {{ strtoupper(substr($item->mitra->nama_perusahaan, 0, 2)) }}
                                    @endif
                                </div>
                                <p class="font-semibold text-blue-700 text-sm">{{ $item->mitra->nama_perusahaan }}</p>
                            </div>
                            <p class="font-semibold text-gray-800 mb-1">{{ $item->posisi }}</p>
                            <p class="text-xs text-gray-400 mb-2">&#128205; {{ $item->lokasi }}</p>
                            <span class="inline-block text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded mb-3">{{ $item->jenis_pekerjaan }}</span>
                            <a href="{{ route('lowongan.show', $item) }}" class="block text-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 rounded-lg transition">Lihat Detail</a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="bg-blue-600 rounded-2xl p-8 text-white flex flex-col justify-between">
                <div>
                    <p class="text-lg font-semibold mb-2">Saatnya Raih Karier Impianmu!</p>
                    <p class="text-blue-100 text-sm mb-6">Temukan ribuan lowongan kerja terbaik dari perusahaan terpercaya.</p>
                </div>
                <a href="{{ route('lowongan.index') }}" class="inline-block bg-amber-400 hover:bg-amber-500 text-amber-950 text-sm font-semibold px-5 py-2.5 rounded-lg w-fit">Cari Lowongan Sekarang &rarr;</a>
            </div>
        </section>
    @endif

    {{-- Lowongan terbaru & Artikel terbaru --}}
    <section class="max-w-7xl mx-auto px-4 pb-14 grid lg:grid-cols-2 gap-8">
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-semibold text-blue-900">Lowongan Terbaru</h2>
                <a href="{{ route('lowongan.index') }}" class="text-sm text-blue-600 hover:underline">Lihat Semua &rarr;</a>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 divide-y divide-gray-100">
@forelse ($lowonganTerbaru as $item)
                    <a href="{{ route('lowongan.show', $item) }}" class="flex items-center justify-between gap-3 p-4 hover:bg-gray-50 transition">
                        <span class="flex items-center gap-3">
                            <span class="w-9 h-9 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-xs font-semibold overflow-hidden flex-shrink-0">
                                @if ($item->mitra->logo)
                                    <img src="{{ Storage::url($item->mitra->logo) }}" class="w-full h-full object-cover" alt="{{ $item->mitra->nama_perusahaan }}">
                                @else
                                    {{ strtoupper(substr($item->mitra->nama_perusahaan, 0, 2)) }}
                                @endif
                            </span>
                            <span>
                                <span class="block text-sm font-semibold text-gray-800">{{ $item->posisi }}</span>
                                <span class="block text-xs text-gray-400">{{ $item->mitra->nama_perusahaan }} &middot; {{ $item->lokasi }}</span>
                            </span>
                        </span>
                        <span class="text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded">{{ $item->jenis_pekerjaan }}</span>
                    </a>
                @empty
                    <p class="p-4 text-sm text-gray-400">Belum ada lowongan.</p>
                @endforelse
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-semibold text-blue-900">Artikel Terbaru</h2>
                <a href="{{ route('artikel.index') }}" class="text-sm text-blue-600 hover:underline">Lihat Semua &rarr;</a>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 divide-y divide-gray-100">
                @forelse ($artikelTerbaru as $item)
                    <a href="{{ route('artikel.show', $item) }}" class="flex items-center gap-3 p-4 hover:bg-gray-50 transition">
                        <div class="w-14 h-14 rounded-lg bg-gray-100 flex-shrink-0 overflow-hidden">
                            @if ($item->gambar)
                                <img src="{{ Storage::url($item->gambar) }}" class="w-full h-full object-cover" alt="{{ $item->judul }}">
                            @endif
                        </div>
                        <span>
                            <span class="block text-sm font-semibold text-gray-800 line-clamp-2">{{ $item->judul }}</span>
                            <span class="block text-xs text-gray-400 mt-1">{{ $item->created_at->translatedFormat('d M Y') }}</span>
                        </span>
                    </a>
                @empty
                    <p class="p-4 text-sm text-gray-400">Belum ada artikel.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Mitra & Statistik --}}
    <section class="max-w-7xl mx-auto px-4 pb-16 grid lg:grid-cols-2 gap-8">
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-semibold text-blue-900">Mitra Perusahaan Kami</h2>
            </div>
<div class="bg-white rounded-xl border border-gray-100 p-6 flex flex-wrap gap-4">
                @forelse ($mitra as $item)
                    <span class="w-16 h-16 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center overflow-hidden">
                        @if ($item->logo)
                            <img src="{{ Storage::url($item->logo) }}" class="w-full h-full object-contain" alt="{{ $item->nama_perusahaan }}" title="{{ $item->nama_perusahaan }}">
                        @else
                            <span class="text-xs font-semibold text-gray-400 px-1 text-center">{{ strtoupper(substr($item->nama_perusahaan, 0, 2)) }}</span>
                        @endif
                    </span>
                @empty
                    <p class="text-sm text-gray-400">Belum ada mitra.</p>
                @endforelse
            </div>
        </div>
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-semibold text-blue-900">Statistik Penyerapan Alumni</h2>
                <a href="{{ route('statistik.index') }}" class="text-sm text-blue-600 hover:underline">Lihat Semua &rarr;</a>
            </div>
@php $totalAlumniBeranda = $alumniBekerja + $alumniMelanjutkanStudi + $alumniBelumBekerja; @endphp
            <div class="bg-white rounded-xl border border-gray-100 p-6 grid grid-cols-2 gap-4">
                <div class="bg-blue-50 rounded-lg p-4 text-center">
                    <p class="text-2xl font-bold text-blue-700">{{ $alumniBekerja }}</p>
                    <p class="text-xs text-gray-500 mt-1">Sudah Bekerja</p>
                </div>
                <div class="bg-amber-50 rounded-lg p-4 text-center">
                    <p class="text-2xl font-bold text-amber-600">{{ $alumniMelanjutkanStudi }}</p>
                    <p class="text-xs text-gray-500 mt-1">Melanjutkan Studi</p>
                </div>
                <div class="col-span-2 text-center text-sm text-gray-500 pt-2">
                    Total Alumni Terdata: <span class="font-semibold text-gray-700">{{ $totalAlumniBeranda }}</span>
                </div>
            </div>
        </div>
    </section>

</x-layouts.public>
