<x-app-layout>
    <div class="py-8 bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div
                class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="flex items-center gap-4">
                    <div
                        class="w-14 h-14 bg-red-100 dark:bg-red-900/30 rounded-2xl flex items-center justify-center border border-red-200 dark:border-red-800 shrink-0">
                        <i class="fa-solid fa-file-pdf text-2xl text-red-600 dark:text-red-400"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Pusat Laporan Terpadu</h1>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Cetak rekapitulasi data operasional,
                            aset, dan personel BPK secara resmi.</p>
                    </div>
                </div>
                <div
                    class="hidden lg:flex items-center gap-2 text-sm text-gray-500 bg-gray-50 dark:bg-gray-900 px-4 py-2 rounded-xl">
                    <i class="fa-solid fa-circle-info text-blue-500"></i> Dokumen di-generate dalam format PDF ber-Kop
                    Surat.
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-all group flex flex-col h-full">
                    <div
                        class="w-12 h-12 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-fire"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Rekapitulasi Insiden</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6 flex-grow">Daftar seluruh laporan kejadian
                        kebakaran beserta lokasi dan status penanganannya.</p>
                    <a href="{{ route('reports.cetak.insiden') }}" target="_blank"
                        class="w-full inline-block text-center py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl font-semibold shadow-md transition-colors text-sm">
                        <i class="fa-solid fa-print mr-1"></i> Cetak Laporan
                    </a>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-all group flex flex-col h-full">
                    <div
                        class="w-12 h-12 bg-red-100 text-red-600 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-house-crack"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Statistik Kerugian</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6 flex-grow">Kalkulasi total taksiran kerugian
                        materiil dan jumlah korban jiwa per periode tahunan.</p>
                    <a href="{{ route('reports.cetak.kerugian') }}" target="_blank"
                        class="w-full inline-block text-center py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl font-semibold shadow-md transition-colors text-sm">
                        <i class="fa-solid fa-print mr-1"></i> Cetak Laporan
                    </a>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-all group flex flex-col h-full">
                    <div
                        class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-medal"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Kinerja Anggota</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6 flex-grow">Rekapitulasi keaktifan relawan
                        berdasarkan jumlah frekuensi turun ke lokasi kejadian.</p>
                    <a href="{{ route('reports.cetak.kinerja') }}" target="_blank"
                        class="w-full inline-block text-center py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold shadow-md transition-colors text-sm">
                        <i class="fa-solid fa-print mr-1"></i> Cetak Laporan
                    </a>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-all group flex flex-col h-full">
                    <div
                        class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Jadwal Piket BPK</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6 flex-grow">Jadwal piket dan status
                        kesiapsiagaan anggota pemadam kebakaran di mako.</p>
                    <a href="{{ route('reports.cetak.jadwal') }}" target="_blank"
                        class="w-full inline-block text-center py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-semibold shadow-md transition-colors text-sm">
                        <i class="fa-solid fa-print mr-1"></i> Cetak Laporan
                    </a>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-all group flex flex-col h-full">
                    <div
                        class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Data Aset & Armada</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6 flex-grow">Status kelayakan unit armada dan
                        ketersediaan peralatan pemadam kebakaran.</p>
                    <a href="{{ route('reports.cetak.inventaris') }}" target="_blank"
                        class="w-full inline-block text-center py-2.5 bg-purple-600 hover:bg-purple-700 text-white rounded-xl font-semibold shadow-md transition-colors text-sm">
                        <i class="fa-solid fa-print mr-1"></i> Cetak Laporan
                    </a>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-all group flex flex-col h-full">
                    <div
                        class="w-12 h-12 bg-teal-100 text-teal-600 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-wrench"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Biaya Pemeliharaan</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6 flex-grow">Riwayat pengeluaran servis, ganti
                        oli, dan perbaikan seluruh armada.</p>
                    <a href="{{ route('reports.cetak.maintenance') }}" target="_blank"
                        class="w-full inline-block text-center py-2.5 bg-teal-600 hover:bg-teal-700 text-white rounded-xl font-semibold shadow-md transition-colors text-sm">
                        <i class="fa-solid fa-print mr-1"></i> Cetak Laporan
                    </a>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-all group flex flex-col h-full">
                    <div
                        class="w-12 h-12 bg-pink-100 text-pink-600 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-camera-retro"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Dokumentasi Operasional</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6 flex-grow">Laporan daftar kegiatan
                        sosialisasi, pelatihan gabungan, dan rutinitas lainnya.</p>
                    <a href="{{ route('reports.cetak.kegiatan') }}" target="_blank"
                        class="w-full inline-block text-center py-2.5 bg-pink-600 hover:bg-pink-700 text-white rounded-xl font-semibold shadow-md transition-colors text-sm">
                        <i class="fa-solid fa-print mr-1"></i> Cetak Laporan
                    </a>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-all group flex flex-col h-full">
                    <div
                        class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-address-book"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Buku Kontak Anggota</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6 flex-grow">Daftar lengkap nomor HP dan
                        golongan darah seluruh anggota aktif BPK.</p>
                    <a href="{{ route('reports.cetak.kontak') }}" target="_blank"
                        class="w-full inline-block text-center py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold shadow-md transition-colors text-sm">
                        <i class="fa-solid fa-print mr-1"></i> Cetak Laporan
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
