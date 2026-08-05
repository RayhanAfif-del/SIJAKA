<x-layouts.admin title="Edit Struktur Organisasi">

    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Edit Data Struktur Organisasi</h1>
        <p class="text-sm text-gray-500">Perbarui data pengurus BKK.</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 max-w-xl">
        <form method="POST" action="{{ route('admin.struktur-organisasi.update', $strukturOrganisasi) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.struktur-organisasi._form')
        </form>
    </div>

</x-layouts.admin>
