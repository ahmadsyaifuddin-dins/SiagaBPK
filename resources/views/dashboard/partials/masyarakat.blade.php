<div class="space-y-8">

    <div
        class="relative bg-gradient-to-br from-red-600 to-red-800 rounded-3xl p-8 md:p-12 shadow-2xl overflow-hidden text-center border-4 border-red-500/50">
        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white opacity-5 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-48 h-48 rounded-full bg-black opacity-10 blur-2xl"></div>

        <div class="relative z-10">
            <h2 class="text-white text-xl md:text-3xl font-bold mb-2">KEADAAN DARURAT KEBAKARAN?</h2>
            <p class="text-red-100 text-sm md:text-base mb-8 max-w-2xl mx-auto">Jangan panik! Segera hubungi nomor
                pemadam darurat di bawah ini. Petugas kami bersiaga 24 jam untuk membantu Anda.</p>

            <a href="tel:113" class="relative inline-flex group">
                <div
                    class="absolute transition-all duration-1000 opacity-70 -inset-px bg-gradient-to-r from-[#ff0000] via-[#ff4d4d] to-[#ff0000] rounded-full blur-lg group-hover:opacity-100 group-hover:-inset-1 group-hover:duration-200 animate-pulse">
                </div>

                <button
                    class="relative inline-flex items-center justify-center px-10 py-5 md:px-16 md:py-6 text-xl md:text-3xl font-bold text-red-600 bg-white rounded-full shadow-2xl transition-transform hover:scale-105 ring-4 ring-white/30">
                    <i class="fa-solid fa-phone-volume mr-4 animate-bounce"></i>
                    PANGGIL 113
                </button>
            </a>

            <div class="mt-8 text-red-200 text-xs md:text-sm font-medium flex items-center justify-center gap-2">
                <i class="fa-solid fa-circle-info"></i> Menekan tombol di atas akan langsung membuka panggilan di HP
                Anda.
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div
            class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow">
            <div
                class="w-14 h-14 bg-orange-100 dark:bg-orange-900/30 rounded-2xl flex items-center justify-center mb-4">
                <i class="fa-solid fa-file-pen text-2xl text-orange-600 dark:text-orange-400"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Formulir Laporan Insiden</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6 text-sm">Bantu petugas dengan mengirimkan lokasi akurat,
                foto kejadian, dan kronologi singkat melalui sistem kami.</p>

            <a href="{{ route('insidens.create') }}"
                class="inline-flex items-center justify-center w-full px-4 py-3 bg-gray-900 hover:bg-black dark:bg-gray-700 dark:hover:bg-gray-600 text-white rounded-xl font-semibold transition-colors duration-200">
                <i class="fa-solid fa-arrow-right mr-2"></i> Isi Formulir Laporan
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
            <div class="flex items-center gap-3 mb-6">
                <i class="fa-solid fa-shield-heart text-2xl text-green-500"></i>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Tips Keselamatan</h3>
            </div>

            <ul class="space-y-4">
                <li class="flex items-start">
                    <div
                        class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center mt-0.5">
                        <span class="text-green-600 font-bold text-xs">1</span>
                    </div>
                    <p class="ml-3 text-sm text-gray-600 dark:text-gray-400"><strong>Tetap Tenang:</strong> Jangan
                        panik. Selamatkan nyawa Anda dan keluarga terlebih dahulu, tinggalkan barang berharga.</p>
                </li>
                <li class="flex items-start">
                    <div
                        class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center mt-0.5">
                        <span class="text-green-600 font-bold text-xs">2</span>
                    </div>
                    <p class="ml-3 text-sm text-gray-600 dark:text-gray-400"><strong>Hindari Asap:</strong> Jika ruangan
                        penuh asap, merangkaklah di lantai karena udara bersih berada di bawah.</p>
                </li>
                <li class="flex items-start">
                    <div
                        class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center mt-0.5">
                        <span class="text-green-600 font-bold text-xs">3</span>
                    </div>
                    <p class="ml-3 text-sm text-gray-600 dark:text-gray-400"><strong>Hubungi BPK:</strong> Berikan
                        informasi lokasi yang jelas dan patokan yang mudah dikenali oleh petugas.</p>
                </li>
            </ul>
        </div>

    </div>
</div>
