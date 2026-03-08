<div
    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 dark:bg-gray-900/50">
                <tr>
                    <th
                        class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-2">
                            <i class="fa-solid fa-user"></i>
                            <span>Nama Petugas</span>
                        </div>
                    </th>
                    <th
                        class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-2">
                            <i class="fa-solid fa-envelope"></i>
                            <span>Email</span>
                        </div>
                    </th>
                    <th
                        class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-2">
                            <i class="fa-solid fa-user-shield"></i>
                            <span>Role</span>
                        </div>
                    </th>
                    <th
                        class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-2">
                            <i class="fa-solid fa-heart-pulse"></i>
                            <span>Status Aktif</span>
                        </div>
                    </th>
                    @if (auth()->user()->role === 'admin')
                        <th
                            class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center space-x-2">
                                <i class="fa-solid fa-gear"></i>
                                <span>Aksi</span>
                            </div>
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($users as $u)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div
                                        class="h-10 w-10 rounded-full bg-gradient-to-br from-red-500 to-orange-500 flex items-center justify-center shadow-sm">
                                        <span
                                            class="text-white font-bold text-sm">{{ strtoupper(substr($u->name, 0, 1)) }}</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $u->name }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                        <i class="fa-solid fa-sitemap mr-1"></i> {{ $u->jabatan ?? 'Anggota Tim' }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-gray-300">{{ $u->email }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                <i class="fa-solid fa-phone mr-1"></i> {{ $u->no_hp ?? '-' }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $roleName = strtolower($u->role ?? '-');
                                $roleColor = match ($roleName) {
                                    'admin' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                                    'relawan' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                    default => 'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300',
                                };
                            @endphp
                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $roleColor }}">
                                {{ ucfirst($roleName) }}
                            </span>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full {{ $u->status_aktif ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400' }}">
                                @if ($u->status_aktif)
                                    <i class="fa-solid fa-circle-check mr-1.5"></i> Aktif
                                @else
                                    <i class="fa-solid fa-circle-xmark mr-1.5"></i> Tidak Aktif
                                @endif
                            </span>
                        </td>

                        @if (auth()->user()->role === 'admin')
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('users.edit', $u->id) }}"
                                        class="bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/30 dark:hover:bg-blue-800/50 text-blue-600 dark:text-blue-400 px-3 py-2 rounded-lg transition-colors duration-200 flex items-center gap-1.5"
                                        title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i> <span
                                            class="hidden sm:inline">Edit</span>
                                    </a>

                                    <a href="{{ route('users.show', $u->id) }}"
                                        class="bg-green-50 hover:bg-green-100 dark:bg-green-900/30 dark:hover:bg-green-800/50 text-green-600 dark:text-green-400 px-3 py-2 rounded-lg transition-colors duration-200 flex items-center gap-1.5"
                                        title="Detail">
                                        <i class="fa-solid fa-eye"></i> <span class="hidden sm:inline">Detail</span>
                                    </a>

                                    <form action="{{ route('users.destroy', $u->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Yakin ingin menghapus petugas ini secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-50 hover:bg-red-100 dark:bg-red-900/30 dark:hover:bg-red-800/50 text-red-600 dark:text-red-400 px-3 py-2 rounded-lg transition-colors duration-200 flex items-center gap-1.5"
                                            title="Hapus">
                                            <i class="fa-solid fa-trash-can"></i> <span
                                                class="hidden sm:inline">Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role === 'admin' ? '5' : '4' }}"
                            class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div
                                    class="w-20 h-20 bg-gray-50 dark:bg-gray-800 rounded-full flex items-center justify-center mb-4 border border-gray-100 dark:border-gray-700">
                                    <i class="fa-solid fa-users-slash text-4xl text-gray-400 dark:text-gray-500"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-1">Belum ada data
                                    Petugas</h3>
                                <p class="text-gray-500 dark:text-gray-400 mb-6 text-sm">Mulai dengan menambahkan
                                    Petugas atau Relawan pertama Anda.</p>

                                @if (auth()->user()->role === 'admin')
                                    <button @click="isModalOpen = true"
                                        class="inline-flex items-center gap-2 bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-sm hover:shadow-md">
                                        <i class="fa-solid fa-user-plus"></i> Tambah Petugas
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
