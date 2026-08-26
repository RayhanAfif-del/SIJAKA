<x-layouts.admin title="Edit Foto Galeri">

    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Edit Foto Galeri</h1>
        <p class="text-sm text-gray-500">Perbarui data dokumentasi kegiatan.</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('admin.galeri.update', $galeri) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.galeri._form')
        </form>
    </div>

</x-layouts.admin>
