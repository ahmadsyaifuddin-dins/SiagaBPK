<x-guest-layout>
    <div class="mb-6 text-center border-b border-gray-200 dark:border-gray-700 pb-5">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-1">Selamat Datang</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Silakan masuk ke akun Anda</p>

        <div class="flex flex-wrap justify-center gap-2">
            <span
                class="px-2.5 py-1 text-xs font-semibold text-indigo-700 bg-indigo-100 border border-indigo-200 rounded-lg dark:bg-indigo-900/40 dark:text-indigo-300 dark:border-indigo-800/50">
                Admin Inventaris
            </span>
            <span
                class="px-2.5 py-1 text-xs font-semibold text-emerald-700 bg-emerald-100 border border-emerald-200 rounded-lg dark:bg-emerald-900/40 dark:text-emerald-300 dark:border-emerald-800/50">
                Petugas Lapangan
            </span>
            <span
                class="px-2.5 py-1 text-xs font-semibold text-amber-700 bg-amber-100 border border-amber-200 rounded-lg dark:bg-amber-900/40 dark:text-amber-300 dark:border-amber-800/50">
                Kepala BPK
            </span>
        </div>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input id="email" class="block mt-1 w-full bg-white dark:bg-gray-900" type="email"
                name="email" :value="old('email')" required autofocus autocomplete="username"
                placeholder="admin@gmail.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex justify-between items-center mt-1">
                <x-input-label for="password" :value="__('Kata Sandi')" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-medium text-red-600 hover:text-red-500 dark:text-red-400 dark:hover:text-red-300 transition-colors"
                        href="{{ route('password.request') }}">
                        Lupa Sandi?
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="block mt-1 w-full bg-white dark:bg-gray-900" type="password"
                name="password" required autocomplete="current-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500 dark:bg-gray-900 dark:border-gray-700 dark:checked:bg-red-500"
                    name="remember">
                <span
                    class="ms-2 text-sm text-gray-600 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-gray-200 transition-colors">{{ __('Ingat Saya') }}</span>
            </label>
        </div>

        <div>
            <button type="submit"
                class="w-full flex justify-center items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-red-600 to-orange-500 hover:from-red-700 hover:to-orange-600 border border-transparent rounded-xl font-semibold text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                <i class="fa-solid fa-right-to-bracket"></i> {{ __('Masuk Sistem') }}
            </button>
        </div>
    </form>
</x-guest-layout>
