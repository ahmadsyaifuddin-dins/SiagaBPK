<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SiagaBPK') }} - Login</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

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

<body class="font-sans text-gray-900 antialiased selection:bg-red-500 selection:text-white">
    <div class="min-h-screen flex bg-gray-50 dark:bg-gray-900">

        <div class="hidden lg:flex lg:w-1/2 xl:w-3/5 relative items-center justify-center overflow-hidden">
            <img src="{{ asset('tempat/bpk-fire-3.jpg') }}" alt="Background Posko BPK"
                class="absolute inset-0 w-full h-full object-cover">

            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 to-gray-900/40 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-red-900/20 mix-blend-color"></div>

            <div class="relative z-10 text-left px-12 xl:px-20 w-full">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-500/20 text-red-300 text-sm font-semibold mb-6 border border-red-500/30 backdrop-blur-sm">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 2L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-3zM12 11.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-2.33v8.02z" />
                    </svg>
                    Secure Access
                </div>
                <h1 class="text-4xl xl:text-5xl font-bold text-white mb-4 leading-tight">
                    Pusat Komando <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-orange-400">SiagaBPK KTC
                        Fire</span>
                </h1>
                <p class="text-gray-300 text-lg max-w-md leading-relaxed">
                    Sistem Informasi Manajemen Inventaris & Mobilisasi Personel Barisan Pemadam Kebakaran terintegrasi.
                </p>
            </div>
        </div>

        <div
            class="w-full lg:w-1/2 xl:w-2/5 flex flex-col justify-center items-center p-6 sm:p-12 bg-white dark:bg-gray-900 relative shadow-2xl z-10">
            <div class="w-full max-w-md">
                <div class="flex justify-center mb-8">
                    <a href="/" class="flex items-center gap-3 group">
                        <x-application-logo
                            class="w-12 h-12 fill-current text-red-600 dark:text-red-500 group-hover:scale-110 transition-transform" />
                        <span class="text-2xl font-extrabold text-gray-900 dark:text-white tracking-tight">Siaga<span
                                class="text-red-600">BPK</span></span>
                    </a>
                </div>

                <div
                    class="bg-gray-50/50 dark:bg-gray-800/50 p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm backdrop-blur-sm">
                    {{ $slot }}
                </div>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        &copy; {{ date('Y') }} BPK KTC Fire. All rights reserved.
                    </p>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
