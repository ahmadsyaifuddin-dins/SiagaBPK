<x-app-layout>
    <div class="py-8 bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ activeTab: 'inventaris' }">

            <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                        <i
                            class="fa-solid fa-boxes-stacked text-white text-xl w-6 h-6 flex items-center justify-center"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                            Inventaris & Maintenance
                        </h1>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">Kelola data aset, QR Code, dan jadwal
                            pemeliharaan.</p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('inventaris.create') }}"
                        class="group relative inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <i class="fa-solid fa-plus group-hover:rotate-90 transition-transform duration-200"></i>
                        Tambah Aset
                    </a>
                </div>
            </div>

            <div class="flex space-x-4 mb-6 border-b border-gray-200 dark:border-gray-700">
                <button @click="activeTab = 'inventaris'"
                    :class="{ 'border-blue-500 text-blue-600 dark:text-blue-400': activeTab === 'inventaris', 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'inventaris' }"
                    class="py-3 px-4 border-b-2 font-semibold text-sm transition-colors duration-200 flex items-center gap-2">
                    <i class="fa-solid fa-list"></i> Daftar Inventaris
                </button>
                <button @click="activeTab = 'maintenance'; $dispatch('tab-changed', 'maintenance')"
                    :class="{ 'border-blue-500 text-blue-600 dark:text-blue-400': activeTab === 'maintenance', 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'maintenance' }"
                    class="py-3 px-4 border-b-2 font-semibold text-sm transition-colors duration-200 flex items-center gap-2">
                    <i class="fa-solid fa-calendar-days"></i> Kalender Maintenance
                </button>
            </div>

            <div x-show="activeTab === 'inventaris'"
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden"
                x-transition>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 dark:bg-gray-900/50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                    Barang & QR</th>
                                <th
                                    class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                    Stok</th>
                                <th
                                    class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                    Kondisi / Status</th>
                                <th
                                    class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($data as $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-12 h-12 rounded-lg bg-white p-1 border border-gray-200 shadow-sm flex items-center justify-center shrink-0">
                                                @if ($item->qr_code)
                                                    <img src="{{ asset($item->qr_code) }}" alt="QR"
                                                        class="w-full h-full object-contain">
                                                @else
                                                    <i class="fa-solid fa-qrcode text-gray-300 text-xl"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-gray-900 dark:text-gray-100">
                                                    {{ $item->nama_barang }}</div>
                                                <div class="flex items-center gap-2 mt-0.5">
                                                    <span
                                                        class="text-xs text-gray-500 dark:text-gray-400 font-mono bg-gray-100 dark:bg-gray-700 px-1.5 py-0.5 rounded">{{ $item->kode_barang }}</span>
                                                    <span class="text-xs text-gray-400">• {{ $item->kategori }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-900 dark:text-gray-100">
                                            {{ $item->jumlah }} Unit</div>
                                        @if ($item->jumlah <= $item->stok_minimum)
                                            <div class="text-xs text-red-600 dark:text-red-400 mt-1 font-medium"><i
                                                    class="fa-solid fa-arrow-trend-down"></i> Stok Menipis</div>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $kondisiClass = match ($item->kondisi) {
                                                'Baik'
                                                    => 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-400 border border-green-200 dark:border-green-800',
                                                'Rusak Ringan'
                                                    => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800',
                                                'Rusak Berat'
                                                    => 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400 border border-red-200 dark:border-red-800',
                                                default => 'bg-gray-100 text-gray-700',
                                            };
                                        @endphp
                                        <div class="flex flex-col gap-1 items-start">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold shadow-sm {{ $kondisiClass }}">
                                                {{ $item->kondisi }}
                                            </span>

                                            @if ($item->tanggal_kadaluarsa && \Carbon\Carbon::parse($item->tanggal_kadaluarsa) <= now()->addDays(30))
                                                <span class="text-xs text-red-600 dark:text-red-400 font-semibold mt-1">
                                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                                    {{ \Carbon\Carbon::parse($item->tanggal_kadaluarsa) < now() ? 'Expired!' : 'Hampir Expired' }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('inventaris.edit', $item->id) }}"
                                                class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-150">
                                                <i class="fa-solid fa-pen-to-square"></i> Edit
                                            </a>
                                            <a href="{{ route('inventaris.show', $item->id) }}"
                                                class="inline-flex items-center gap-1 text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 transition-colors duration-150">
                                                <i class="fa-solid fa-eye"></i> Detail
                                            </a>

                                            <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST"
                                                class="inline"
                                                onsubmit="confirmDelete(event, this, 'Yakin ingin menghapus aset ini secara permanen?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1 text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-150">
                                                    <i class="fa-solid fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div
                                                class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                                <i
                                                    class="fa-solid fa-box-open text-4xl text-gray-400 dark:text-gray-500"></i>
                                            </div>
                                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Belum
                                                ada data inventaris</h3>
                                            <p class="text-gray-500 dark:text-gray-400 mb-6">Mulai catat armada dan
                                                peralatan pemadam kebakaran.</p>
                                            <a href="{{ route('inventaris.create') }}"
                                                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-150">
                                                <i class="fa-solid fa-plus"></i> Tambah Aset Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div x-show="activeTab === 'maintenance'"
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-6"
                x-transition style="display: none;">

                <div
                    class="mb-6 flex flex-wrap gap-4 items-center justify-center md:justify-start text-xs font-semibold bg-gray-50 dark:bg-gray-700/50 p-3 rounded-lg border border-gray-200 dark:border-gray-700">
                    <span class="text-gray-500 uppercase tracking-wider mr-2">Legenda:</span>
                    <span class="flex items-center gap-1.5 text-gray-700 dark:text-gray-300"><span
                            class="w-3 h-3 rounded-full bg-blue-500"></span> Terjadwal</span>
                    <span class="flex items-center gap-1.5 text-gray-700 dark:text-gray-300"><span
                            class="w-3 h-3 rounded-full bg-yellow-500"></span> Proses</span>
                    <span class="flex items-center gap-1.5 text-gray-700 dark:text-gray-300"><span
                            class="w-3 h-3 rounded-full bg-green-500"></span> Selesai</span>
                    <span class="flex items-center gap-1.5 text-gray-700 dark:text-gray-300"><span
                            class="w-3 h-3 rounded-full bg-red-500"></span> Batal</span>
                </div>

                <div id="maintenance-calendar" class="min-h-[500px] text-gray-800 dark:text-gray-200"></div>

            </div>

        </div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('maintenance-calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id', // Bahasa Indonesia
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listWeek'
                },
                buttonText: {
                    today: 'Hari Ini',
                    month: 'Bulan',
                    list: 'Agenda'
                },
                // Ambil data JSON dari endpoint Controller
                events: '{{ route('maintenances.calendar.data') }}',

                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // Jangan langsung redirect
                    if (info.event.url) {
                        // Buka detail barang di tab baru agar kalender tidak tertutup
                        window.open(info.event.url, "_blank");
                    }
                }
            });

            // AlpineJS event listener: Render ulang kalender saat Tab diklik
            // Ini penting karena kalender JS sering error jika di-render di dalam div yang display:none
            window.addEventListener('tab-changed', function(e) {
                if (e.detail === 'maintenance') {
                    setTimeout(() => {
                        calendar.render();
                    }, 150);
                }
            });
        });
    </script>
</x-app-layout>
