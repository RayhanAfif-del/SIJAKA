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
@php $alumniTotalDashboard = $alumniBekerja + $alumniMelanjutkanStudi + $alumniBelumBekerja; @endphp
            @if ($alumniTotalDashboard > 0)
                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <div class="w-40 h-40 shrink-0">
                        <canvas id="chartAlumniDonut"></canvas>
                    </div>
                    <div class="space-y-2 text-sm">
                        <p class="text-gray-500">Bekerja</p>
                        <p class="text-2xl font-semibold text-blue-600">{{ $alumniBekerja }}</p>
                        <p class="text-gray-500 pt-2">Melanjutkan Studi</p>
                        <p class="text-2xl font-semibold text-amber-500">{{ $alumniMelanjutkanStudi }}</p>
                        <p class="text-gray-500 pt-2">Belum Bekerja</p>
                        <p class="text-2xl font-semibold text-gray-400">{{ $alumniBelumBekerja }}</p>
                    </div>
                </div>
            @else
                <div class="flex flex-col items-center justify-center text-center py-8">
                    <svg class="w-12 h-12 text-gray-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 1a3 3 0 10-3-3 3 3 0 003 3z"/></svg>
                    <p class="text-sm text-gray-400">Belum ada data alumni untuk ditampilkan.</p>
                </div>
            @endif
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
            @if ($lowonganMenunggu->isNotEmpty())
                <a href="{{ route('admin.lowongan.index', ['status' => 'menunggu']) }}" class="block text-center text-sm text-blue-600 mt-4 hover:underline">
                    Lihat semua &rarr;
                </a>
            @endif
        </div>
    </div>

{{-- Lowongan Berdasarkan Status & Top Dilihat --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <h2 class="font-medium text-gray-800 mb-4">Lowongan Berdasarkan Status</h2>
            @if ($lowonganByStatus->isNotEmpty())
                <div class="w-40 h-40 mx-auto">
                    <canvas id="chartStatusDonut"></canvas>
                </div>
            @else
                <div class="flex flex-col items-center justify-center text-center py-8">
                    <svg class="w-12 h-12 text-gray-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"/></svg>
                    <p class="text-sm text-gray-400">Belum ada data lowongan.</p>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <h2 class="font-medium text-gray-800 mb-4">Top Lowongan Dilihat</h2>
            @if ($topLowongan->isNotEmpty())
                <div class="space-y-3">
                    @foreach ($topLowongan as $i => $item)
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-3">
                                <span class="w-6 h-6 flex items-center justify-center rounded-full {{ $i < 3 ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-500' }} text-xs font-medium">{{ $i + 1 }}</span>
                                <div>
                                    <p class="font-medium text-gray-800">{{ $item->posisi }}</p>
                                    <p class="text-gray-400 text-xs">{{ $item->mitra->nama_perusahaan }}</p>
                                </div>
                            </div>
                            <span class="flex items-center gap-1 text-gray-500 text-xs">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                {{ $item->jumlah_kunjungan }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-400 text-center py-8">Belum ada lowongan untuk ditampilkan.</p>
            @endif
        </div>
    </div>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>
    <script>
const alumniEl = document.getElementById('chartAlumniDonut');
        const alumniTotal = {{ $alumniBekerja }} + {{ $alumniMelanjutkanStudi }} + {{ $alumniBelumBekerja }};
        if (alumniEl && alumniTotal > 0) {
            new Chart(alumniEl, {
                type: 'doughnut',
                data: {
                    labels: ['Bekerja', 'Melanjutkan Studi', 'Belum Bekerja'],
                    datasets: [{ data: [{{ $alumniBekerja }}, {{ $alumniMelanjutkanStudi }}, {{ $alumniBelumBekerja }}], backgroundColor: ['#2563eb', '#f59e0b', '#dbeafe'] }]
                },
                options: { plugins: { legend: { display: false } }, cutout: '70%' }
            });
        }

        const statusEl = document.getElementById('chartStatusDonut');
        @if ($lowonganByStatus->isNotEmpty())
        if (statusEl) {
            new Chart(statusEl, {
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
        }
        @endif
    </script>
    @endpush
</x-layouts.admin>
