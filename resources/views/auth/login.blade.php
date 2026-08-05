<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-blue-50 px-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

            <div class="flex flex-col items-center mb-6">
                <div class="w-14 h-14 rounded-full bg-blue-600 flex items-center justify-center mb-3">
                    <span class="text-white font-bold text-lg">SI</span>
                </div>
                <h1 class="text-xl font-semibold text-gray-800">Masuk ke SIJAKA</h1>
                <p class="text-sm text-gray-500">Sistem Informasi Jejaring Karier</p>
            </div>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="mb-4 text-sm font-medium text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" x-data="{ role: 'admin' }">
                @csrf
                <input type="hidden" name="role" x-model="role">

                {{-- Tab Role Selector --}}
                <div class="grid grid-cols-2 gap-2 bg-gray-100 p-1 rounded-lg mb-6">
                    <button type="button"
                        @click="role = 'admin'"
                        :class="role === 'admin' ? 'bg-blue-600 text-white' : 'text-gray-600'"
                        class="py-2 rounded-md text-sm font-medium transition">
                        Admin
                    </button>
                    <button type="button"
                        @click="role = 'mitra'"
                        :class="role === 'mitra' ? 'bg-blue-600 text-white' : 'text-gray-600'"
                        class="py-2 rounded-md text-sm font-medium transition">
                        Mitra
                    </button>
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                        placeholder="nama@perusahaan.com">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Lupa password?</a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember --}}
                <div class="flex items-center mb-6">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="remember_me" class="ml-2 text-sm text-gray-600">Ingat saya</label>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition">
                    Masuk
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-blue-600">
                    &larr; Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
