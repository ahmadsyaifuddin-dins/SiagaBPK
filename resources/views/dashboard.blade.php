<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('📊 Dashboard SiagaBPK') }}
        </h2>
    </x-slot>
        <div class="p-6 space-y-6">    
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-gradient-to-r from-blue-400 to-blue-600 text-white rounded-lg p-4 shadow">
                    <div class="text-3xl font-bold">{{ $totalInsiden }}</div>
                    <div class="text-sm mt-1">Total Insiden</div>
                </div>
                <div class="bg-gradient-to-r from-green-400 to-green-600 text-white rounded-lg p-4 shadow">
                    <div class="text-3xl font-bold">{{ $totalUser }}</div>
                    <div class="text-sm mt-1">Total Pengguna</div>
                </div>
                <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 text-white rounded-lg p-4 shadow">
                    <div class="text-3xl font-bold">{{ $totalJadwal }}</div>
                    <div class="text-sm mt-1">Total Jadwal Siaga</div>
                </div>
                <div class="bg-gradient-to-r from-purple-400 to-purple-600 text-white rounded-lg p-4 shadow">
                    <div class="text-3xl font-bold">{{ $relawanHariIni }}</div>
                    <div class="text-sm mt-1">Relawan Hari Ini</div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                <h2 class="text-lg font-bold mb-2">🔥 Insiden Terbaru</h2>
                <ul class="list-disc list-inside text-sm text-gray-800 dark:text-gray-200">
                    @foreach ($insidenTerbaru as $item)
                        <li>{{ $item->lokasi }} - {{ $item->waktu_kejadian->format('d M Y H:i') }} ({{ $item->status }})</li>
                    @endforeach
                </ul>
            </div>
            
        </div>
    
</x-app-layout>
