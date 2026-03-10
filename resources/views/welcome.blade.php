<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SiagaBPK KTC FIRE') }} - Layanan Cepat Tanggap Darurat</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-gray-50 text-gray-900 selection:bg-red-500 selection:text-white"
    x-data="{ mobileMenuOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">

    <nav :class="{ 'bg-white/90 backdrop-blur-md shadow-md': scrolled, 'bg-transparent': !scrolled }"
        class="fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-red-600 to-orange-500 rounded-xl flex items-center justify-center shadow-lg shadow-red-500/30">
                        <i class="fa-solid fa-fire-flame-curved text-white text-xl"></i>
                    </div>
                    <span class="font-bold text-2xl tracking-tight text-gray-900">Siaga <span class="text-red-600">BPK
                            KTC FIRE</span></span>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda"
                        class="text-gray-700 hover:text-red-600 font-medium transition-colors">Beranda</a>
                    <a href="#layanan"
                        class="text-gray-700 hover:text-red-600 font-medium transition-colors">Layanan</a>
                    <a href="#kontak" class="text-gray-700 hover:text-red-600 font-medium transition-colors">Kontak</a>

                    <div class="h-6 w-px bg-gray-300"></div>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="bg-gray-900 hover:bg-gray-800 text-white px-5 py-2.5 rounded-full font-semibold transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                Masuk Dashboard <i class="fa-solid fa-arrow-right ml-2"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-gray-700 hover:text-red-600 font-bold transition-colors">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-full font-bold transition-all shadow-[0_0_15px_rgba(220,38,38,0.4)] hover:shadow-[0_0_25px_rgba(220,38,38,0.6)] transform hover:-translate-y-0.5">
                                    Daftar Sekarang
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>

                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="text-gray-600 hover:text-gray-900 focus:outline-none p-2">
                        <i class="fa-solid fa-bars text-2xl" x-show="!mobileMenuOpen"></i>
                        <i class="fa-solid fa-xmark text-2xl" x-show="mobileMenuOpen" style="display: none;"></i>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="mobileMenuOpen" x-transition
            class="md:hidden bg-white border-t border-gray-100 shadow-xl absolute w-full" style="display: none;">
            <div class="px-4 pt-2 pb-6 space-y-2">
                <a href="#beranda" @click="mobileMenuOpen = false"
                    class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-red-600 hover:bg-red-50">Beranda</a>
                <a href="#layanan" @click="mobileMenuOpen = false"
                    class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-red-600 hover:bg-red-50">Layanan</a>
                <a href="#kontak" @click="mobileMenuOpen = false"
                    class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-red-600 hover:bg-red-50">Kontak</a>

                <div class="border-t border-gray-200 my-4"></div>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="block w-full text-center bg-gray-900 text-white px-5 py-3 rounded-xl font-bold">Buka
                            Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="block w-full text-center px-5 py-3 rounded-xl font-bold text-gray-700 border-2 border-gray-200 hover:bg-gray-50 mb-3">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="block w-full text-center bg-red-600 text-white px-5 py-3 rounded-xl font-bold shadow-lg">Daftar
                                untuk Melapor</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <section id="beranda" class="relative pt-28 pb-20 lg:pt-32 lg:pb-28 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div
                class="absolute inset-0 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:16px_16px] opacity-50">
            </div>
            <div class="absolute right-0 top-0 -mr-48 -mt-48 w-96 h-96 rounded-full bg-red-500/10 blur-3xl"></div>
            <div class="absolute left-0 bottom-0 -ml-48 -mb-48 w-96 h-96 rounded-full bg-orange-500/10 blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-100 text-red-700 font-semibold text-sm mb-6 border border-red-200 shadow-sm">
                    <span class="relative flex h-3 w-3">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                    </span>
                    Bersiaga 24 Jam Non-Stop
                </div>

                <h1
                    class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-gray-900 tracking-tight mb-8 leading-tight">
                    Layanan Cepat Tanggap <br class="hidden md:block" />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-orange-500">Darurat
                        Kebakaran</span>
                </h1>

                <p class="text-lg md:text-xl text-gray-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Sistem informasi pelaporan dan penanganan insiden kebakaran terpadu. Laporkan kejadian di sekitar
                    Anda dengan cepat agar petugas kami dapat segera meluncur ke lokasi.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('register') }}"
                        class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-full font-bold text-lg transition-all shadow-[0_0_20px_rgba(220,38,38,0.4)] hover:shadow-[0_0_30px_rgba(220,38,38,0.6)] transform hover:-translate-y-1">
                        <i class="fa-solid fa-bullhorn"></i> Lapor Insiden Sekarang
                    </a>
                    <a href="tel:113"
                        class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-white hover:bg-gray-50 text-gray-900 border-2 border-gray-200 px-8 py-4 rounded-full font-bold text-lg transition-all hover:border-gray-300">
                        <i class="fa-solid fa-phone-volume text-red-600 animate-bounce"></i> Telepon Darurat 113
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="layanan" class="py-10 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-6">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Mengapa Menggunakan SiagaBPK KTC FIRE?
                </h2>
                <p class="text-gray-600 text-lg">Platform ini dirancang untuk mempermudah komunikasi antara masyarakat
                    dan petugas pemadam kebakaran demi meminimalisir kerugian.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div
                    class="bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:shadow-xl transition-shadow duration-300 group">
                    <div
                        class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <i class="fa-solid fa-stopwatch text-3xl text-red-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Laporan Real-Time</h3>
                    <p class="text-gray-600 leading-relaxed">Sistem pelaporan yang langsung terhubung dengan notifikasi
                        petugas piket, memastikan tidak ada waktu terbuang.</p>
                </div>

                <div
                    class="bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:shadow-xl transition-shadow duration-300 group">
                    <div
                        class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <i class="fa-solid fa-map-location-dot text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pemetaan Akurat</h3>
                    <p class="text-gray-600 leading-relaxed">Berikan detail lokasi dan patokan bangunan agar armada
                        pemadam dapat menemukan titik api dengan presisi tinggi.</p>
                </div>

                <div
                    class="bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:shadow-xl transition-shadow duration-300 group">
                    <div
                        class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <i class="fa-solid fa-shield-halved text-3xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Transparansi Penanganan</h3>
                    <p class="text-gray-600 leading-relaxed">Pantau terus status laporan Anda, dari "Berangkat", "Tiba
                        di TKP", hingga "Selesai" secara langsung melalui dashboard.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gradient-to-r from-gray-900 to-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="bg-red-600 rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between shadow-2xl relative overflow-hidden border border-red-500">
                <div
                    class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/diagonal-stripes.png')] opacity-10">
                </div>
                <div class="relative z-10 mb-6 md:mb-0 text-center md:text-left">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-2">Lihat Titik Api? Jangan Diam!</h2>
                    <p class="text-red-100 text-lg">Nyawa dan harta benda sangat berharga. Laporkan segera.</p>
                </div>
                <div class="relative z-10 flex gap-4">
                    <a href="{{ route('register') }}"
                        class="bg-white text-red-600 hover:bg-gray-100 px-8 py-4 rounded-xl font-bold text-lg transition-colors shadow-lg">
                        Buat Akun Pelapor
                    </a>
                </div>
            </div>
        </div>
    </section>

    <footer id="kontak" class="bg-white border-t border-gray-200 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-red-600 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-fire-flame-curved text-white text-xl"></i>
                        </div>
                        <span class="font-bold text-2xl text-gray-900">Siaga <span class="text-red-600">BPK KTC
                                FIRE</span></span>
                    </div>
                    <p class="text-gray-500 leading-relaxed mb-6">Aplikasi manajemen dan pelaporan insiden kebakaran
                        terpadu yang dirancang untuk mempermudah kerja sama antara masyarakat dan petugas lapangan.</p>
                </div>

                <div>
                    <h4 class="font-bold text-gray-900 mb-6 uppercase tracking-wider text-sm">Tautan Cepat</h4>
                    <ul class="space-y-4">
                        <li><a href="#beranda" class="text-gray-500 hover:text-red-600 transition-colors">Beranda</a>
                        </li>
                        <li><a href="#layanan" class="text-gray-500 hover:text-red-600 transition-colors">Layanan
                                Kami</a></li>
                        <li><a href="{{ route('login') }}"
                                class="text-gray-500 hover:text-red-600 transition-colors">Masuk Sistem</a></li>
                        <li><a href="{{ route('register') }}"
                                class="text-gray-500 hover:text-red-600 transition-colors">Daftar Akun</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-gray-900 mb-6 uppercase tracking-wider text-sm">Hubungi Kami</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start text-gray-500">
                            <i class="fa-solid fa-location-dot mt-1 mr-3 text-red-500"></i>
                            Jln. Malkon Temon Komp. Taman Citra RT 12 Banjarmasin Utara
                        </li>
                        <li class="flex items-center text-gray-500">
                            <i class="fa-solid fa-phone mr-3 text-red-500"></i>
                            (0511) 113-113
                        </li>
                        <li class="flex items-center text-gray-500">
                            <i class="fa-brands fa-whatsapp mr-3 text-green-500"></i>
                            +62 812-3456-7890
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-100 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-400 text-sm">
                    &copy; 2026-{{ date('Y') }} SiagaBPK KTC FIRE. Hak Cipta Dilindungi Undang-Undang.
                </p>
                <div class="flex gap-4">
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-red-50 hover:text-red-600 transition-colors">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-red-50 hover:text-red-600 transition-colors">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
