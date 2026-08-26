<x-layouts.public title="Galeri Kegiatan">

    <section class="bg-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <h1 class="text-3xl font-bold mb-2">Galeri Kegiatan</h1>
            <p class="text-blue-200 text-sm max-w-2xl">Dokumentasi berbagai kegiatan yang telah dilaksanakan oleh SIJAKA SMK N 1 Bangsri bersama sekolah, siswa, alumni, dan mitra.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-10">
        <div class="flex flex-wrap gap-2 mb-8">
            <a href="{{ route('galeri.index') }}" class="px-4 py-1.5 rounded-full text-sm {{ !request('kategori') ? 'bg-blue-600 text-white' : 'border border-gray-200 text-gray-600 hover:bg-gray-50' }}">Semua Kegiatan</a>
            @foreach ($kategoriList as $kategori)
                <a href="{{ route('galeri.index', ['kategori' => $kategori]) }}" class="px-4 py-1.5 rounded-full text-sm {{ request('kategori') === $kategori ? 'bg-blue-600 text-white' : 'border border-gray-200 text-gray-600 hover:bg-gray-50' }}">{{ $kategori }}</a>
            @endforeach
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @forelse ($galeri as $item)
                <div class="rounded-xl overflow-hidden border border-gray-100 hover:shadow-md transition">
                    <div class="h-40 bg-gray-100">
                        @if ($item->foto)
                            <img src="{{ Storage::url($item->foto) }}" class="w-full h-full object-cover" alt="{{ $item->judul }}">
                        @endif
                    </div>
                    <div class="p-4">
                        <p class="text-sm font-semibold text-gray-800 line-clamp-2">{{ $item->judul }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $item->tanggal->translatedFormat('d M Y') }}</p>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-400 text-sm py-10">Belum ada dokumentasi kegiatan.</p>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $galeri->links() }}
        </div>
    </section>

</x-layouts.public>
