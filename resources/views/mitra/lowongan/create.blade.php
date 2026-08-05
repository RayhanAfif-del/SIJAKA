<x-layouts.mitra title="Tambah Lowongan">

    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Tambah Lowongan</h1>
        <p class="text-sm text-gray-500">Lowongan yang Anda buat akan menunggu persetujuan admin sebelum tampil di website.</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 max-w-2xl">
        <form method="POST" action="{{ route('mitra.lowongan.store') }}">
            @csrf
            @include('mitra.lowongan._form')
        </form>
    </div>

</x-layouts.mitra>
