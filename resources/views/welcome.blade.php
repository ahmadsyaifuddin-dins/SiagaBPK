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
    class="antialiased font-sans bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col selection:bg-red-500 selection:text-white"
    {{-- Kita inisialisasi state Alpine.js di body agar modal bisa diakses dari mana saja --}} x-data="{
        isModalOpen: false,
        modalImageSrc: '',
        modalImageAlt: '',
        openModal(src, alt) {
            this.modalImageSrc = src;
            this.modalImageAlt = alt;
            this.isModalOpen = true;
            document.body.classList.add('overflow-hidden'); // Mencegah scrolling background
        },
        closeModal() {
            this.isModalOpen = false;
            document.body.classList.remove('overflow-hidden');
        }
    }" {{-- Menutup modal dengan tombol ESC --}} @keydown.escape.window="closeModal()">

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

    <main class="flex-1 flex flex-col items-center justify-center relative overflow-x-hidden px-4 pb-20">
        <div
            class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-red-500/20 dark:bg-red-600/10 blur-3xl rounded-full mix-blend-multiply dark:mix-blend-lighten pointer-events-none overflow-hidden">
        </div>
        <div
            class="absolute bottom-[20%] right-[-10%] w-96 h-96 bg-orange-500/20 dark:bg-orange-600/10 blur-3xl rounded-full mix-blend-multiply dark:mix-blend-lighten pointer-events-none overflow-hidden">
        </div>

        <div class="max-w-4xl w-full text-center z-10 pt-32">
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
                class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6 text-left border-t border-gray-200 dark:border-gray-800 pt-10 overflow-hidden">
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

        <div class="mt-20 max-w-5xl w-full z-10 pb-10">
            <div
                class="bg-white/60 dark:bg-gray-800/60 rounded-3xl border border-gray-200 dark:border-gray-700 p-6 md:p-10 backdrop-blur-md shadow-xl flex flex-col md:flex-row items-center gap-10">
                <div class="flex-1 text-left">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 text-sm font-semibold mb-4 border border-indigo-200 dark:border-indigo-800/50">
                        <i class="fa-solid fa-location-dot"></i> Lokasi Penelitian
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">Markas BPK KTC Fire
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6">
                        Sistem SiagaBPK ini dikembangkan dan diimplementasikan secara langsung di posko Barisan Pemadam
                        Kebakaran KTC Fire Banjarmasin. Aplikasi ini diharapkan dapat menjadi pusat komando digital
                        untuk mengoptimalkan tanggap darurat personel.
                    </p>
                    <div
                        class="flex items-center gap-3 text-xs text-gray-500 dark:text-gray-500 italic bg-gray-100 dark:bg-gray-800 p-3 rounded-lg border border-gray-200 dark:border-gray-700">
                        <i class="fa-solid fa-magnifying-glass-plus text-indigo-500 text-lg"></i>
                        <p>Hover gambar untuk interaksi, dan **klik** pada gambar manapun untuk memperbesar (Full
                            Screen).</p>
                    </div>
                </div>

                <div class="flex-1 w-full relative group h-[300px] md:h-[350px] flex items-center justify-center">

                    <div
                        class="absolute inset-0 bg-gradient-to-r from-red-500/30 to-orange-500/30 blur-2xl rounded-full scale-50 opacity-0 group-hover:opacity-100 group-hover:scale-110 transition-all duration-700 pointer-events-none">
                    </div>

                    {{-- Helper class untuk semua gambar: cursor-pointer, transition, shadow --}}
                    @php $imgClass = "absolute rounded-2xl shadow-xl object-cover border-4 border-white dark:border-gray-700 aspect-[4/3] cursor-pointer transition-all duration-500 ease-out transform hover:scale-125 hover:z-30 hover:shadow-2xl"; @endphp

                    <img src="{{ asset('tempat/bpk-fire-1.jpg') }}" alt="Posko BPK KTC Tampak Depan"
                        class="{{ $imgClass }} z-0 w-4/5 scale-90 opacity-0 group-hover:opacity-100 group-hover:-translate-x-20 group-hover:-translate-y-20 group-hover:rotate-[-8deg]"
                        {{-- Event Klik Alpine --}} @click="openModal($el.src, $el.alt)">

                    <img src="{{ asset('tempat/bpk-fire-2.jpg') }}" alt="Aktivitas Personel di Posko"
                        class="{{ $imgClass }} z-0 w-4/5 scale-90 opacity-0 group-hover:opacity-100 group-hover:translate-x-20 group-hover:translate-y-20 group-hover:rotate-[8deg]"
                        {{-- Event Klik Alpine --}} @click="openModal($el.src, $el.alt)">

                    <img src="{{ asset('tempat/bpk-fire-3.jpg') }}" alt="Armada BPK KTC Fire Banjarmasin"
                        class="{{ $imgClass }} relative z-10 w-4/5 group-hover:scale-105 group-hover:border-indigo-500 dark:group-hover:border-indigo-400"
                        {{-- Event Klik Alpine --}} @click="openModal($el.src, $el.alt)">

                </div>
            </div>
        </div>
    </main>

    <footer
        class="py-6 text-center text-sm text-gray-500 dark:text-gray-400 z-10 border-t border-gray-200 dark:border-gray-800 bg-white/50 dark:bg-gray-900/50 backdrop-blur-md">
        <p>&copy; {{ date('Y') }} Barisan Pemadam Kebakaran (BPK). All rights reserved.</p>
        <p class="mt-1 text-xs">Aplikasi dirancang khusus untuk manajemen internal BPK.</p>
    </footer>

    <div class="fixed inset-0 z-[100] flex items-center justify-center overflow-hidden bg-gray-900/90 backdrop-blur-sm p-4 md:p-10"
        x-show="isModalOpen" {{-- Transition untuk efek memudar (fade) --}} x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" {{-- Klik di area hitam (overlay) untuk menutup --}} @click.self="closeModal()" style="display: none;"
        {{-- Mencegah flicker saat load --}}>
        <button class="absolute top-5 right-5 text-white/70 hover:text-white text-4xl z-[110] transition-colors"
            @click="closeModal()" title="Tutup (Esc)">
            <i class="fa-solid fa-circle-xmark"></i>
        </button>

        <div class="relative max-w-7xl max-h-full" {{-- Transition untuk gambar membesar (scale) saat muncul --}} x-show="isModalOpen"
            x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="scale-90"
            x-transition:enter-end="scale-100">
            <img :src="modalImageSrc" :alt="modalImageAlt"
                class="rounded-xl shadow-2xl border-4 border-white dark:border-gray-700 max-h-[90vh] w-auto object-contain">
            <div
                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4 rounded-b-xl">
                <p class="text-white text-center font-medium" x-text="modalImageAlt"></p>
            </div>
        </div>
    </div>

</body>

</html>
