<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SiagaBPK') }} - Portal Internal</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Cek preferensi tema sistem atau localStorage
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body
    class="antialiased font-sans bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col overflow-x-hidden selection:bg-red-500 selection:text-white">

    <nav class="absolute top-0 left-0 right-0 z-50 px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <x-application-logo class="block h-8 w-auto fill-current text-indigo-600 dark:text-indigo-400" />
            <span class="font-bold text-xl tracking-wider text-gray-800 dark:text-white">SiagaBPK KTC Fire</span>
        </div>

        <div>
            @if (Route::has('login'))
                <div class="flex gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="font-medium text-gray-600 hover:text-red-600 dark:text-gray-300 dark:hover:text-red-400 transition-colors">
                            Masuk ke Dashboard <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <main class="flex-1 flex flex-col items-center relative px-4 pb-12 w-full max-w-full">
        <div
            class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-red-500/20 dark:bg-red-600/10 blur-3xl rounded-full mix-blend-multiply dark:mix-blend-lighten pointer-events-none">
        </div>
        <div
            class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-orange-500/20 dark:bg-orange-600/10 blur-3xl rounded-full mix-blend-multiply dark:mix-blend-lighten pointer-events-none">
        </div>

        <div class="max-w-4xl w-full text-center z-10 pt-32 mt-auto mb-auto">
            <div
                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-sm font-semibold mb-6 border border-red-200 dark:border-red-800/50">
                <i class="fa-solid fa-shield-halved"></i> E-Fire Management System
            </div>

            <h1
                class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6 text-gray-900 dark:text-white leading-tight">
                Integrasi Pelaporan Insiden & <br class="hidden md:block">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-orange-500">Monitoring
                    Inventaris BPK</span>
            </h1>

            <p class="mt-4 text-lg md:text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-10 leading-relaxed">
                Portal internal khusus untuk personel Barisan Pemadam Kebakaran. Silakan masuk menggunakan kredensial
                yang telah diberikan oleh Administrator.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="w-full sm:w-auto px-8 py-3.5 text-base font-semibold text-white bg-gradient-to-r from-red-600 to-orange-500 hover:from-red-700 hover:to-orange-600 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                            Buka Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="w-full sm:w-auto px-8 py-3.5 text-base font-semibold text-white bg-gradient-to-r from-gray-800 to-gray-700 dark:from-gray-700 dark:to-gray-600 hover:from-gray-900 hover:to-gray-800 dark:hover:from-gray-600 dark:hover:to-gray-500 rounded-xl shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2 transform hover:-translate-y-0.5">
                            <i class="fa-solid fa-right-to-bracket"></i> Login Portal Internal
                        </a>
                    @endauth
                @endif
            </div>

            <div
                class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6 text-left border-t border-gray-200 dark:border-gray-800 pt-10">
                <div
                    class="bg-white/50 dark:bg-gray-800/50 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 backdrop-blur-sm">
                    <div
                        class="w-10 h-10 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-red-600 dark:text-red-400 mb-4">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Notifikasi Mobilisasi</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Peringatan otomatis untuk memanggil anggota saat
                        terjadi insiden darurat.</p>
                </div>

                <div
                    class="bg-white/50 dark:bg-gray-800/50 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 backdrop-blur-sm">
                    <div
                        class="w-10 h-10 rounded-lg bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-orange-600 dark:text-orange-400 mb-4">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Monitoring Inventaris</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Pencatatan QR Code, status alat, dan jadwal
                        pemeliharaan (Maintenance).</p>
                </div>

                <div
                    class="bg-white/50 dark:bg-gray-800/50 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 backdrop-blur-sm">
                    <div
                        class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 mb-4">
                        <i class="fa-solid fa-file-pdf"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Laporan Otomatis</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Pusat pencetakan dokumen PDF untuk keperluan
                        administrasi dan audit.</p>
                </div>
            </div>
        </div>
    </main>

    <footer
        class="w-full py-6 text-center text-sm text-gray-500 dark:text-gray-400 z-10 border-t border-gray-200 dark:border-gray-800 bg-white/50 dark:bg-gray-900/50 backdrop-blur-md">
        <p>&copy; {{ date('Y') }} Barisan Pemadam Kebakaran (BPK). All rights reserved.</p>
        <p class="mt-1 text-xs">Aplikasi dirancang khusus untuk manajemen internal BPK.</p>
    </footer>

</body>

</html>
