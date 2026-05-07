<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInventarisRequest;
use App\Http\Requests\UpdateInventarisRequest;
use App\Models\Inventaris;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

    public function show(Inventaris $inventari)
    {
        return view('inventaris.show', compact('inventari'));
    }

    public function store(StoreInventarisRequest $request)
    {
        $data = $request->validated();

        // 1. Upload Foto (Old School)
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/inventaris'), $filename);
            $data['foto'] = 'uploads/inventaris/'.$filename;
        }

        // 2. Generate QR Code
        $qrFilename = 'qr_'.time().'_'.$data['kode_barang'].'.svg'; // SVG lebih tajam & ringan
        $qrPath = public_path('uploads/qr_codes');

        if (! File::exists($qrPath)) {
            File::makeDirectory($qrPath, 0755, true);
        }

        // QR Code berisi URL untuk melihat detail barang (Sangat berguna saat di-scan pakai HP)
        $qrContent = route('inventaris.show', ['inventari' => 0]); // Placeholder
        QrCode::format('svg')->size(300)->margin(1)->generate($data['kode_barang'], $qrPath.'/'.$qrFilename);
        $data['qr_code'] = 'uploads/qr_codes/'.$qrFilename;

        Inventaris::create($data);

        return redirect()->route('inventaris.index')->with('success', 'Data inventaris & QR Code berhasil dibuat!');
    }

    public function edit(Inventaris $inventari)
    {
        return view('inventaris.edit', compact('inventari'));
    }

    public function update(UpdateInventarisRequest $request, Inventaris $inventari)
    {
        $data = $request->validated();

        // 1. Upload Foto Baru (Jika Ada)
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($inventari->foto && File::exists(public_path($inventari->foto))) {
                File::delete(public_path($inventari->foto));
            }
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/inventaris'), $filename);
            $data['foto'] = 'uploads/inventaris/'.$filename;
        }

        // 2. SELF-HEALING QR CODE: Buat QR Code jika belum ada atau file fisiknya hilang
        if (empty($inventari->qr_code) || ! File::exists(public_path($inventari->qr_code))) {

            $qrFilename = 'qr_'.time().'_'.$data['kode_barang'].'.svg';
            $qrPath = public_path('uploads/qr_codes');

            // Pastikan folder tersedia
            if (! File::exists($qrPath)) {
                File::makeDirectory($qrPath, 0755, true);
            }

            // Generate QR Code baru
            // Pastikan use SimpleSoftwareIO\QrCode\Facades\QrCode; ada di bagian atas file
            QrCode::format('svg')->size(300)->margin(1)->generate($data['kode_barang'], $qrPath.'/'.$qrFilename);

            // Simpan path ke database
            $data['qr_code'] = 'uploads/qr_codes/'.$qrFilename;
        }

        // 3. Update Data
        $inventari->update($data);

        return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil diperbarui dan QR Code dipastikan aman!');
    }

    public function destroy(Inventaris $inventari)
    {
        // Hapus fisik foto
        if ($inventari->foto && File::exists(public_path($inventari->foto))) {
            File::delete(public_path($inventari->foto));
        }
        // Hapus fisik QR Code
        if ($inventari->qr_code && File::exists(public_path($inventari->qr_code))) {
            File::delete(public_path($inventari->qr_code));
        }

        $inventari->delete();

        return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil dihapus permanen.');
    }
}
