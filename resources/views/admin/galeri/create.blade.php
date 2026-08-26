<x-layouts.admin title="Tambah Foto Galeri">

    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Tambah Foto Galeri</h1>
        <p class="text-sm text-gray-500">Unggah dokumentasi kegiatan baru.</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.galeri._form')
        </form>
    </div>

</x-layouts.admin>
