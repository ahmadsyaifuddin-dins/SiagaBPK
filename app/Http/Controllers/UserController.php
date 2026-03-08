<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        // Langsung simpan! Kolom 'role' otomatis ikut tersimpan
        User::create($data);

        return redirect()->route('users.index')->with('success', 'Data Petugas berhasil ditambahkan');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        // Langsung update! Kolom 'role' otomatis ikut berubah
        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Data Petugas berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'Data Petugas berhasil dihapus');
    }
}
