<?php

namespace App\Http\Controllers;

use App\Models\JadwalSiaga;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalSiagaController extends Controller
{
    public function index()
    {
        $data = JadwalSiaga::with('user')->orderBy('tanggal')->get();
        return view('jadwal_siaga.index')->with('data', $data);
    }

    public function create()
    {
        $users = User::all();
        return view('jadwal_siaga.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'status' => 'required'
        ]);

        JadwalSiaga::create($request->all());
        return redirect()->route('jadwal_siaga.index')->with('success', 'Jadwal ditambahkan');
    }

    public function edit(JadwalSiaga $jadwal_siaga)
    {
        $users = User::all();
        return view('jadwal_siaga.edit', compact('jadwal_siaga', 'users'));
    }

    public function update(Request $request, JadwalSiaga $jadwal_siaga)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'status' => 'required'
        ]);

        $jadwal_siaga->update($request->all());
        return redirect()->route('jadwal_siaga.index')->with('success', 'Jadwal diperbarui');
    }

    public function destroy(JadwalSiaga $jadwal_siaga)
    {
        $jadwal_siaga->delete();
        return back()->with('success', 'Jadwal dihapus');
    }
}
