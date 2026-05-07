<div
    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700 h-full flex flex-col">
    <div
        class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800/50">
        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
            <i class="fa-solid fa-triangle-exclamation text-orange-500"></i>
            Inventaris Kritis
        </h3>
        @if (isset($inventarisKritis) && $inventarisKritis->count() > 0)
            <span
                class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800/50 animate-pulse">
                {{ $inventarisKritis->count() }} Butuh Perhatian
            </span>
        @endif
    </div>

    <div class="p-0 flex-1 overflow-y-auto max-h-[400px]">
        @forelse($inventarisKritis ?? [] as $item)
            <div
                class="p-5 border-b border-gray-50 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors last:border-0 flex items-start sm:items-center justify-between flex-col sm:flex-row gap-4">

                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 shadow-sm {{ $item->kondisi == 'Rusak Berat' ? 'bg-red-50 text-red-600 dark:bg-red-900/20 dark:text-red-400 border border-red-100 dark:border-red-800' : 'bg-orange-50 text-orange-600 dark:bg-orange-900/20 dark:text-orange-400 border border-orange-100 dark:border-orange-800' }}">
                        @if ($item->kategori == 'Armada')
                            <i class="fa-solid fa-truck-fast text-lg"></i>
                        @elseif($item->kategori == 'Peralatan')
                            <i class="fa-solid fa-fire-extinguisher text-lg"></i>
                        @else
                            <i class="fa-solid fa-box text-lg"></i>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-900 dark:text-gray-100 line-clamp-1"
                            title="{{ $item->nama_barang }}">
                            {{ $item->nama_barang }}
                        </h4>
                        <div class="flex items-center gap-2 mt-1">
                            <span
                                class="text-xs text-gray-500 dark:text-gray-400 font-mono bg-gray-100 dark:bg-gray-700 px-1.5 py-0.5 rounded">{{ $item->kode_barang }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">• {{ $item->kategori }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 w-full sm:w-auto justify-between sm:justify-end shrink-0">
                    <span
                        class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold {{ $item->kondisi == 'Rusak Berat' ? 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-400' : 'bg-orange-100 text-orange-800 dark:bg-orange-900/50 dark:text-orange-400' }}">
                        <i class="fa-solid fa-wrench mr-1.5 opacity-70"></i> {{ $item->kondisi }}
                    </span>

                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('inventaris.show', $item->id) }}"
                            class="w-8 h-8 flex items-center justify-center rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-gray-500 hover:text-blue-600 hover:border-blue-300 dark:hover:text-blue-400 dark:hover:border-blue-500 transition-all shadow-sm hover:shadow"
                            title="Lihat Detail & Perbaiki">
                            <i class="fa-solid fa-arrow-right -rotate-45"></i>
                        </a>
                    @endif
                </div>

            </div>
        @empty
            <div class="p-10 text-center flex flex-col items-center justify-center h-full">
                <div
                    class="w-20 h-20 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-800/50 rounded-full flex items-center justify-center mb-4 shadow-sm">
                    <i class="fa-solid fa-shield-check text-3xl text-emerald-500 dark:text-emerald-400"></i>
                </div>
                <h4 class="text-gray-900 dark:text-gray-100 font-bold text-lg mb-1">Semua Inventaris Siap Pakai</h4>
                <p class="text-sm text-gray-500 dark:text-gray-400 max-w-[250px] mx-auto">Tidak ada armada atau
                    peralatan yang membutuhkan perbaikan saat ini.</p>
            </div>
        @endforelse
    </div>

    @if (auth()->user()->role === 'admin' && isset($inventarisKritis) && $inventarisKritis->count() > 0)
        <div
            class="p-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/80 text-center mt-auto">
            <a href="{{ route('inventaris.index') }}"
                class="text-sm font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors inline-flex items-center gap-1.5">
                Kelola Inventaris & Maintenance <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    @endif
</div>
