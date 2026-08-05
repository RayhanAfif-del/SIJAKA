<x-layouts.admin title="Edit Artikel">

    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Edit Artikel</h1>
        <p class="text-sm text-gray-500">Perbarui isi artikel.</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 max-w-2xl">
        <form method="POST" action="{{ route('admin.artikel.update', $artikel) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.artikel._form')
        </form>
    </div>

</x-layouts.admin>
