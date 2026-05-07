<x-app-layout>
    <div class="py-8 bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <a href="{{ route('inventaris.index') }}"
                        class="w-10 h-10 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-full flex items-center justify-center transition-colors shadow-sm border border-gray-200 dark:border-gray-700 shrink-0">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                            Detail Aset & Inventaris
                        </h1>
                        <div class="text-sm text-gray-500 dark:text-gray-400 font-mono mt-0.5">
                            {{ $inventari->kode_barang }}
                        </div>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('inventaris.edit', $inventari->id) }}"
                        class="inline-flex items-center gap-2 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900/30 dark:hover:bg-blue-800/50 text-blue-700 dark:text-blue-400 px-4 py-2 rounded-xl font-semibold transition-colors duration-200">
                        <i class="fa-solid fa-pen-to-square"></i> <span class="hidden sm:inline">Edit Data</span>
                    </a>

                    <form action="{{ route('inventaris.destroy', $inventari->id) }}" method="POST" class="inline"
                        onsubmit="confirmDelete(event, this, 'Yakin ingin menghapus aset ini secara permanen?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center gap-2 bg-red-100 hover:bg-red-200 dark:bg-red-900/30 dark:hover:bg-red-800/50 text-red-700 dark:text-red-400 px-4 py-2 rounded-xl font-semibold transition-colors duration-200">
                            <i class="fa-solid fa-trash-can"></i> <span class="hidden sm:inline">Hapus</span>
                        </button>
                    </form>
                </div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden mb-8">
                <div class="grid grid-cols-1 md:grid-cols-3">

                    <div
                        class="bg-gray-50 dark:bg-gray-700/30 md:border-r border-gray-200 dark:border-gray-700 p-6 flex flex-col items-center justify-start min-h-[300px] gap-8">

                        <div class="w-full flex flex-col items-center">
                            <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">
                                Foto Dokumentasi</p>
                            @if ($inventari->foto)
                                <img src="{{ asset($inventari->foto) }}" alt="{{ $inventari->nama_barang }}"
                                    class="w-full max-w-[200px] rounded-xl shadow-md object-cover border border-gray-300 dark:border-gray-600">
                            @else
                                <div
                                    class="w-32 h-32 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center shadow-inner border border-gray-200 dark:border-gray-700 mb-2">
                                    <i class="fa-solid fa-image-slash text-4xl text-gray-300 dark:text-gray-600"></i>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 text-xs font-medium">Belum ada foto</p>
                            @endif
                        </div>

                        <div
                            class="w-full flex flex-col items-center border-t border-gray-200 dark:border-gray-600 pt-6">
                            <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">
                                QR Code Sistem</p>
                            @if ($inventari->qr_code)
                                <div class="bg-white p-2 rounded-xl shadow-sm border border-gray-200 mb-3">
                                    <img src="{{ asset($inventari->qr_code) }}" alt="QR Code"
                                        class="w-32 h-32 object-contain">
                                </div>
                                <a href="{{ asset($inventari->qr_code) }}"
                                    download="QR_{{ $inventari->kode_barang }}.svg"
                                    class="inline-flex items-center gap-1.5 text-xs font-bold bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 px-3 py-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors shadow-sm">
                                    <i class="fa-solid fa-download"></i> Unduh Label
                                </a>
                            @else
                                <p class="text-xs text-orange-500 text-center"><i
                                        class="fa-solid fa-triangle-exclamation"></i> QR Code belum tergenerate. Edit
                                    dan Simpan data untuk membuat QR.</p>
                            @endif
                        </div>

                    </div>

                    <div class="md:col-span-2 p-6 lg:p-8">
                        <div class="flex items-start justify-between mb-6">
                            <div>
                                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-2">
                                    {{ $inventari->nama_barang }}
                                </h2>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600">
                                        <i class="fa-solid fa-layer-group mr-1.5"></i> {{ $inventari->kategori }}
                                    </span>
                                    @if ($inventari->tanggal_kadaluarsa && \Carbon\Carbon::parse($inventari->tanggal_kadaluarsa) <= now()->addDays(30))
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800 animate-pulse">
                                            <i class="fa-solid fa-triangle-exclamation mr-1.5"></i>
                                            {{ \Carbon\Carbon::parse($inventari->tanggal_kadaluarsa) < now() ? 'Expired' : 'Hampir Expired' }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @php
                                $kondisiClass = match ($inventari->kondisi) {
                                    'Baik'
                                        => 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-400 border border-green-200 dark:border-green-800',
                                    'Rusak Ringan'
                                        => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800',
                                    'Rusak Berat'
                                        => 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400 border border-red-200 dark:border-red-800',
                                    default => 'bg-gray-100 text-gray-700',
                                };
                            @endphp
                            <div class="text-center shrink-0 ml-4">
                                <span
                                    class="inline-flex flex-col items-center px-4 py-2 rounded-xl text-sm font-bold shadow-sm {{ $kondisiClass }}">
                                    <i class="fa-solid fa-heart-pulse mb-1"></i>
                                    {{ $inventari->kondisi }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                            <div
                                class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-xl border border-blue-100 dark:border-blue-800/50">
                                <p class="text-sm font-semibold text-blue-600 dark:text-blue-400 mb-1"><i
                                        class="fa-solid fa-cubes mr-1.5"></i> Jumlah Stok</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $inventari->jumlah }}
                                    <span class="text-base font-normal text-gray-500">Unit</span>
                                </p>
                            </div>

                            <div
                                class="bg-orange-50 dark:bg-orange-900/20 p-4 rounded-xl border border-orange-100 dark:border-orange-800/50">
                                <p class="text-sm font-semibold text-orange-600 dark:text-orange-400 mb-1"><i
                                        class="fa-solid fa-bell mr-1.5"></i> Batas Minimum</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ $inventari->stok_minimum }} <span
                                        class="text-base font-normal text-gray-500">Unit</span></p>
                            </div>

                            <div
                                class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-xl border border-gray-200 dark:border-gray-700">
                                <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1"><i
                                        class="fa-solid fa-calendar-check mr-1.5"></i> Terdaftar Sejak</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-white">
                                    {{ $inventari->created_at->translatedFormat('d M Y') }}</p>
                            </div>

                            <div
                                class="bg-red-50 dark:bg-red-900/20 p-4 rounded-xl border border-red-100 dark:border-red-800/50">
                                <p class="text-sm font-semibold text-red-600 dark:text-red-400 mb-1"><i
                                        class="fa-solid fa-calendar-xmark mr-1.5"></i> Tanggal Kadaluarsa</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-white">
                                    {{ $inventari->tanggal_kadaluarsa ? \Carbon\Carbon::parse($inventari->tanggal_kadaluarsa)->translatedFormat('d M Y') : 'Tidak Ada' }}
                                </p>
                            </div>
                        </div>

                        <div>
                            <h3
                                class="text-sm font-bold text-gray-900 dark:text-gray-100 mb-3 border-b border-gray-200 dark:border-gray-700 pb-2 flex items-center">
                                <i class="fa-solid fa-circle-info text-blue-500 mr-2"></i> Keterangan & Spesifikasi
                            </h3>
                            <div
                                class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed bg-gray-50 dark:bg-gray-900/50 p-4 rounded-xl">
                                @if ($inventari->keterangan)
                                    {!! nl2br(e($inventari->keterangan)) !!}
                                @else
                                    <span class="italic opacity-70">Tidak ada keterangan tambahan untuk aset ini.</span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="mt-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 bg-gradient-to-r from-orange-500 to-amber-500 rounded-lg shadow-sm">
                            <i class="fa-solid fa-screwdriver-wrench text-white"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Jadwal & Riwayat Servis</h2>
                    </div>

                    <a href="{{ route('maintenances.create', ['inventaris_id' => $inventari->id]) }}"
                        class="inline-flex items-center gap-2 bg-orange-600 hover:bg-orange-700 text-white px-5 py-2.5 rounded-xl font-bold shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                        <i class="fa-solid fa-plus"></i> Tambah Jadwal Servis
                    </a>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-50 dark:bg-gray-900/50">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                        Tanggal</th>
                                    <th
                                        class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                        Jenis Servis</th>
                                    <th
                                        class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                        Status</th>
                                    <th
                                        class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                        Biaya</th>
                                    <th
                                        class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                        Nota</th>
                                    <th
                                        class="px-6 py-4 text-right text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($inventari->maintenances as $main)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900 dark:text-gray-100">
                                                {{ \Carbon\Carbon::parse($main->tanggal_servis)->translatedFormat('d M Y') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                                {{ $main->jenis_servis }}</div>
                                            @if ($main->keterangan)
                                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1 line-clamp-2"
                                                    title="{{ $main->keterangan }}">
                                                    {{ $main->keterangan }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $statusColor = match ($main->status) {
                                                    'Terjadwal'
                                                        => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                                    'Proses'
                                                        => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                                                    'Selesai'
                                                        => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                                    'Batal'
                                                        => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                                                    default => 'bg-gray-100 text-gray-800',
                                                };
                                            @endphp
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $statusColor }}">
                                                {{ $main->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($main->biaya > 0)
                                                <span class="text-sm font-bold text-gray-900 dark:text-gray-100">
                                                    Rp {{ number_format($main->biaya, 0, ',', '.') }}
                                                </span>
                                            @else
                                                <span class="text-xs text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if ($main->nota_servis)
                                                <a href="{{ asset($main->nota_servis) }}" target="_blank"
                                                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400 font-medium inline-flex items-center gap-1">
                                                    <i class="fa-solid fa-receipt"></i> Lihat
                                                </a>
                                            @else
                                                <span class="text-gray-400 dark:text-gray-500 italic">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end gap-3">
                                                <a href="{{ route('maintenances.edit', $main->id) }}"
                                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400 transition-colors"
                                                    title="Update Status">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <form action="{{ route('maintenances.destroy', $main->id) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="confirmDelete(event, this, 'Yakin ingin menghapus riwayat servis ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 transition-colors">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center">
                                            <div class="text-gray-400 dark:text-gray-500 mb-2">
                                                <i class="fa-solid fa-clipboard-check text-3xl"></i>
                                            </div>
                                            <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada
                                                jadwal/riwayat servis untuk aset ini.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($inventari->maintenances->where('status', 'Selesai')->sum('biaya') > 0)
                                <tfoot
                                    class="bg-gray-50 dark:bg-gray-900/80 border-t border-gray-200 dark:border-gray-700">
                                    <tr>
                                        <td colspan="3"
                                            class="px-6 py-4 text-right text-sm font-bold text-gray-900 dark:text-gray-100">
                                            Total Pengeluaran Servis Selesai:
                                        </td>
                                        <td colspan="3" class="px-6 py-4 text-left">
                                            <span class="text-lg font-black text-emerald-600 dark:text-emerald-400">
                                                Rp
                                                {{ number_format($inventari->maintenances->where('status', 'Selesai')->sum('biaya'), 0, ',', '.') }}
                                            </span>
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
