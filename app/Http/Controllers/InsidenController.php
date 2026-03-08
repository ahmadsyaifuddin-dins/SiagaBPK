<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInsidenRequest;
use App\Http\Requests\UpdateInsidenRequest;
use App\Models\Insiden;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class InsidenController extends Controller
{
    public function index()
    {
        $data = Insiden::with(['pelapor', 'petugas'])->latest()->get();

        return view('insidens.index', compact('data'));
    }

    public function create()
    {
        // Hanya mengambil user dengan role 'relawan' (sesuai filter di form create.blade.php kamu sebelumnya)
        $users = User::where('role', 'relawan')->get();

        return view('insidens.create', compact('users'));
    }

    public function store(StoreInsidenRequest $request)
    {
        $data = $request->validated();

        // 1. Handling User (Pelapor)
        if (Auth::check()) {
            $data['dilaporkan_oleh'] = Auth::id();
        }

        // 2. Penyesuaian Hak Akses (Keamanan Ekstra)
        if (Auth::user()->role === 'masyarakat') {
            // Masyarakat cuma bisa berstatus 'Dilaporkan'
            $data['status'] = 'Dilaporkan';
        }

        // 3. Handling File Upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/insiden'), $filename);
            $data['foto'] = 'uploads/insiden/'.$filename;
        }

        // 4. Simpan Data Insiden
        $insiden = Insiden::create($data);

        // 5. Sync Petugas (Hanya jika Admin/Relawan yang menginputnya)
        if ($request->has('petugas') && in_array(Auth::user()->role, ['admin', 'relawan'])) {
            $insiden->petugas()->sync($request->petugas);
        }

        // Redirect dengan Pesan Sukses
        return redirect()->route('insidens.index')->with('success', 'Insiden berhasil dilaporkan.');
    }

    public function show(Insiden $insiden)
    {
        $insiden->load(['pelapor', 'petugas']);

        return view('insidens.show', compact('insiden'));
    }

    public function edit(Insiden $insiden)
    {
        $users = User::where('role', 'relawan')->get();
        $petugas_terpilih = $insiden->petugas->pluck('id')->toArray();

        return view('insidens.edit', compact('insiden', 'users', 'petugas_terpilih'));
    }

    public function update(UpdateInsidenRequest $request, Insiden $insiden)
    {
        $data = $request->validated();

        // Handling File Upload (Old School Method)
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($insiden->foto && File::exists(public_path($insiden->foto))) {
                File::delete(public_path($insiden->foto));
            }

            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/insiden'), $filename);
            $data['foto'] = 'uploads/insiden/'.$filename;
        }

        // Update data
        $insiden->update($data);

        // Sync Petugas
        $insiden->petugas()->sync($request->petugas ?? []);

        return redirect()->route('insidens.index')->with('success', 'Insiden berhasil diperbarui.');
    }

    public function destroy(Insiden $insiden)
    {
        // Hapus foto fisik dari folder public sebelum menghapus data dari DB
        if ($insiden->foto && File::exists(public_path($insiden->foto))) {
            File::delete(public_path($insiden->foto));
        }

        $insiden->delete();

        return redirect()->route('insidens.index')->with('success', 'Insiden berhasil dihapus.');
    }

    // --- REPORTING SECTION ---

    public function laporan()
    {
        $data = Insiden::with(['pelapor', 'petugas'])->latest()->get();

        return view('laporan.laporan', compact('data'));
    }

    public function exportPdf()
    {
        $data = Insiden::with(['pelapor', 'petugas'])->latest()->get();
        $pdf = Pdf::loadView('insidens.pdf', compact('data'));

        // Gunakan stream() agar preview di browser dulu
        return $pdf->stream('laporan_insiden.pdf');
    }

    public function exportLaporanLengkapPdf()
    {
        $data = Insiden::with(['pelapor', 'petugas'])->latest()->get();
        $pdf = Pdf::loadView('laporan.pdf-lengkap', compact('data'))->setPaper('a4', 'landscape');

        // Gunakan stream() agar preview di browser dulu
        return $pdf->stream('laporan_lengkap_insiden.pdf');
    }
}
