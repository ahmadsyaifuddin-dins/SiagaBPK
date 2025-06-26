<?php

namespace App\Http\Controllers;

use App\Models\Insiden;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InsidenController extends Controller
{
    public function index()
    {
        $data = Insiden::latest()->get();
        return view('insidens.index', compact('data'));
    }

    public function create()
    {
        return view('insidens.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'lokasi' => 'required',
            'waktu_kejadian' => 'required|date',
            'status' => 'required',
            'foto' => 'nullable|image|max:2048',
            'catatan' => 'nullable'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('dokumentasi', 'public');
        }

        Insiden::create($data);
        return redirect()->route('insidens.index')->with('success', 'Insiden berhasil ditambahkan.');
    }

    public function edit(Insiden $insiden)
    {
        return view('insidens.edit', compact('insiden'));
    }

    public function update(Request $request, Insiden $insiden)
    {
        $data = $request->validate([
            'lokasi' => 'required',
            'waktu_kejadian' => 'required|date',
            'status' => 'required',
            'foto' => 'nullable|image|max:2048',
            'catatan' => 'nullable'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('dokumentasi', 'public');
        }

        $insiden->update($data);
        return redirect()->route('insidens.index')->with('success', 'Insiden berhasil diperbarui.');
    }

    public function destroy(Insiden $insiden)
    {
        $insiden->delete();
        return redirect()->route('insidens.index')->with('success', 'Insiden berhasil dihapus.');
    }


    public function exportPdf()
    {
        $data = Insiden::latest()->get();
        $pdf = Pdf::loadView('insidens.pdf', compact('data'));

        return $pdf->download('laporan_insiden.pdf');
    }
}
