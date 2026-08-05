<x-layouts.admin title="Edit Mitra">

    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Edit Data Mitra</h1>
        <p class="text-sm text-gray-500">Perbarui informasi akun perusahaan mitra.</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 max-w-xl">
        <form method="POST" action="{{ route('admin.mitra.update', $mitra) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.mitra._form')
        </form>
    </div>

</x-layouts.admin>
