<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h2 class="font-bold text-2xl text-gray-900 dark:text-gray-100 leading-tight flex items-center">
                <div class="bg-blue-100 dark:bg-blue-900/30 p-2.5 rounded-xl mr-3">
                    <i
                        class="fa-solid fa-chart-pie text-blue-600 dark:text-blue-400 text-xl w-6 h-6 flex items-center justify-center"></i>
                </div>
                {{ __('Dashboard SiagaBPK') }}
            </h2>

            <div
                class="flex items-center space-x-2 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 px-4 py-2.5 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <i class="fa-regular fa-clock text-blue-500 animate-pulse"></i>
                <span>{{ now()->translatedFormat('l, d M Y | H:i') }} WITA</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-8">

                @include('dashboard.partials.stats')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-2">
                        @include('dashboard.partials.recent-incidents')
                    </div>

                    <div class="space-y-6">
                        @include('dashboard.partials.quick-actions')
                        @include('dashboard.partials.system-status')
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
