<x-layouts.public title="Beranda">

    @php
        $heroBadge = $pengaturanWebsite->hero_badge ?: 'BKK SMKN 1 Bangsri';
        $heroTitlePrefix = $pengaturanWebsite->hero_title_prefix ?: 'Jembatan Karier';
        $heroTitleHighlight = $pengaturanWebsite->hero_title_highlight ?: 'untuk Masa Depan';
        $heroTitleSuffix = $pengaturanWebsite->hero_title_suffix ?: 'Gemilang';
        $heroDescription = $pengaturanWebsite->hero_description ?: 'Kami siap membantu siswa, alumni, dan masyarakat dalam mendapatkan informasi dunia kerja terkini dan peluang karier terbaik.';
        $heroPrimaryLabel = $pengaturanWebsite->hero_primary_label ?: 'Lihat Lowongan';
        $heroPrimaryUrl = $pengaturanWebsite->hero_primary_url ?: route('lowongan.index');
        $heroSecondaryLabel = $pengaturanWebsite->hero_secondary_label ?: 'Tentang BKK';
        $heroSecondaryUrl = $pengaturanWebsite->hero_secondary_url ?: route('profil.index');
        $heroImageUrl = $pengaturanWebsite->hero_image ? \Illuminate\Support\Facades\Storage::url($pengaturanWebsite->hero_image) : null;
    @endphp

    {{-- Hero --}}
    <section class="bg-blue-50">
        <div class="max-w-7xl mx-auto px-4 py-14 grid lg:grid-cols-2 gap-10 items-center">
            <div>
                <span class="inline-block bg-amber-400 text-amber-900 text-xs font-semibold px-3 py-1 rounded-full mb-4">{{ $heroBadge }}</span>
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 leading-tight mb-4">
                    {{ $heroTitlePrefix }} <span class="text-blue-600">{{ $heroTitleHighlight }}</span> {{ $heroTitleSuffix }}
                </h1>
                <p class="text-gray-500 mb-6">{{ $heroDescription }}</p>
                <div class="flex flex-wrap gap-3 mb-8">
                    <a href="{{ $heroPrimaryUrl }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-3 rounded-lg transition">{{ $heroPrimaryLabel }}</a>
                    <a href="{{ $heroSecondaryUrl }}" class="bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-sm font-medium px-5 py-3 rounded-lg transition">{{ $heroSecondaryLabel }}</a>
                </div>
                <div class="flex flex-wrap gap-6 text-sm text-gray-600">
                    <span class="flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V6l-8-4-8 4v6c0 6 8 10 8 10z"/>
                            </svg>
                        </span>
                        Terpercaya
                    </span>
                    <span class="flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M5 7v12a2 2 0 002 2h10a2 2 0 002-2V7"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 11h4"/>
                            </svg>
                        </span>
                        Peluang Kerja
                    </span>
                    <span class="flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 19V5"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 19h16"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 15l3-4 3 2 4-6"/>
                            </svg>
                        </span>
                        Karier Sukses
                    </span>
                    <span class="flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"/>
                                <circle cx="12" cy="12" r="9"/>
                            </svg>
                        </span>
                        Di Isi Opo Iki
                    </span>
                </div>
            </div>
            <div class="rounded-2xl overflow-hidden shadow-lg bg-white">
                @if ($heroImageUrl)
                    <img
                        src="{{ $heroImageUrl }}"
                        alt="Foto beranda utama"
                        class="w-full h-64 sm:h-80 object-cover"
                    >
                @else
                    <svg
                        viewBox="0 0 960 720"
                        class="w-full h-64 sm:h-80 block"
                        role="img"
                        aria-labelledby="heroDummyTitle heroDummyDesc"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <title id="heroDummyTitle">{{ $heroBadge }}</title>
                        <desc id="heroDummyDesc">Ilustrasi dummy dengan nuansa biru dan oranye untuk halaman utama.</desc>
                        <rect width="960" height="720" rx="40" fill="#EFF6FF" />
                        <circle cx="780" cy="120" r="110" fill="#FDE68A" fill-opacity="0.75" />
                        <circle cx="160" cy="620" r="140" fill="#BFDBFE" fill-opacity="0.7" />
                        <path d="M120 520C200 410 310 370 430 370C550 370 640 420 760 320C822 268 870 238 920 220V720H120V520Z" fill="#1D4ED8" fill-opacity="0.12" />
                        <path d="M70 560C170 470 285 440 410 440C548 440 652 506 778 430C835 395 878 367 930 350V720H70V560Z" fill="#0EA5E9" fill-opacity="0.18" />
                        <rect x="110" y="120" width="740" height="460" rx="32" fill="white" opacity="0.8" />
                        <rect x="150" y="160" width="260" height="20" rx="10" fill="#DBEAFE" />
                        <rect x="150" y="202" width="370" height="22" rx="11" fill="#93C5FD" />
                        <rect x="150" y="250" width="520" height="16" rx="8" fill="#E2E8F0" />
                        <rect x="150" y="282" width="460" height="16" rx="8" fill="#E2E8F0" />
                        <rect x="150" y="314" width="420" height="16" rx="8" fill="#E2E8F0" />
                        <rect x="150" y="370" width="220" height="140" rx="24" fill="#DBEAFE" />
                        <rect x="402" y="370" width="220" height="140" rx="24" fill="#FEF3C7" />
                        <rect x="654" y="370" width="120" height="140" rx="24" fill="#E0F2FE" />
                        <circle cx="260" cy="435" r="34" fill="#2563EB" />
                        <circle cx="512" cy="435" r="34" fill="#F59E0B" />
                        <circle cx="714" cy="435" r="34" fill="#0EA5E9" />
                        <path d="M250 435L258 443L273 426" stroke="white" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M502 435L510 443L525 426" stroke="white" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M704 435L712 443L727 426" stroke="white" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" />
                        <text x="150" y="530" fill="#1E3A8A" font-family="Arial, Helvetica, sans-serif" font-size="32" font-weight="700">{{ $heroBadge }}</text>
                        <text x="150" y="566" fill="#64748B" font-family="Arial, Helvetica, sans-serif" font-size="20">Dummy image untuk tampilan beranda</text>
                    </svg>
                @endif
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
            <div class="p-5 flex items-start gap-3">
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
