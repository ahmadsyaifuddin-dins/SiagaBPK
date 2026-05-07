<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('role', 'asc')->orderBy('name', 'asc')->get();

        return view('users.index', compact('users'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/users'), $filename);
            $data['foto'] = $filename;
        }

        User::create($data);

        return redirect()->route('users.index')->with('success', 'Data Pengguna berhasil ditambahkan');
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

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && File::exists(public_path('uploads/users/'.$user->foto))) {
                File::delete(public_path('uploads/users/'.$user->foto));
            }

            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/users'), $filename);
            $data['foto'] = $filename;
        }

        // Jangan izinkan update role dari form edit
        unset($data['role']);

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Data Pengguna berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'Data Petugas berhasil dihapus');
    }
}
