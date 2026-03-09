<div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 z-20 bg-black/50 lg:hidden" @click="sidebarOpen = false"
    style="display: none;"></div>

<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-30 w-64 bg-white dark:bg-gray-800 border-r border-gray-100 dark:border-gray-700 transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto flex flex-col shadow-lg lg:shadow-none">

    <div class="flex items-center justify-center h-16 border-b border-gray-100 dark:border-gray-700 px-4 shrink-0">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <x-application-logo class="block h-8 w-auto fill-current text-indigo-600 dark:text-indigo-400" />
            <span class="font-bold text-xl tracking-wide text-gray-800 dark:text-gray-200">SiagaBPK</span>
        </a>
    </div>

    <nav class="flex-1 px-4 py-4 space-y-1.5 overflow-y-auto">

        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-400' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200' }}">
            <i class="fa-solid fa-chart-pie w-5 text-center"></i>
            {{ __('Dashboard') }}
        </a>

        @if (auth()->user()->role === 'admin')
            <div class="pt-4 pb-1">
                <p class="px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Manajemen
                    SDM</p>
            </div>

            <a href="{{ route('users.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('users.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-400' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200' }}">
                <i class="fa-solid fa-users w-5 text-center"></i>
                {{ __('Petugas BPK') }}
            </a>

            <a href="{{ route('masyarakat.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('masyarakat.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-400' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200' }}">
                <i class="fa-solid fa-users-viewfinder w-5 text-center"></i>
                {{ __('Data Warga') }}
            </a>
        @endif

        <div class="pt-4 pb-1">
            <p class="px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Operasional
                Lapangan</p>
        </div>

        @if (in_array(auth()->user()->role, ['admin', 'relawan']))
            <a href="{{ route('jadwal_siaga.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('jadwal_siaga.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-400' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200' }}">
                <i class="fa-solid fa-calendar-days w-5 text-center"></i>
                {{ __('Jadwal Siaga') }}
            </a>
        @endif

        <a href="{{ route('insidens.index') }}"
            class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('insidens.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-400' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200' }}">
            <i class="fa-solid fa-fire-extinguisher w-5 text-center"></i>
            {{ __('Insiden') }}
        </a>

        @if (in_array(auth()->user()->role, ['admin', 'relawan']))
            <div class="pt-4 pb-1">
                <p class="px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Logistik &
                    Giat</p>
            </div>

            @if (auth()->user()->role === 'admin')
                <a href="{{ route('inventaris.index') }}"
                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('inventaris.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-400' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200' }}">
                    <i class="fa-solid fa-truck-fast w-5 text-center"></i>
                    {{ __('Inventaris & Armada') }}
                </a>
            @endif

            <a href="{{ route('kegiatans.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('kegiatans.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-400' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200' }}">
                <i class="fa-solid fa-camera-retro w-5 text-center"></i>
                {{ __('Dokumentasi Kegiatan') }}
            </a>
        @endif

        @if (auth()->user()->role === 'admin')
            <div class="pt-4 pb-1">
                <p class="px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Administrasi
                </p>
            </div>

            <a href="{{ route('reports.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('reports.*') ? 'bg-red-50 text-red-700 dark:bg-red-900/50 dark:text-red-400' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200' }}">
                <i class="fa-solid fa-print w-5 text-center"></i>
                {{ __('Pusat Laporan') }}
            </a>
        @endif

    </nav>
</aside>
