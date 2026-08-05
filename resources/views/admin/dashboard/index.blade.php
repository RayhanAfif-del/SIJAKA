<x-layouts.admin title="Dashboard Admin">

    <h1 class="text-xl font-semibold text-gray-800">Dashboard Admin</h1>
    <p class="text-sm text-gray-500 mb-6">Selamat datang kembali, {{ auth('admin')->user()->name }}!</p>

    {{-- Kartu statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <x-admin.stat-card label="Total Mitra" :value="$totalMitra" color="blue" />
        <x-admin.stat-card label="Total Lowongan" :value="$totalLowongan" color="green" />
        <x-admin.stat-card label="Total Artikel" :value="$totalArtikel" color="purple" />
        <x-admin.stat-card label="Total Alumni" :value="$totalAlumni" color="amber" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">

        {{-- Statistik Penyerapan Alumni --}}
        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <h2 class="font-medium text-gray-800 mb-4">Statistik Penyerapan Alumni</h2>
            <div class="flex flex-col sm:flex-row items-center gap-6">
                <div class="w-40 h-40 shrink-0">
                    <canvas id="chartAlumniDonut"></canvas>
                </div>
                <div class="space-y-2 text-sm">
                    <p class="text-gray-500">Bekerja</p>
                    <p class="text-2xl font-semibold text-blue-600">{{ $alumniBekerja }}</p>
                    <p class="text-gray-500 pt-2">Belum Bekerja</p>
                    <p class="text-2xl font-semibold text-gray-400">{{ $alumniBelumBekerja }}</p>
                </div>
            </div>
        </div>

        {{-- Lowongan Menunggu Persetujuan --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-medium text-gray-800">Menunggu Persetujuan</h2>
                <span class="text-xs bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full">{{ $lowonganMenunggu->count() }}</span>
            </div>
            <div class="space-y-3">
                @forelse ($lowonganMenunggu as $item)
                    <div class="flex items-center justify-between text-sm">
                        <div>
                            <p class="font-medium text-gray-800">{{ $item->posisi }}</p>
                            <p class="text-gray-400 text-xs">{{ $item->mitra->nama_perusahaan }}</p>
                        </div>
                        <a href="{{ route('admin.lowongan.index', ['status' => 'menunggu']) }}" class="text-blue-600 text-xs hover:underline">Lihat</a>
                    </div>
                @empty
                    <p class="text-sm text-gray-400">Tidak ada lowongan menunggu.</p>
                @endforelse
            </div>
            <a href="{{ route('admin.lowongan.index', ['status' => 'menunggu']) }}" class="block text-center text-sm text-blue-600 mt-4 hover:underline">
                Lihat semua &rarr;
            </a>
        </div>
    </div>

    {{-- Lowongan Berdasarkan Status & Top Dilihat --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <h2 class="font-medium text-gray-800 mb-4">Lowongan Berdasarkan Status</h2>
            <div class="w-40 h-40 mx-auto">
                <canvas id="chartStatusDonut"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <h2 class="font-medium text-gray-800 mb-4">Top Lowongan Dilihat</h2>
            <div class="space-y-3">
                @foreach ($topLowongan as $i => $item)
                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 flex items-center justify-center rounded-full bg-gray-100 text-xs text-gray-500">{{ $i + 1 }}</span>
                            <div>
                                <p class="font-medium text-gray-800">{{ $item->posisi }}</p>
                                <p class="text-gray-400 text-xs">{{ $item->mitra->nama_perusahaan }}</p>
                            </div>
                        </div>
                        <span class="text-gray-500 text-xs">{{ $item->jumlah_kunjungan }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>
    <script>
        new Chart(document.getElementById('chartAlumniDonut'), {
            type: 'doughnut',
            data: {
                labels: ['Bekerja', 'Belum Bekerja'],
                datasets: [{ data: [{{ $alumniBekerja }}, {{ $alumniBelumBekerja }}], backgroundColor: ['#2563eb', '#dbeafe'] }]
            },
            options: { plugins: { legend: { display: false } }, cutout: '70%' }
        });

        new Chart(document.getElementById('chartStatusDonut'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_map('ucfirst', array_keys($lowonganByStatus->toArray()))) !!},
                datasets: [{
                    data: {!! json_encode(array_values($lowonganByStatus->toArray())) !!},
                    backgroundColor: ['#16a34a', '#f59e0b', '#dc2626', '#9ca3af']
                }]
            },
            options: { cutout: '65%' }
        });
    </script>
    @endpush
</x-layouts.admin>
