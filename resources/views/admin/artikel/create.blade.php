<x-layouts.admin title="Tulis Artikel">

    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Tulis Artikel Baru</h1>
        <p class="text-sm text-gray-500">Bagikan tips dan informasi seputar dunia kerja.</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 max-w-2xl">
        <form method="POST" action="{{ route('admin.artikel.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.artikel._form')
        </form>
    </div>

</x-layouts.admin>
