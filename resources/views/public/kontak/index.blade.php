<x-layouts.public title="Kontak">

    <section class="bg-blue-50">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Kontak Kami</h1>
            <p class="text-gray-500 text-sm max-w-2xl">Hubungi tim BKK SIJAKA SMK N 1 Bangsri untuk informasi lebih lanjut seputar layanan karier.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-14 grid lg:grid-cols-2 gap-10">
        <div class="space-y-6">
            <div class="flex items-start gap-4">
                <span class="w-11 h-11 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0">&#128205;</span>
                <div>
                    <p class="font-semibold text-gray-800">Alamat</p>
                    <p class="text-sm text-gray-500">{{ $kontak->alamat }}</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <span class="w-11 h-11 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0">&#9993;</span>
                <div>
                    <p class="font-semibold text-gray-800">Email</p>
                    <p class="text-sm text-gray-500">{{ $kontak->email }}</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <span class="w-11 h-11 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0">&#128222;</span>
                <div>
                    <p class="font-semibold text-gray-800">Telepon</p>
                    <p class="text-sm text-gray-500">{{ $kontak->telepon }}</p>
                </div>
            </div>
            @if ($kontak->jam_operasional)
                <div class="flex items-start gap-4">
                    <span class="w-11 h-11 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0">&#128337;</span>
                    <div>
                        <p class="font-semibold text-gray-800">Jam Operasional</p>
                        <p class="text-sm text-gray-500">{{ $kontak->jam_operasional }}</p>
                    </div>
                </div>
            @endif

            <div class="flex gap-3 pt-2">
                @if ($kontak->facebook)<a href="{{ $kontak->facebook }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100">FB</a>@endif
                @if ($kontak->instagram)<a href="{{ $kontak->instagram }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100">IG</a>@endif
                @if ($kontak->youtube)<a href="{{ $kontak->youtube }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100">YT</a>@endif
            </div>
        </div>

        <div class="rounded-2xl overflow-hidden h-72 lg:h-full bg-blue-100 flex items-center justify-center text-blue-400 text-sm font-medium">
            Lokasi BKK SMK N 1 Bangsri
        </div>
    </section>

</x-layouts.public>
