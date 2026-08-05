<x-layouts.public title="Struktur Organisasi">

    <section class="bg-blue-50">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <p class="text-sm text-gray-400 mb-2"><a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a> &gt; <a href="{{ route('profil.index') }}" class="hover:text-blue-600">Profil SIJAKA</a> &gt; Struktur Organisasi</p>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Struktur Organisasi</h1>
            <p class="text-gray-500 text-sm max-w-2xl">Susunan pengurus BKK SIJAKA SMK N 1 Bangsri yang bertanggung jawab menjalankan layanan informasi karier.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-14">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($struktur as $item)
                <div class="bg-white rounded-xl border border-gray-100 p-6 text-center hover:shadow-md transition">
                    <div class="w-20 h-20 rounded-full bg-blue-100 mx-auto mb-4 overflow-hidden flex items-center justify-center text-blue-500 font-semibold text-lg">
                        @if ($item->foto)
                            <img src="{{ Storage::url($item->foto) }}" class="w-full h-full object-cover" alt="{{ $item->nama }}">
                        @else
                            {{ collect(explode(' ', $item->nama))->map(fn ($w) => $w[0] ?? '')->take(2)->implode('') }}
                        @endif
                    </div>
                    <p class="font-semibold text-gray-800">{{ $item->nama }}</p>
                    <p class="text-sm text-blue-600">{{ $item->jabatan }}</p>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-400 text-sm">Data struktur organisasi belum tersedia.</p>
            @endforelse
        </div>
    </section>

</x-layouts.public>
