<x-app-layout>
    <div class="py-8 min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div
                class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="flex items-center gap-4">
                    <div
                        class="w-14 h-14 bg-yellow-100 dark:bg-yellow-900/30 rounded-2xl flex items-center justify-center border border-yellow-200 dark:border-yellow-800 shrink-0">
                        <i class="fa-solid fa-users-viewfinder text-2xl text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Data Akun Warga</h1>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Daftar masyarakat terdaftar yang dapat
                            melaporkan kejadian darurat.</p>
                    </div>
                </div>
                <div
                    class="text-sm text-gray-500 bg-gray-50 dark:bg-gray-900 px-4 py-2 rounded-xl flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-blue-500"></i> Total: {{ $masyarakat->count() }} Akun
                </div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 dark:bg-gray-900/50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                    Nama Lengkap</th>
                                <th
                                    class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                    Kontak & Email</th>
                                <th
                                    class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                    Terdaftar Pada</th>
                                <th
                                    class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700 text-right">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($masyarakat as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="h-10 w-10 rounded-full bg-yellow-100 text-yellow-700 dark:bg-yellow-900/50 dark:text-yellow-400 flex items-center justify-center font-bold shadow-sm border border-yellow-200 dark:border-yellow-700">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                                    {{ $user->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-300"><i
                                                class="fa-solid fa-envelope mr-1 text-gray-400"></i> {{ $user->email }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1"><i
                                                class="fa-solid fa-phone mr-1 text-gray-400"></i>
                                            {{ $user->no_hp ?? 'Tidak ada nomor' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-300">
                                            {{ $user->created_at->translatedFormat('d F Y') }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $user->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form action="{{ route('masyarakat.destroy', $user->id) }}" method="POST"
                                            onsubmit="confirmDelete(event, this, 'Yakin ingin menghapus akun warga ini? Mereka tidak akan bisa login lagi.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-50 hover:bg-red-100 dark:bg-red-900/30 dark:hover:bg-red-800/50 text-red-600 dark:text-red-400 px-3 py-2 rounded-lg transition-colors duration-200 flex items-center gap-1.5 ml-auto"
                                                title="Hapus Akun">
                                                <i class="fa-solid fa-trash-can"></i> <span
                                                    class="hidden sm:inline">Blokir / Hapus</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div
                                                class="w-20 h-20 bg-gray-50 dark:bg-gray-800 rounded-full flex items-center justify-center mb-4 border border-gray-100 dark:border-gray-700">
                                                <i
                                                    class="fa-solid fa-user-tag text-4xl text-gray-400 dark:text-gray-500"></i>
                                            </div>
                                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-1">Belum
                                                ada masyarakat yang mendaftar</h3>
                                            <p class="text-gray-500 dark:text-gray-400 text-sm">Akun warga akan muncul
                                                di sini secara otomatis saat mereka melakukan registrasi.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
