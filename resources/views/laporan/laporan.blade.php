<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-white">Laporan Lengkap Insiden</h1>
        @role('admin')
            <a href="{{ route('laporan-lengkap.export.pdf') }}"
                class="inline-flex items-center px-4 py-2 mb-6 bg-red-600 text-white text-sm font-semibold rounded hover:bg-red-700 shadow transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Export PDF
        </a>
        @endrole
        <div class="overflow-auto shadow rounded-lg bg-white dark:bg-gray-800">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr class="text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Lokasi</th>
                        <th class="px-4 py-3">Waktu Kejadian</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Jenis</th>
                        <th class="px-4 py-3">Korban</th>
                        <th class="px-4 py-3">Kerugian</th>
                        <th class="px-4 py-3">Pelapor</th>
                        <th class="px-4 py-3">Kontak</th>
                        <th class="px-4 py-3">Dilaporkan Oleh</th>
                        <th class="px-4 py-3">Petugas</th>
                        <th class="px-4 py-3">Foto</th>
                        <th class="px-4 py-3">Catatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($data as $insiden)
                    <tr class="text-sm text-gray-900 dark:text-gray-200">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $insiden->lokasi }}</td>
                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($insiden->waktu_kejadian)->format('d M Y H:i') }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    @if($insiden->status === 'Dilaporkan') bg-red-100 text-red-700 dark:bg-red-800 dark:text-white
                                    @elseif($insiden->status === 'Berangkat') bg-yellow-100 text-yellow-700 dark:bg-yellow-800 dark:text-white
                                    @elseif($insiden->status === 'Tiba di TKP') bg-blue-100 text-blue-700 dark:bg-blue-800 dark:text-white
                                    @else bg-green-100 text-green-700 dark:bg-green-800 dark:text-white
                                    @endif">
                                {{ $insiden->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3">{{ $insiden->jenis_insiden ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $insiden->jumlah_korban ?? 0 }}</td>
                        <td class="px-4 py-3">{{ $insiden->kerugian ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $insiden->nama_pelapor ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $insiden->kontak_pelapor ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $insiden->pelapor->name ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @if($insiden->petugas && $insiden->petugas->count())
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($insiden->petugas as $petugas)
                                <li>{{ $petugas->name }}</li>
                                @endforeach
                            </ul>
                            @else
                            <span class="italic text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($insiden->foto)
                            <a href="{{ asset('storage/' . $insiden->foto) }}" target="_blank">
                                <img src="{{ asset('storage/' . $insiden->foto) }}"
                                    class="w-16 h-16 object-cover rounded" alt="foto">
                            </a>
                            @else
                            <span class="italic text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            {{ Str::limit($insiden->catatan, 100, '...') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="13" class="text-center text-gray-500 dark:text-gray-400 py-6">
                            Tidak ada data insiden.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>