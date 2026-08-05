<x-layouts.public :title="$lowongan->posisi">

    <section class="bg-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <p class="text-sm text-blue-200 mb-2">
                <a href="{{ route('home') }}" class="hover:text-white">Beranda</a> &gt;
                <a href="{{ route('lowongan.index') }}" class="hover:text-white">Lowongan Pekerjaan</a> &gt;
                Detail Lowongan
            </p>
            <h1 class="text-2xl sm:text-3xl font-bold">Detail Lowongan</h1>
            <p class="text-blue-200 text-sm mt-1">Informasi lengkap mengenai posisi, kualifikasi, dan cara melamar pekerjaan.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-10">
        <a href="{{ route('lowongan.index') }}" class="inline-flex items-center gap-1 text-sm text-blue-600 hover:underline mb-6">&larr; Kembali ke Daftar Lowongan</a>

        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
<div class="flex items-start justify-between border-b border-gray-100 pb-6">
                    <div class="flex items-start gap-4">
                        <div class="w-16 h-16 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 text-base font-semibold overflow-hidden flex-shrink-0">
                            @if ($lowongan->mitra->logo)
                                <img src="{{ Storage::url($lowongan->mitra->logo) }}" class="w-full h-full object-cover" alt="{{ $lowongan->mitra->nama_perusahaan }}">
                            @else
                                {{ strtoupper(substr($lowongan->mitra->nama_perusahaan, 0, 2)) }}
                            @endif
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 mb-1">{{ $lowongan->posisi }}</h2>
                            <p class="text-blue-600 font-medium mb-2">{{ $lowongan->mitra->nama_perusahaan }}</p>
<div class="flex flex-wrap gap-3 text-xs text-gray-500">
                            <span>&#128205; {{ $lowongan->lokasi }}</span>
                            <span>&#9200; {{ $lowongan->jenis_pekerjaan }}</span>
                            @if ($lowongan->gaji)<span>&#128176; {{ $lowongan->gaji }}</span>@endif
                        </div>
                        </div>
                    </div>
                    @if ($lowongan->unggulan)
                        <span class="bg-amber-100 text-amber-700 text-xs font-semibold px-3 py-1 rounded-full">Unggulan</span>
                    @endif
                </div>

                <div>
                    <h3 class="font-semibold text-blue-900 mb-3">Deskripsi Pekerjaan</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $lowongan->deskripsi }}</p>
                </div>

                <div>
                    <h3 class="font-semibold text-blue-900 mb-3">Persyaratan</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        @foreach (preg_split('/\r\n|\r|\n/', trim($lowongan->persyaratan)) as $poin)
                            @if (trim($poin) !== '')
                                <li class="flex items-start gap-2">
                                    <span class="text-blue-600 mt-0.5">&#10003;</span>
                                    <span>{{ $poin }}</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h3 class="font-semibold text-blue-900 mb-3">Cara Melamar</h3>
                    <div class="bg-blue-50 rounded-lg p-5 text-sm text-gray-600 leading-relaxed">
                        {!! nl2br(e($lowongan->cara_melamar)) !!}
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="border border-gray-100 rounded-xl p-6">
                    <h3 class="font-semibold text-blue-900 mb-4">Informasi Lowongan</h3>
                    <dl class="space-y-3 text-sm">
                        <div>
                            <dt class="text-gray-400 text-xs">Mitra</dt>
                            <dd class="text-gray-700 font-medium">{{ $lowongan->mitra->nama_perusahaan }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-xs">Posisi</dt>
                            <dd class="text-gray-700 font-medium">{{ $lowongan->posisi }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-xs">Lokasi</dt>
                            <dd class="text-gray-700 font-medium">{{ $lowongan->lokasi }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-xs">Tipe Pekerjaan</dt>
                            <dd class="text-gray-700 font-medium">{{ $lowongan->jenis_pekerjaan }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-xs">Batas Melamar</dt>
                            <dd class="text-gray-700 font-medium">{{ $lowongan->deadline->translatedFormat('d F Y') }}</dd>
                        </div>
                    </dl>
                </div>

                @if ($lowonganLainnya->isNotEmpty())
                    <div class="border border-gray-100 rounded-xl p-6">
                        <h3 class="font-semibold text-blue-900 mb-4">Lowongan Lainnya</h3>
                        <ul class="space-y-3">
                            @foreach ($lowonganLainnya as $item)
                                <li class="flex items-center justify-between gap-2">
                                    <span>
                                        <span class="block text-sm font-medium text-gray-800">{{ $item->posisi }}</span>
                                        <span class="block text-xs text-gray-400">{{ $item->mitra->nama_perusahaan }}</span>
                                    </span>
                                    <a href="{{ route('lowongan.show', $item) }}" class="text-xs text-blue-600 border border-blue-200 rounded px-2 py-1 hover:bg-blue-50">Lihat</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </section>

</x-layouts.public>
