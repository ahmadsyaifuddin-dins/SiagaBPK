<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SiagaBP KTC FIRE') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Cek local storage atau preferensi sistem pengguna
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="font-sans antialiased">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100 dark:bg-gray-900 overflow-hidden">

        @include('layouts.navigation')

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white dark:bg-gray-800 shadow z-10 relative">
                <div class="flex items-center justify-between px-4 py-4 sm:px-6 lg:px-8">

                    <div class="flex items-center gap-4">
                        <button @click="sidebarOpen = true"
                            class="text-gray-500 focus:outline-none lg:hidden hover:text-gray-700 dark:hover:text-gray-300 transition">
                            <i class="fa-solid fa-bars text-xl"></i>
                        </button>

                        @isset($header)
                            <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                {{ $header }}
                            </div>
                        @endisset
                    </div>

                    <div class="flex items-center gap-4">

                        <button id="theme-toggle" type="button"
                            class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none rounded-full text-sm p-2.5 transition-colors duration-200"
                            title="Ganti Tema">
                            <i id="theme-toggle-light-icon" class="hidden fa-solid fa-sun text-yellow-500 text-lg"></i>
                            <i id="theme-toggle-dark-icon" class="hidden fa-solid fa-moon text-indigo-500 text-lg"></i>
                        </button>

                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center gap-2 p-1 border border-transparent text-sm leading-4 font-medium rounded-full sm:rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">

                                    @php
                                        $avatarColor = match (auth()->user()->role) {
                                            'admin' => 'bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-400',
                                            'relawan'
                                                => 'bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-400',
                                            default
                                                => 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-400',
                                        };
                                    @endphp
                                    <div
                                        class="h-8 w-8 rounded-full flex items-center justify-center font-bold border border-gray-100 dark:border-gray-700 {{ $avatarColor }}">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>

                                    <div class="hidden sm:block text-left">
                                        <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 leading-tight">
                                            {{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 leading-tight">
                                            {{ ucfirst(Auth::user()->role) }}</p>
                                    </div>

                                    <svg class="hidden sm:block fill-current h-4 w-4 ml-1"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    <i class="fa-solid fa-user-gear w-5 text-center mr-1 text-gray-400"></i>
                                    {{ __('Profile Settings') }}
                                </x-dropdown-link>

                                <div class="border-t border-gray-100 dark:border-gray-700 my-1"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30">
                                        <i class="fa-solid fa-right-from-bracket w-5 text-center mr-1"></i>
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>

                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 dark:bg-gray-900 p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>
    <x-sweetalert />

    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Ubah ikon saat pertama kali dimuat
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {
            // Putar-putar ikonnya
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // Jika sebelumnya di set light, ubah ke dark
            if (localStorage.getItem('theme') === 'light') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else if (localStorage.getItem('theme') === 'dark') { // Jika sebelumnya dark, ubah ke light
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                // Jika belum ada di local storage (ikut sistem), langsung paksa ke kebalikan sistem
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
            }
        });
    </script>
</body>

</html>
