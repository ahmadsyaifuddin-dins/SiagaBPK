<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h2 class="font-bold text-2xl text-gray-900 dark:text-gray-100 leading-tight flex items-center">
                <div class="bg-gradient-to-br from-red-500 to-orange-500 text-white p-2.5 rounded-xl mr-3 shadow-md">
                    <i class="fa-solid fa-chart-pie text-xl w-6 h-6 flex items-center justify-center"></i>
                </div>
                {{ __('Dashboard E-Fire Management') }}
            </h2>

            <div
                class="flex items-center space-x-2 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 px-4 py-2.5 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <i class="fa-regular fa-clock text-blue-500 animate-pulse"></i>
                <span>{{ now()->translatedFormat('l, d M Y | H:i') }} WITA</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @include('dashboard.partials.stats')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    @include('dashboard.partials.recent-incidents')
                </div>

                <div>
                    @if (isset($totalNotif) && $totalNotif > 0)
                        <div
                            class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-2xl p-4 flex items-start gap-3 shadow-sm animate-pulse mb-6">
                            <div class="mt-0.5 text-red-500 dark:text-red-400">
                                <i class="fa-solid fa-triangle-exclamation text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-red-800 dark:text-red-400">Perhatian! Ada
                                    {{ $totalNotif }} Item Kritis</h4>
                                <p class="text-xs text-red-600 dark:text-red-300 mt-1 leading-relaxed">
                                    @if ($stokMenipisCount > 0)
                                        <b>{{ $stokMenipisCount }} item</b> stok menipis.<br>
                                    @endif
                                    @if ($kadaluarsaCount > 0)
                                        <b>{{ $kadaluarsaCount }} item</b> mendekati kadaluarsa.
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endif

                    @include('dashboard.partials.inventaris-kritis')
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    @include('dashboard.partials.quick-actions')
                </div>

                <div>
                    @include('dashboard.partials.system-status')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
