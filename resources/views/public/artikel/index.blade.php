<x-layouts.public title="Artikel Dunia Kerja">

    <section class="bg-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <h1 class="text-3xl font-bold mb-2">Artikel Dunia Kerja</h1>
            <p class="text-blue-200 text-sm max-w-2xl">Temukan informasi, tips, dan inspirasi seputar dunia kerja, karier, dan pengembangan diri.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-8">
        <form method="GET" action="{{ route('artikel.index') }}" class="flex gap-3 mb-10">
            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari artikel"
                class="flex-1 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-6 py-2.5 rounded-lg transition">Cari</button>
        </form>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($artikel as $item)
                <div class="border border-gray-100 rounded-xl overflow-hidden hover:shadow-md transition flex flex-col">
                    <div class="h-44 bg-gray-100 relative">
                        @if ($item->gambar)
                            <img src="{{ Storage::url($item->gambar) }}" class="w-full h-full object-cover" alt="{{ $item->judul }}">
                        @endif
                        <span class="absolute top-3 left-3 bg-blue-600 text-white text-xs font-medium px-2.5 py-1 rounded">{{ $item->kategori }}</span>
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <p class="font-semibold text-gray-800 mb-2 line-clamp-2">{{ $item->judul }}</p>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2 flex-1">{{ Str::limit(strip_tags($item->konten), 100) }}</p>
                        <p class="text-xs text-gray-400 mb-3">{{ $item->created_at->translatedFormat('d M Y') }}</p>
                        <a href="{{ route('artikel.show', $item) }}" class="block text-center border border-blue-200 text-blue-600 hover:bg-blue-50 text-sm font-medium py-2 rounded-lg transition">Baca Artikel &rarr;</a>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-400 text-sm py-10">Belum ada artikel.</p>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $artikel->links() }}
        </div>
    </section>

</x-layouts.public>
