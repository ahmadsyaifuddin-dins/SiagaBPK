<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Inventaris;
use App\Http\Requests\StoreMaintenanceRequest;
use App\Http\Requests\UpdateMaintenanceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MaintenanceController extends Controller
{
    /**
     * Menampilkan form tambah riwayat servis.
     * Menerima parameter ?inventaris_id= agar dropdown aset otomatis terpilih.
     */
    public function create(Request $request)
    {
        // Ambil semua aset untuk pilihan dropdown
        $inventaris = Inventaris::orderBy('nama_barang', 'asc')->get();
        
        // Tangkap ID aset dari URL jika ada (biar user tidak usah milih manual lagi)
        $selected_inventaris_id = $request->query('inventaris_id');

        return view('maintenances.create', compact('inventaris', 'selected_inventaris_id'));
    }

    /**
     * Menyimpan riwayat servis ke database.
     */
    public function store(StoreMaintenanceRequest $request)
    {
        // 1. Validasi sudah ditangani oleh Request
        $data = $request->validated();

        // 2. Upload Nota Servis (Old School)
        if ($request->hasFile('nota_servis')) {
            $file = $request->file('nota_servis');
            $filename = time() . '_nota_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/maintenance'), $filename);
            $data['nota_servis'] = 'uploads/maintenance/' . $filename;
        }

        // 3. Simpan Data
        Maintenance::create($data);

        // 4. Redirect kembali ke halaman Detail Aset
        return redirect()->route('inventaris.show', $data['inventaris_id'])
            ->with('success', 'Riwayat servis dan pemeliharaan berhasil dicatat!');
    }

    /**
     * Menampilkan form edit riwayat servis.
     */
    public function edit(Maintenance $maintenance)
    {
        $inventaris = Inventaris::orderBy('nama_barang', 'asc')->get();
        return view('maintenances.edit', compact('maintenance', 'inventaris'));
    }

    /**
     * Memperbarui data riwayat servis.
     */
    public function update(UpdateMaintenanceRequest $request, Maintenance $maintenance)
    {
        $data = $request->validated();

        // Upload Nota Baru & Hapus Nota Lama
        if ($request->hasFile('nota_servis')) {
            if ($maintenance->nota_servis && File::exists(public_path($maintenance->nota_servis))) {
                File::delete(public_path($maintenance->nota_servis));
            }

            $file = $request->file('nota_servis');
            $filename = time() . '_nota_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/maintenance'), $filename);
            $data['nota_servis'] = 'uploads/maintenance/' . $filename;
        }

        $maintenance->update($data);

        return redirect()->route('inventaris.show', $maintenance->inventaris_id)
            ->with('success', 'Data pemeliharaan berhasil diperbarui!');
    }

    /**
     * Menghapus riwayat servis secara permanen.
     */
    public function destroy(Maintenance $maintenance)
    {
        // Simpan ID inventaris sebelum datanya dihapus untuk keperluan redirect
        $inventaris_id = $maintenance->inventaris_id;

        // Hapus fisik file nota
        if ($maintenance->nota_servis && File::exists(public_path($maintenance->nota_servis))) {
            File::delete(public_path($maintenance->nota_servis));
        }

        $maintenance->delete();

        return redirect()->route('inventaris.show', $inventaris_id)
            ->with('success', 'Catatan servis berhasil dihapus.');
    }
}