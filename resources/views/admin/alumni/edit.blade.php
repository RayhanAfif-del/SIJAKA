<x-layouts.admin title="Edit Alumni">

    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Edit Data Alumni</h1>
        <p class="text-sm text-gray-500">Perbarui data alumni.</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 max-w-lg">
        <form method="POST" action="{{ route('admin.alumni.update', $alumni) }}">
            @csrf @method('PUT')
            @include('admin.alumni._form')
        </form>
    </div>

</x-layouts.admin>
