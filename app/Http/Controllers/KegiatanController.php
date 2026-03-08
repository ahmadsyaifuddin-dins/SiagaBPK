<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKegiatanRequest;
use App\Http\Requests\UpdateKegiatanRequest;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\File;

class KegiatanController extends Controller
{
    public function index()
    {
        // Urutkan berdasarkan tanggal kegiatan terdekat/terbaru
        $data = Kegiatan::orderBy('tanggal_kegiatan', 'desc')->get();

        return view('kegiatans.index', compact('data'));
    }

    public function create()
    {
        return view('kegiatans.create');
    }

    public function store(StoreKegiatanRequest $request)
    {
        $data = $request->validated();

        // Handling File Upload (Old School Method)
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_kegiatan_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/kegiatan'), $filename);
            $data['foto'] = 'uploads/kegiatan/'.$filename;
        }

        Kegiatan::create($data);

        return redirect()->route('kegiatans.index')->with('success', 'Dokumentasi kegiatan berhasil ditambahkan!');
    }

    public function show(Kegiatan $kegiatan)
    {
        return view('kegiatans.show', compact('kegiatan'));
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('kegiatans.edit', compact('kegiatan'));
    }

    public function update(UpdateKegiatanRequest $request, Kegiatan $kegiatan)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($kegiatan->foto && File::exists(public_path($kegiatan->foto))) {
                File::delete(public_path($kegiatan->foto));
            }

            $file = $request->file('foto');
            $filename = time().'_kegiatan_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/kegiatan'), $filename);
            $data['foto'] = 'uploads/kegiatan/'.$filename;
        }

        $kegiatan->update($data);

        return redirect()->route('kegiatans.index')->with('success', 'Data kegiatan berhasil diperbarui!');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->foto && File::exists(public_path($kegiatan->foto))) {
            File::delete(public_path($kegiatan->foto));
        }

        $kegiatan->delete();

        return redirect()->route('kegiatans.index')->with('success', 'Kegiatan berhasil dihapus secara permanen.');
    }
}
