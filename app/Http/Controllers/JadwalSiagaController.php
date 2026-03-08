<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJadwalSiagaRequest;
use App\Http\Requests\UpdateJadwalSiagaRequest;
use App\Models\JadwalSiaga;
use App\Models\User;

class JadwalSiagaController extends Controller
{
    public function index()
    {
        $data = JadwalSiaga::with('user')->orderBy('tanggal')->get();

        return view('jadwal_siaga.index', compact('data'));
    }

    public function create()
    {
        $users = User::where('role', 'relawan')->get();

        return view('jadwal_siaga.create', compact('users'));
    }

    public function store(StoreJadwalSiagaRequest $request)
    {
        JadwalSiaga::create($request->validated());

        return redirect()->route('jadwal_siaga.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit(JadwalSiaga $jadwal_siaga)
    {
        $users = User::where('role', 'relawan')->get();

        return view('jadwal_siaga.edit', compact('jadwal_siaga', 'users'));
    }

    public function update(UpdateJadwalSiagaRequest $request, JadwalSiaga $jadwal_siaga)
    {
        $jadwal_siaga->update($request->validated());

        return redirect()->route('jadwal_siaga.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy(JadwalSiaga $jadwal_siaga)
    {
        $jadwal_siaga->delete();

        return back()->with('success', 'Jadwal berhasil dihapus');
    }
}
