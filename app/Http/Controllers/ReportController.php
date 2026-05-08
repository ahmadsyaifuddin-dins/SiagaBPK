<?php

namespace App\Http\Controllers;

use App\Models\Insiden;
use App\Models\Inventaris;
use App\Models\JadwalSiaga;
use App\Models\Maintenance;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf; // Pastikan library ini sudah terinstal
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Menampilkan Halaman Grid Pusat Laporan (8 Kartu)
     */
    public function index()
    {
        // Kirim data tahun unik dari insiden untuk filter Dropdown Tahun di UI
        $tahunInsiden = Insiden::selectRaw('YEAR(waktu_kejadian) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // Jika kosong, minimal kasih tahun sekarang
        if ($tahunInsiden->isEmpty()) {
            $tahunInsiden = collect([date('Y')]);
        }

        return view('reports.index', compact('tahunInsiden'));
    }

    // =========================================================================
    // 1. LAPORAN REKAPITULASI INSIDEN
    // =========================================================================
    public function cetakInsiden(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        // Query dengan filter bulan dan tahun
        $insidens = Insiden::whereMonth('waktu_kejadian', $bulan)
            ->whereYear('waktu_kejadian', $tahun)
            ->orderBy('waktu_kejadian', 'asc')
            ->get();

        // PERBAIKAN DI SINI: Tambahkan (int) sebelum $bulan
        $namaBulan = Carbon::create()->month((int) $bulan)->translatedFormat('F');

        $pdf = Pdf::loadView('pdf.laporan_insiden', compact('insidens', 'namaBulan', 'tahun'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream("Laporan_Insiden_{$namaBulan}_{$tahun}.pdf");
    }

    public function cetakKerugian(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        $insidens = Insiden::whereIn('status', ['Tiba di TKP', 'Selesai'])
            ->whereMonth('waktu_kejadian', $bulan)
            ->whereYear('waktu_kejadian', $tahun)
            ->orderBy('waktu_kejadian', 'asc')
            ->get();

        $totalKerugian = 0;
        $totalKorban = 0;

        foreach ($insidens as $insiden) {
            if ($insiden->kerugian) {
                // Membersihkan string Rp agar bisa dijumlahkan
                $angkaMurni = preg_replace('/[^0-9]/', '', $insiden->kerugian);
                $totalKerugian += (int) $angkaMurni;
            }
            $totalKorban += (int) $insiden->jumlah_korban;
        }

        $namaBulan = \Carbon\Carbon::create()->month((int) $bulan)->translatedFormat('F');

        $pdf = Pdf::loadView('pdf.laporan_kerugian', compact('insidens', 'totalKerugian', 'totalKorban', 'namaBulan', 'tahun'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream("Laporan_Statistik_Kerugian_{$namaBulan}_{$tahun}.pdf");
    }

    public function cetakKinerja(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        // Mengambil user dan menghitung jumlah insiden yang mereka ikuti HANYA di bulan/tahun terpilih
        $relawans = User::whereIn('role', ['admin', 'petugas_lapangan'])
            ->withCount(['insidens' => function ($query) use ($bulan, $tahun) {
                $query->whereMonth('waktu_kejadian', $bulan)
                    ->whereYear('waktu_kejadian', $tahun);
            }])
            ->orderByDesc('insidens_count')
            ->get();

        $namaBulan = \Carbon\Carbon::create()->month((int) $bulan)->translatedFormat('F');

        $pdf = Pdf::loadView('pdf.laporan_kinerja', compact('relawans', 'namaBulan', 'tahun'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream("Laporan_Kinerja_Anggota_{$namaBulan}_{$tahun}.pdf");
    }

    public function cetakJadwal(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        $jadwals = JadwalSiaga::with('user')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('tanggal', 'asc')
            ->get();

        $namaBulan = \Carbon\Carbon::create()->month((int) $bulan)->translatedFormat('F');

        $pdf = Pdf::loadView('pdf.laporan_jadwal', compact('jadwals', 'namaBulan', 'tahun'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream("Laporan_Jadwal_Piket_{$namaBulan}_{$tahun}.pdf");
    }

    public function cetakInventaris()
    {
        // Ambil data inventaris, urutkan berdasarkan kategori lalu nama barang
        $inventaris = Inventaris::orderBy('kategori', 'asc')
            ->orderBy('nama_barang', 'asc')
            ->get();

        // Load view PDF. Pakai kertas Portrait
        $pdf = Pdf::loadView('pdf.laporan_inventaris', compact('inventaris'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan_Inventaris_SiagaBPK.pdf');
    }

    public function cetakMaintenance(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        $maintenances = Maintenance::with('inventaris')
            ->whereMonth('tanggal_servis', $bulan)
            ->whereYear('tanggal_servis', $tahun)
            ->orderBy('tanggal_servis', 'asc')
            ->get();

        $totalBiaya = $maintenances->where('status', 'Selesai')->sum('biaya');

        $namaBulan = Carbon::create()->month((int) $bulan)->translatedFormat('F');

        $pdf = Pdf::loadView('pdf.laporan_maintenance', compact('maintenances', 'totalBiaya', 'namaBulan', 'tahun'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream("Laporan_Maintenance_{$namaBulan}_{$tahun}.pdf");
    }

    public function cetakKegiatan(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        $kegiatans = \App\Models\Kegiatan::whereMonth('tanggal_kegiatan', $bulan)
            ->whereYear('tanggal_kegiatan', $tahun)
            ->orderBy('tanggal_kegiatan', 'asc')
            ->get();

        $namaBulan = \Carbon\Carbon::create()->month((int) $bulan)->translatedFormat('F');

        $pdf = Pdf::loadView('pdf.laporan_kegiatan', compact('kegiatans', 'namaBulan', 'tahun'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream("Laporan_Kegiatan_{$namaBulan}_{$tahun}.pdf");
    }

    public function cetakKontak()
    {
        // Ambil data user admin dan relawan yang statusnya masih aktif
        $anggotas = User::whereIn('role', ['admin', 'petugas_lapangan'])
            ->where('status_aktif', 1)
            ->orderBy('role', 'asc') // Admin di atas, baru petugas_lapangan
            ->orderBy('name', 'asc')
            ->get();

        // Load view PDF. Pakai kertas Portrait
        $pdf = Pdf::loadView('pdf.laporan_kontak', compact('anggotas'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Buku_Kontak_Anggota_SiagaBPK.pdf');
    }
}
