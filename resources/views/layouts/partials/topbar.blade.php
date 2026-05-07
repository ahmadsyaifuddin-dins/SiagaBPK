<header class="bg-white dark:bg-gray-800 shadow z-10 relative">
    <div class="flex items-center justify-between px-4 py-4 sm:px-6 lg:px-8">

        <div class="flex items-center gap-4">
            <button @click="sidebarOpen = true"
                class="text-gray-500 focus:outline-none lg:hidden hover:text-gray-700 dark:hover:text-gray-300 transition">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>

            @isset($header)
                <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $header }}
                </div>
            @endisset
        </div>

        <div class="flex items-center gap-2 sm:gap-4">

            @if (in_array(auth()->user()->role, ['admin', 'kepala_bpk']))
                <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                    <button @click="open = ! open"
                        class="relative text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none rounded-full text-sm p-2.5 transition-colors duration-200"
                        title="Notifikasi Sistem">
                        <i class="fa-solid fa-bell text-lg"></i>
                        @if ($totalNotif > 0)
                            <div
                                class="absolute top-1.5 right-2 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white dark:border-gray-800 animate-pulse">
                            </div>
                        @endif
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 z-50 mt-2 w-80 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden"
                        style="display: none;">

                        <div
                            class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/80">
                            <p class="text-sm font-bold text-gray-800 dark:text-gray-200"><i
                                    class="fa-solid fa-bell mr-1"></i> Notifikasi Sistem</p>
                        </div>

                        <div class="max-h-80 overflow-y-auto">
                            @if ($totalNotif == 0)
                                <div
                                    class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400 flex flex-col items-center">
                                    <i
                                        class="fa-solid fa-shield-check text-4xl text-emerald-400 dark:text-emerald-500 mb-3"></i>
                                    <p class="font-medium">Semua inventaris aman.</p>
                                    <p class="text-xs mt-1">Tidak ada peringatan stok atau kadaluarsa.</p>
                                </div>
                            @else
                                @if ($stokMenipisCount > 0)
                                    <a href="{{ route('inventaris.index') }}"
                                        class="block px-4 py-4 hover:bg-orange-50 dark:hover:bg-orange-900/10 transition border-b border-gray-50 dark:border-gray-700/50 group">
                                        <p
                                            class="text-sm font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                                            <i
                                                class="fa-solid fa-boxes-stacked text-orange-500 group-hover:scale-110 transition-transform"></i>
                                            Stok Menipis ({{ $stokMenipisCount }})
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5 leading-relaxed">Ada
                                            <b>{{ $stokMenipisCount }} item</b> yang jumlahnya saat ini berada di bawah
                                            batas minimum.</p>
                                    </a>
                                @endif

                                @if ($kadaluarsaCount > 0)
                                    <a href="{{ route('inventaris.index') }}"
                                        class="block px-4 py-4 hover:bg-red-50 dark:hover:bg-red-900/10 transition group">
                                        <p
                                            class="text-sm font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                                            <i
                                                class="fa-solid fa-calendar-xmark text-red-500 group-hover:scale-110 transition-transform"></i>
                                            Mendekati Expired ({{ $kadaluarsaCount }})
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5 leading-relaxed">Ada
                                            <b>{{ $kadaluarsaCount }} APAR/Obat</b> yang hampir atau sudah melewati masa
                                            kadaluarsa.</p>
                                    </a>
                                @endif
                            @endif
                        </div>

                        @if ($totalNotif > 0)
                            <div
                                class="px-4 py-3 border-t border-gray-100 dark:border-gray-700 text-center bg-gray-50 dark:bg-gray-800/80 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                <a href="{{ route('inventaris.index') }}"
                                    class="text-xs font-bold text-blue-600 dark:text-blue-400 flex justify-center items-center gap-1">
                                    Tinjau Inventaris <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <button id="theme-toggle" type="button"
                class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none rounded-full text-sm p-2.5 transition-colors duration-200 mr-1"
                title="Ganti Tema">
                <i id="theme-toggle-light-icon" class="hidden fa-solid fa-sun text-yellow-500 text-lg"></i>
                <i id="theme-toggle-dark-icon" class="hidden fa-solid fa-moon text-indigo-500 text-lg"></i>
            </button>

            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center gap-2 p-1 border border-transparent text-sm leading-4 font-medium rounded-full sm:rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        @php
                            $userRole = auth()->user()->role;
                            $avatarColor = match ($userRole) {
                                'admin' => 'bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-400',
                                'kepala_bpk'
                                    => 'bg-purple-100 text-purple-700 dark:bg-purple-900/50 dark:text-purple-400',
                                'petugas_lapangan'
                                    => 'bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-400',
                                default => 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-400',
                            };
                            $roleLabel = match ($userRole) {
                                'admin' => 'Admin Inventaris',
                                'kepala_bpk' => 'Kepala BPK',
                                'petugas_lapangan' => 'Petugas Lapangan',
                                default => 'Pengguna',
                            };
                        @endphp

                        <div
                            class="h-8 w-8 rounded-full flex items-center justify-center font-bold border border-gray-100 dark:border-gray-700 {{ $avatarColor }}">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <div class="hidden sm:block text-left">
                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 leading-tight">
                                {{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 leading-tight">{{ $roleLabel }}</p>
                        </div>
                        <i class="fa-solid fa-chevron-down hidden sm:block text-xs ml-1"></i>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        <i class="fa-solid fa-user-gear w-5 text-center mr-1 text-gray-400"></i>
                        {{ __('Profile Settings') }}
                    </x-dropdown-link>
                    <div class="border-t border-gray-100 dark:border-gray-700 my-1"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30">
                            <i class="fa-solid fa-right-from-bracket w-5 text-center mr-1"></i> {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</header>
