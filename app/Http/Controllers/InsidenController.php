<?php

namespace App\Http\Controllers;

use App\Models\Insiden;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InsidenController extends Controller
{
    public function index()
    {
        $data = Insiden::with(['pelapor', 'petugas'])->latest()->get();
        return view('insidens.index', compact('data'));
    }

    public function create()
    {
        $users = User::all();
        return view('insidens.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'lokasi' => 'required',
            'waktu_kejadian' => 'required|date',
            'status' => 'required',
            'foto' => 'nullable|image|max:2048',
            'catatan' => 'nullable',
            'dilaporkan_oleh' => 'nullable|exists:users,id',
            'nama_pelapor' => 'nullable|string',
            'kontak_pelapor' => 'nullable|string',
            'jenis_insiden' => 'nullable|string',
            'jumlah_korban' => 'nullable|integer',
            'kerugian' => 'nullable|string',
            'petugas' => 'nullable|array',
            'petugas.*' => 'exists:users,id'
        ]);

        // Jika user login, gunakan user ID sebagai pelapor
        if (Auth::check()) {
            $data['dilaporkan_oleh'] = Auth::user()->id;
        }

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('dokumentasi', 'public');
        }

        $insiden = Insiden::create($data);
        if ($request->has('petugas')) {
            $insiden->petugas()->sync($request->petugas);
        }

        return redirect()->route('insidens.index')->with('success', 'Insiden berhasil ditambahkan.');
    }

    public function edit(Insiden $insiden)
    {
        $users = User::all();
        $petugas_terpilih = $insiden->petugas->pluck('id')->toArray();

        return view('insidens.edit', compact('insiden', 'users', 'petugas_terpilih'));
    }

    public function update(Request $request, Insiden $insiden)
    {
        $data = $request->validate([
            'lokasi' => 'required',
            'waktu_kejadian' => 'required|date',
            'jenis_insiden' => 'nullable|string',
            'status' => 'required',
            'foto' => 'nullable|image|max:2048',
            'catatan' => 'nullable',
            'dilaporkan_oleh' => 'nullable|exists:users,id',
            'nama_pelapor' => 'nullable|string',
            'kontak_pelapor' => 'nullable|string',
            'jumlah_korban' => 'nullable|integer',
            'kerugian' => 'nullable|string',
            'petugas' => 'nullable|array',
            'petugas.*' => 'exists:users,id'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('dokumentasi', 'public');
        }

        $insiden->update($data);
        $insiden->load('petugas');
        $insiden->petugas()->sync($request->petugas ?? []);

        return redirect()->route('insidens.index')->with('success', 'Insiden berhasil diperbarui.');
    }

    public function show(Insiden $insiden)
    {
        $insiden->load(['pelapor', 'petugas']); // eager load
        return view('insidens.show', compact('insiden'));
    }

    public function destroy(Insiden $insiden)
    {
        $insiden->delete();
        return redirect()->route('insidens.index')->with('success', 'Insiden berhasil dihapus.');
    }

    public function exportPdf()
    {
        $data = Insiden::with(['pelapor', 'petugas'])->latest()->get();
        $pdf = Pdf::loadView('insidens.pdf', compact('data'));
        return $pdf->download('laporan_insiden.pdf');
    }


    public function laporan()
    {
        $data = Insiden::with(['pelapor', 'petugas'])->latest()->get();
        return view('insidens.laporan', compact('data'));
    }

    public function exportLaporanLengkapPdf()
    {
        $data = Insiden::with(['pelapor', 'petugas'])->latest()->get();
        $pdf = Pdf::loadView('insidens.pdf-lengkap', compact('data'))->setPaper('a4', 'landscape');
        return $pdf->download('laporan_lengkap_insiden.pdf');
    }
}
