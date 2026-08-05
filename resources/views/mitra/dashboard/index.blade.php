<x-layouts.mitra title="Dashboard Mitra">

    <h1 class="text-xl font-semibold text-gray-800">Dashboard Mitra</h1>
    <p class="text-sm text-gray-500 mb-6">Selamat datang kembali, {{ auth('mitra')->user()->nama_perusahaan }}!</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <x-admin.stat-card label="Total Lowongan" :value="$totalLowongan" color="blue" />
        <x-admin.stat-card label="Menunggu Persetujuan" :value="$menunggu" color="amber" />
        <x-admin.stat-card label="Disetujui" :value="$disetujui" color="green" />
        <x-admin.stat-card label="Ditolak" :value="$ditolak" color="purple" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <h2 class="font-medium text-gray-800 mb-4">Grafik Lowongan Saya (7 Hari Terakhir)</h2>
            <canvas id="chartLowongan" height="90"></canvas>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-medium text-gray-800">Lowongan Terbaru</h2>
                <a href="{{ route('mitra.lowongan.index') }}" class="text-xs text-blue-600 hover:underline">Lihat Semua</a>
            </div>
            <div class="space-y-3">
                @forelse ($lowonganTerbaru as $item)
                    <div class="flex items-center justify-between text-sm">
                        <div>
                            <p class="font-medium text-gray-800">{{ $item->posisi }}</p>
                            <p class="text-gray-400 text-xs">{{ $item->created_at->translatedFormat('d M Y') }}</p>
                        </div>
                        @php
                            $badge = match($item->status) {
                                'disetujui' => 'bg-green-100 text-green-700',
                                'ditolak' => 'bg-red-100 text-red-700',
                                default => 'bg-amber-100 text-amber-700',
                            };
                        @endphp
                        <span class="text-xs px-2 py-0.5 rounded-full {{ $badge }}">{{ ucfirst($item->status) }}</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-400">Belum ada lowongan.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="mt-6 bg-blue-50 border border-blue-100 rounded-xl p-5 flex items-center justify-between">
        <div>
            <p class="font-medium text-gray-800">Perlu bantuan?</p>
            <p class="text-sm text-gray-500">Hubungi tim BKK SMK N 1 Bangsri jika memerlukan bantuan terkait lowongan.</p>
        </div>
        <a href="{{ route('kontak.index') }}" class="text-sm bg-white border border-blue-200 text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-100">
            Hubungi BKK
        </a>
    </div>

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>
    <script>
        new Chart(document.getElementById('chartLowongan'), {
            type: 'line',
            data: {
                labels: {!! json_encode($grafik->keys()) !!},
                datasets: [{
                    label: 'Lowongan Dibuat',
                    data: {!! json_encode($grafik->values()) !!},
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    fill: true,
                    tension: 0.3,
                }]
            },
            options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
        });
    </script>
    @endpush
</x-layouts.mitra>
