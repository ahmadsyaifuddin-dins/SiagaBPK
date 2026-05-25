<x-app-layout>
    <div class="bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">
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
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Sistem pelaporan otomatis untuk
                            keperluan operasional dan audit BPK.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                @include('reports.partials.card-item', [
                    'title' => 'Rekapitulasi Insiden',
                    'description' => 'Daftar seluruh laporan kejadian kebakaran bulanan.',
                    'icon' => 'fa-solid fa-fire',
                    'colorClass' => 'bg-orange-100 text-orange-600',
                    'route' => 'reports.cetak.insiden',
                    'hasFilter' => true,
                    'btnColor' => 'bg-red-600 hover:bg-red-700',
                ])

                @include('reports.partials.card-item', [
                    'title' => 'Statistik Kerugian',
                    'description' => 'Kalkulasi total taksiran kerugian materiil bulanan.',
                    'icon' => 'fa-solid fa-house-crack',
                    'colorClass' => 'bg-red-100 text-red-600',
                    'route' => 'reports.cetak.kerugian',
                    'hasFilter' => true,
                    'btnColor' => 'bg-red-600 hover:bg-red-700',
                ])

                @include('reports.partials.card-item', [
                    'title' => 'Kinerja Anggota',
                    'description' => 'Rekap keaktifan petugas berdasarkan frekuensi tugas.',
                    'icon' => 'fa-solid fa-medal',
                    'colorClass' => 'bg-blue-100 text-blue-600',
                    'route' => 'reports.cetak.kinerja',
                    'hasFilter' => true,
                    'btnColor' => 'bg-blue-600 hover:bg-blue-700',
                ])

                @include('reports.partials.card-item', [
                    'title' => 'Jadwal Piket',
                    'description' => 'Laporan kesiapsiagaan anggota piket di mako bulanan.',
                    'icon' => 'fa-solid fa-calendar-days',
                    'colorClass' => 'bg-emerald-100 text-emerald-600',
                    'route' => 'reports.cetak.jadwal',
                    'hasFilter' => true,
                    'btnColor' => 'bg-emerald-600 hover:bg-emerald-700',
                ])

                @include('reports.partials.card-item', [
                    'title' => 'Biaya Pemeliharaan',
                    'description' => 'Rekap pengeluaran servis & perbaikan armada bulanan.',
                    'icon' => 'fa-solid fa-wrench',
                    'colorClass' => 'bg-teal-100 text-teal-600',
                    'route' => 'reports.cetak.maintenance',
                    'hasFilter' => true,
                    'btnColor' => 'bg-teal-600 hover:bg-teal-700',
                ])

                @include('reports.partials.card-item', [
                    'title' => 'Dokumentasi Kegiatan',
                    'description' => 'Laporan daftar kegiatan sosialisasi dan pelatihan.',
                    'icon' => 'fa-solid fa-camera-retro',
                    'colorClass' => 'bg-pink-100 text-pink-600',
                    'route' => 'reports.cetak.kegiatan',
                    'hasFilter' => true,
                    'btnColor' => 'bg-pink-600 hover:bg-pink-700',
                ])

                @include('reports.partials.card-item', [
                    'title' => 'Data Aset & Armada',
                    'description' => 'Status kelayakan unit armada dan peralatan saat ini.',
                    'icon' => 'fa-solid fa-boxes-stacked',
                    'colorClass' => 'bg-purple-100 text-purple-600',
                    'route' => 'reports.cetak.inventaris',
                    'hasFilter' => false,
                    'btnColor' => 'bg-purple-600 hover:bg-purple-700',
                ])

                @include('reports.partials.card-item', [
                    'title' => 'Buku Kontak Anggota',
                    'description' => 'Daftar nomor HP dan golongan darah anggota aktif.',
                    'icon' => 'fa-solid fa-address-book',
                    'colorClass' => 'bg-indigo-100 text-indigo-600',
                    'route' => 'reports.cetak.kontak',
                    'hasFilter' => false,
                    'btnColor' => 'bg-indigo-600 hover:bg-indigo-700',
                ])

            </div>
        </div>
    </div>
</x-app-layout>
