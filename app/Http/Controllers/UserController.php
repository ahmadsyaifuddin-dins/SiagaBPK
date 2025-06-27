<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_hp' => 'required|numeric',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'jabatan' => 'nullable|in:Komandan,Petugas Lapangan,Danton',
            'golongan_darah' => 'nullable|string',
            'status_aktif' => 'required|boolean',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'jabatan' => $request->jabatan,
            'golongan_darah' => $request->golongan_darah,
            'status_aktif' => $request->status_aktif,
        ]);

        $user->assignRole($request->role);

        return redirect()->route('users.index')->with('success', 'Data Petugas berhasil ditambahkan');
    }


    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name'); // misal ['admin' => 'admin', 'relawan' => 'relawan']
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string',
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_hp' => 'required|numeric',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'jabatan' => 'nullable|in:Komandan,Petugas Lapangan,Danton,Wakil Komandan,Petugas Senior,Petugas Junior,Anggota Regu,Petugas Medis,Petugas Teknis',
            'golongan_darah' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'status_aktif' => 'required|boolean',
        ]);

        // Prepare data for update
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'jabatan' => $request->jabatan,
            'golongan_darah' => $request->golongan_darah,
            'status_aktif' => $request->status_aktif,
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Update user data
        $user->update($data);

        // Sync roles
        $user->syncRoles([$request->role]);

        return redirect()->route('users.index')->with('success', 'Data Petugas berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Data Petugas berhasil dihapus');
    }
}
