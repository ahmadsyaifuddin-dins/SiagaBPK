<div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 z-20 bg-black/50 lg:hidden" @click="sidebarOpen = false"
    style="display: none;"></div>

<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-30 w-64 bg-white dark:bg-gray-800 border-r border-gray-100 dark:border-gray-700 transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto flex flex-col shadow-lg lg:shadow-none">

    <div class="flex items-center justify-center h-16 border-b border-gray-100 dark:border-gray-700 px-4">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <x-application-logo class="block h-8 w-auto fill-current text-indigo-600 dark:text-indigo-400" />
            <span class="font-bold text-xl tracking-wide text-gray-800 dark:text-gray-200">SiagaBPK</span>
        </a>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-400' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200' }}">
            <i class="fa-solid fa-chart-pie w-5 text-center"></i>
            {{ __('Dashboard') }}
        </a>

        @if (auth()->user()->role === 'admin')
            <a href="{{ route('users.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('users.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-400' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200' }}">
                <i class="fa-solid fa-users w-5 text-center"></i>
                {{ __('Petugas') }}
            </a>
        @endif

        <a href="{{ route('insidens.index') }}"
            class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('insidens.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-400' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200' }}">
            <i class="fa-solid fa-fire-extinguisher w-5 text-center"></i>
            {{ __('Insiden') }}
        </a>

        @if (in_array(auth()->user()->role, ['admin', 'relawan']))
            <a href="{{ route('jadwal_siaga.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('jadwal_siaga.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-400' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200' }}">
                <i class="fa-solid fa-calendar-days w-5 text-center"></i>
                {{ __('Jadwal Siaga') }}
            </a>

            <a href="{{ route('kegiatans.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('kegiatans.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-400' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200' }}">
                <i class="fa-solid fa-camera-retro w-5 text-center"></i>
                {{ __('Dokumentasi Kegiatan') }}
            </a>
        @endif

        @if (auth()->user()->role === 'admin')
            <a href="{{ route('inventaris.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('inventaris.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-400' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200' }}">
                <i class="fa-solid fa-truck-fast w-5 text-center"></i>
                {{ __('Inventaris & Armada') }}
            </a>

            <a href="{{ route('laporan-lengkap') }}"
                class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('laporan-lengkap') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-400' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200' }}">
                <i class="fa-solid fa-file-pdf w-5 text-center"></i>
                Laporan Lengkap
            </a>
        @endif

    </nav>

    <div class="border-t border-gray-100 dark:border-gray-700 p-4">
        <div class="flex items-center gap-3 px-2 mb-3">
            @php
                $avatarColor = match (auth()->user()->role) {
                    'admin'
                        => 'bg-red-100 text-red-700 border-red-200 dark:bg-red-900 dark:text-red-300 dark:border-red-700',
                    'relawan'
                        => 'bg-green-100 text-green-700 border-green-200 dark:bg-green-900 dark:text-green-300 dark:border-green-700',
                    default
                        => 'bg-indigo-100 text-indigo-700 border-indigo-200 dark:bg-indigo-900 dark:text-indigo-300 dark:border-indigo-700',
                };
            @endphp

            <div
                class="h-10 w-10 rounded-full flex items-center justify-center font-bold border shrink-0 {{ $avatarColor }}">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">
                    {{ Auth::user()->name }}
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                    {{ ucfirst(Auth::user()->role ?? 'Tidak ada role') }}
                </p>
            </div>
        </div>

        <div class="space-y-1">
            <a href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200 rounded-md transition-colors">
                <i class="fa-solid fa-user-gear w-4 text-center"></i> {{ __('Profile') }}
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex w-full items-center gap-3 px-3 py-2 text-sm text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/30 rounded-md transition-colors">
                    <i class="fa-solid fa-right-from-bracket w-4 text-center"></i> {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</aside>
