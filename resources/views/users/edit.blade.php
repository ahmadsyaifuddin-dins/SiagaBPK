<x-app-layout>
    <div class="p-6">
        <h2 class="text-xl font-bold mb-4">✏️ Edit Role Pengguna</h2>

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-4">
                <label>Nama:</label>
                <input type="text" class="w-full p-2 border rounded" value="{{ $user->name }}" disabled>
            </div>

            <div class="mb-4">
                <label>Role:</label>
                <select name="role" class="w-full p-2 border rounded">
                    @foreach ($roles as $role)
                        <option value="{{ $role }}" {{ $user->hasRole($role) ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('users.index') }}" class="ml-4 text-gray-600">Kembali</a>
        </form>
    </div>
</x-app-layout>
