@props([
    'title',
    'description',
    'icon',
    'colorClass',
    'route',
    'hasFilter' => false,
    'tahunList' => null,
    'btnColor' => 'bg-red-600 hover:bg-red-700',
])

<div
    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-all group flex flex-col h-full">
    <div
        class="w-12 h-12 {{ $colorClass }} rounded-xl flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
        <i class="{{ $icon }}"></i>
    </div>
    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">{{ $title }}</h3>
    <p class="text-xs text-gray-500 dark:text-gray-400 mb-4 flex-grow">{{ $description }}</p>

    @if ($hasFilter)
        <form action="{{ route($route) }}" method="GET" target="_blank" class="space-y-3">
            <div class="grid grid-cols-2 gap-2">
                <select name="bulan" required
                    class="text-[10px] py-1.5 rounded-lg border-gray-200 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 focus:ring-blue-500">
                    @foreach (range(1, 12) as $m)
                        <option value="{{ $m }}" {{ date('n') == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                    @endforeach
                </select>
                <select name="tahun" required
                    class="text-[10px] py-1.5 rounded-lg border-gray-200 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 focus:ring-blue-500">
                    @foreach ($tahunList as $thn)
                        <option value="{{ $thn }}">{{ $thn }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit"
                class="w-full py-2 {{ $btnColor }} text-white rounded-xl font-bold shadow-md transition-all text-xs">
                <i class="fa-solid fa-print mr-1"></i> Cetak Laporan
            </button>
        </form>
    @else
        <a href="{{ route($route) }}" target="_blank"
            class="w-full inline-block text-center py-2.5 {{ $btnColor }} text-white rounded-xl font-semibold shadow-md transition-colors text-sm">
            <i class="fa-solid fa-print mr-1"></i> Cetak Semua
        </a>
    @endif
</div>
