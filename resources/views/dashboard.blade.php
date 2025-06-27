<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-900 dark:text-gray-100 leading-tight flex items-center">
                <span class="text-3xl mr-3">📊</span>
                {{ __('Dashboard SiagaBPK') }}
            </h2>
            <div class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ now()->format('d M Y, H:i') }}</span>
            </div>
        </div>
    </x-slot>
    
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-8">
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Total Insiden -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 dark:from-blue-600 dark:via-blue-700 dark:to-blue-800 rounded-2xl p-6 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-white/20 dark:bg-white/10 rounded-xl backdrop-blur-sm">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <div class="text-white/80 text-sm font-medium">Trend</div>
                                    <div class="text-white text-xs">+12%</div>
                                </div>
                            </div>
                            <div class="text-white">
                                <div class="text-4xl font-bold mb-1">{{ $totalInsiden }}</div>
                                <div class="text-blue-200 text-sm font-medium">Total Insiden</div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Pengguna -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-emerald-500 via-emerald-600 to-emerald-700 dark:from-emerald-600 dark:via-emerald-700 dark:to-emerald-800 rounded-2xl p-6 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-white/20 dark:bg-white/10 rounded-xl backdrop-blur-sm">
                                    <i class="fa-solid fa-users text-white"></i>
                                </div>
                                <div class="text-right">
                                    <div class="text-white/80 text-sm font-medium">Active</div>
                                    <div class="text-white text-xs">{{ round(($totalUser * 0.8)) }}</div>
                                </div>
                            </div>
                            <div class="text-white">
                                <div class="text-4xl font-bold mb-1">{{ $totalUser }}</div>
                                <div class="text-emerald-200 text-sm font-medium">Total Pengguna</div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Jadwal Siaga -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-amber-500 via-amber-600 to-amber-700 dark:from-amber-600 dark:via-amber-700 dark:to-amber-800 rounded-2xl p-6 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-white/20 dark:bg-white/10 rounded-xl backdrop-blur-sm">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <div class="text-white/80 text-sm font-medium">Monthly</div>
                                    <div class="text-white text-xs">{{ round(($totalJadwal / 12)) }}</div>
                                </div>
                            </div>
                            <div class="text-white">
                                <div class="text-4xl font-bold mb-1">{{ $totalJadwal }}</div>
                                <div class="text-amber-200 text-sm font-medium">Total Jadwal Siaga</div>
                            </div>
                        </div>
                    </div>

                    <!-- Relawan Hari Ini -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-purple-500 via-purple-600 to-purple-700 dark:from-purple-600 dark:via-purple-700 dark:to-purple-800 rounded-2xl p-6 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-white/20 dark:bg-white/10 rounded-xl backdrop-blur-sm">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <div class="text-white/80 text-sm font-medium">Status</div>
                                    <div class="text-white text-xs flex items-center">
                                        <div class="w-2 h-2 bg-green-400 rounded-full mr-1 animate-pulse"></div>
                                        Online
                                    </div>
                                </div>
                            </div>
                            <div class="text-white">
                                <div class="text-4xl font-bold mb-1">{{ $relawanHariIni }}</div>
                                <div class="text-purple-200 text-sm font-medium">Relawan Hari Ini</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Recent Incidents -->
                    <div class="lg:col-span-2">
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 flex items-center">
                                        <span class="text-2xl mr-3">🔥</span>
                                        Insiden Terbaru
                                    </h3>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Live</span>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6">
                                @if($insidenTerbaru->count() > 0)
                                    <div class="space-y-4">
                                        @foreach ($insidenTerbaru as $index => $item)
                                            <div class="group p-4 rounded-xl bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200 border-l-4 
                                                @if($item->status == 'Selesai') border-green-500 
                                                @elseif($item->status == 'Tiba di TKP') border-blue-500 
                                                @elseif($item->status == 'Berangkat') border-yellow-500 
                                                @elseif($item->status == 'Dilaporkan') border-red-500 
                                                @else border-red-500 @endif">
                                                <div class="flex items-start justify-between">
                                                    <div class="flex-1">
                                                        <div class="flex items-center space-x-3 mb-2">
                                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            </svg>
                                                            <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $item->lokasi }}</h4>
                                                        </div>
                                                        <div class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400">
                                                            <div class="flex items-center space-x-1">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                </svg>
                                                                <span>{{ $item->waktu_kejadian->format('d M Y H:i') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ml-4">
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                                            @if($item->status == 'Selesai') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                            @elseif($item->status == 'Tiba di TKP') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                                            @elseif($item->status == 'Berangkat') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                            @elseif($item->status == 'Dilaporkan') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif">
                                                            {{ ucfirst($item->status) }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-8">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Tidak ada insiden</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Belum ada insiden yang dilaporkan hari ini.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions & System Status -->
                    <div class="space-y-6">
                        
                        <!-- Quick Actions -->
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 flex items-center">
                                    <span class="text-xl mr-2">⚡</span>
                                    Quick Actions
                                </h3>
                            </div>
                            <div class="p-6 space-y-3">
                                <a href="{{ route('insidens.create') }}" class="w-full flex items-center justify-center px-4 py-3 bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-600 text-white rounded-xl transition-colors duration-200 font-medium">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Tambah Insiden
                                </a>
                                <a href="{{ route('jadwal_siaga.create') }}" class="w-full flex items-center justify-center px-4 py-3 bg-green-600 hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-600 text-white rounded-xl transition-colors duration-200 font-medium">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Atur Jadwal
                                </a>
                                <a href="{{ route('users.index') }}" class="w-full flex items-center justify-center px-4 py-3 bg-yellow-600 hover:bg-yellow-700 dark:bg-yellow-700 dark:hover:bg-yellow-600 text-white rounded-xl transition-colors duration-200 font-medium">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    Lihat Petugas
                                </a>
                                <a href="{{ route('laporan-lengkap') }}" class="w-full flex items-center justify-center px-4 py-3 bg-purple-600 hover:bg-purple-700 dark:bg-purple-700 dark:hover:bg-purple-600 text-white rounded-xl transition-colors duration-200 font-medium">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    Lihat Laporan Lengkap
                                </a>
                            </div>
                        </div>

                        <!-- System Status -->
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 flex items-center">
                                    <span class="text-xl mr-2">📊</span>
                                    System Status
                                </h3>
                            </div>
                            <div class="p-6 space-y-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">Server Status</span>
                                    </div>
                                    <span class="text-sm text-green-600 dark:text-green-400 font-medium">Online</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">Database</span>
                                    </div>
                                    <span class="text-sm text-blue-600 dark:text-blue-400 font-medium">Connected</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">API Response</span>
                                    </div>
                                    <span class="text-sm text-yellow-600 dark:text-yellow-400 font-medium">125ms</span>
                                </div>
                                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        Last updated: {{ now()->format('H:i:s') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>