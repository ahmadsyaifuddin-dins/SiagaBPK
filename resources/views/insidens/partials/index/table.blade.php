<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Data Insiden Kebakaran</h3>
        <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Daftar lengkap semua insiden yang tercatat</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-900/50">
                <tr>
                    <th
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-location-dot"></i> Lokasi
                        </div>
                    </th>
                    <th
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-clock"></i> Waktu Kejadian
                        </div>
                    </th>
                    <th
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-info"></i> Status
                        </div>
                    </th>
                    <th
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-camera"></i> Foto Dokumentasi
                        </div>
                    </th>
                    <th
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-gear"></i> Aksi
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($data as $insiden)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div
                                        class="h-10 w-10 rounded-full bg-gradient-to-r from-red-400 to-red-600 flex items-center justify-center">
                                        <i class="fa-solid fa-map-location-dot text-white"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $insiden->lokasi }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-gray-100">
                                {{ \Carbon\Carbon::parse($insiden->waktu_kejadian)->format('d M Y') }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                {{ \Carbon\Carbon::parse($insiden->waktu_kejadian)->format('H:i') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'Dilaporkan' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                                    'Berangkat' =>
                                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                                    'Tiba di TKP' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                    'Selesai' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                ];
                                $colorClass =
                                    $statusColors[$insiden->status] ??
                                    'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400';
                            @endphp
                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $colorClass }}">
                                {{ $insiden->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($insiden->foto)
                                <a href="{{ asset($insiden->foto) }}" target="_blank"
                                    class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-150">
                                    <i class="fa-regular fa-image"></i> Lihat Foto
                                </a>
                            @else
                                <span class="text-gray-400 dark:text-gray-500 text-sm">
                                    <i class="fa-solid fa-image-slash mr-1"></i> Tidak ada
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center gap-3">
                                @role('admin')
                                    <a href="{{ route('insidens.edit', $insiden->id) }}"
                                        class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-150">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <form action="{{ route('insidens.destroy', $insiden->id) }}" method="POST"
                                        class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus insiden ini?')"
                                            class="inline-flex items-center gap-1 text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-150">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                @endrole
                                <a href="{{ route('insidens.show', $insiden->id) }}"
                                    class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-150">
                                    <i class="fa-solid fa-eye"></i> Lihat
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div
                                    class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                    <i class="fa-solid fa-folder-open text-4xl text-gray-400 dark:text-gray-500"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Belum ada data
                                    insiden</h3>
                                <p class="text-gray-500 dark:text-gray-400 mb-6">Mulai dengan menambahkan insiden
                                    kebakaran pertama Anda.</p>
                                @role('admin')
                                    <a href="{{ route('insidens.create') }}"
                                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-150">
                                        <i class="fa-solid fa-plus"></i> Tambah Insiden Pertama
                                    </a>
                                @endrole
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
