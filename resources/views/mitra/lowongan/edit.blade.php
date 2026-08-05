<x-layouts.mitra title="Edit Lowongan">

    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Edit Lowongan</h1>
        <p class="text-sm text-gray-500">Perbarui informasi lowongan Anda.</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 max-w-2xl">
        <form method="POST" action="{{ route('mitra.lowongan.update', $lowongan) }}">
            @csrf @method('PUT')
            @include('mitra.lowongan._form')
        </form>
    </div>

</x-layouts.mitra>
