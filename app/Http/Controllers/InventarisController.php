<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInventarisRequest;
use App\Http\Requests\UpdateInventarisRequest;
use App\Models\Inventaris;
use Illuminate\Support\Facades\File;

class InventarisController extends Controller
{
    public function index()
    {
        $data = Inventaris::latest()->get();

        return view('inventaris.index', compact('data'));
    }

    public function create()
    {
        // Auto-generate Kode Barang
        $lastBarang = Inventaris::orderBy('id', 'desc')->first();
        $nextId = $lastBarang ? $lastBarang->id + 1 : 1;
        $autoKode = 'BPK-AST-'.str_pad($nextId, 4, '0', STR_PAD_LEFT);

        return view('inventaris.create', compact('autoKode'));
    }

    public function store(StoreInventarisRequest $request)
    {
        // Data sudah otomatis tervalidasi
        $data = $request->validated();

        // Old School Upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/inventaris'), $filename);
            $data['foto'] = 'uploads/inventaris/'.$filename;
        }

        Inventaris::create($data);

        return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil ditambahkan!');
    }

    public function edit(Inventaris $inventari)
    {
        return view('inventaris.edit', compact('inventari'));
    }

    public function update(UpdateInventarisRequest $request, Inventaris $inventari)
    {
        // Data sudah otomatis tervalidasi
        $data = $request->validated();

        // Old School Upload dengan Delete File Lama
        if ($request->hasFile('foto')) {
            if ($inventari->foto && File::exists(public_path($inventari->foto))) {
                File::delete(public_path($inventari->foto));
            }

            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/inventaris'), $filename);
            $data['foto'] = 'uploads/inventaris/'.$filename;
        }

        $inventari->update($data);

        return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil diperbarui!');
    }

    public function destroy(Inventaris $inventari)
    {
        // Hapus fisik file dulu
        if ($inventari->foto && File::exists(public_path($inventari->foto))) {
            File::delete(public_path($inventari->foto));
        }

        $inventari->delete();

        return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil dihapus permanen.');
    }
}
