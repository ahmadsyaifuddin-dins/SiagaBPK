<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SiagaBPK E-Fire') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="font-sans antialiased text-gray-900 dark:text-gray-100 relative">

    <div class="fixed inset-0 z-0 pointer-events-none">
        <img src="{{ asset('tempat/bpk-fire-3.jpg') }}" alt="Background Posko"
            class="w-full h-full object-cover opacity-80 dark:opacity-60 scale-105">

        <div class="absolute inset-0 dark:bg-gray-900/60 backdrop-blur-xs"></div>
    </div>

    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-transparent relative z-10 overflow-hidden">

        @include('layouts.navigation')

        <div class="flex-1 flex flex-col overflow-hidden relative">

            @include('layouts.partials.topbar')

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-transparent p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>

        </div>
    </div>

    <x-sweetalert />

    @include('layouts.partials.theme-script')
</body>

</html>
