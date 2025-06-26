<x-app-layout>
    <div class="p-6">
        <h2 class="text-xl font-bold mb-4">👥 Kelola Relawan</h2>
        <button onclick="openModal()" class="bg-green-600 text-white px-4 py-2 rounded mb-4">
            + Tambah Relawan
        </button>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->getRoleNames()->first() ?? '-' }}</td>
                    <td>
                        <a href="{{ route('users.edit', $u->id) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('users.destroy', $u->id) }}" method="POST" class="inline-block"
                            onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 ml-2">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal Tambah User -->
    <div id="modal-user" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <h2 class="text-lg font-bold mb-4">Tambah Relawan</h2>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label>Nama</label>
                    <input type="text" name="name" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label>Email</label>
                    <input type="email" name="email" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label>Password</label>
                    <input type="password" name="password" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label>Role</label>
                    <select name="role" class="w-full border p-2 rounded" required>
                        <option value="relawan">Relawan</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()" class="text-gray-600 mr-4">Batal</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
        document.getElementById('modal-user').classList.remove('hidden');
        document.getElementById('modal-user').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('modal-user').classList.add('hidden');
        document.getElementById('modal-user').classList.remove('flex');
    }
    </script>

</x-app-layout>