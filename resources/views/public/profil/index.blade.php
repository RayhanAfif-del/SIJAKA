<x-layouts.public title="Profil SIJAKA">

    <section class="bg-blue-950 text-white">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <p class="text-sm text-blue-300 mb-2"><a href="{{ route('home') }}" class="hover:text-white">Beranda</a> &gt; Profil</p>
            <h1 class="text-3xl font-bold mb-3">Profil SIJAKA<br>SMKN 1 Bangsri</h1>
            <p class="text-blue-200 max-w-2xl text-sm leading-relaxed">SIJAKA (Sistem Informasi Jejaring Karier) adalah platform resmi BKK SMKN 1 Bangsri yang menghubungkan pencari kerja dengan dunia usaha dan industri.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-14 grid lg:grid-cols-2 gap-10 items-center">
        <div class="rounded-2xl overflow-hidden bg-blue-100 h-72 flex items-center justify-center text-blue-400 font-medium">
            Foto Kegiatan BKK
        </div>
        <div>
            <p class="text-blue-600 text-sm font-semibold mb-1">TENTANG KAMI</p>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">SIJAKA SMK N 1 Bangsri</h2>
            <div class="text-gray-500 text-sm leading-relaxed space-y-3">
                {!! nl2br(e($profilBkk->profil)) !!}
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-14">
        <div class="max-w-7xl mx-auto px-4">
            <p class="text-center text-sm font-semibold text-blue-600 mb-8">&middot;&middot; VISI &amp; MISI &middot;&middot;</p>
            <div class="grid lg:grid-cols-2 gap-6">
                <div class="bg-blue-900 rounded-2xl p-8 text-white flex flex-col justify-center">
                    <p class="text-blue-300 text-sm font-semibold mb-2">VISI</p>
                    <p class="leading-relaxed">{{ $profilBkk->visi }}</p>
                </div>
                <div class="bg-white border border-blue-100 rounded-2xl p-8">
                    <p class="text-blue-600 text-sm font-semibold mb-4">MISI</p>
                    <ul class="space-y-3 text-sm text-gray-600">
                        @foreach (preg_split('/\r\n|\r|\n/', trim($profilBkk->misi)) as $poin)
                            @if (trim($poin) !== '')
                                <li class="flex items-start gap-2">
                                    <span class="text-blue-600 mt-0.5">&#10003;</span>
                                    <span>{{ $poin }}</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    

</x-layouts.public>
