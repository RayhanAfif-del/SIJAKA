<x-layouts.admin title="Tambah Mitra">

    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Tambah Akun Mitra</h1>
        <p class="text-sm text-gray-500">Buat akun baru untuk perusahaan mitra.</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('admin.mitra.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.mitra._form')
        </form>
    </div>

</x-layouts.admin>
