<?php

namespace App\Http\Controllers;

use App\Models\Insiden;
use App\Models\Inventaris;
use App\Models\Maintenance;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf; // Pastikan library ini sudah terinstal
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
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = Insiden::query();

        if ($startDate && $endDate) {
            // Tambahkan waktu 00:00:00 dan 23:59:59 agar full 1 hari tercakup
            $query->whereBetween('waktu_kejadian', [$startDate.' 00:00:00', $endDate.' 23:59:59']);
            $periode = \Carbon\Carbon::parse($startDate)->translatedFormat('d M Y').' s/d '.\Carbon\Carbon::parse($endDate)->translatedFormat('d M Y');
        } else {
            $periode = 'Semua Waktu (All Time)';
        }

        $insidens = $query->orderBy('waktu_kejadian', 'asc')->get();

        $pdf = Pdf::loadView('pdf.laporan_insiden', compact('insidens', 'periode'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan_Insiden.pdf');
    }

    public function cetakKerugian(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = Insiden::whereIn('status', ['Tiba di TKP', 'Selesai']);

        if ($startDate && $endDate) {
            $query->whereBetween('waktu_kejadian', [$startDate.' 00:00:00', $endDate.' 23:59:59']);
            $periode = \Carbon\Carbon::parse($startDate)->translatedFormat('d M Y').' s/d '.\Carbon\Carbon::parse($endDate)->translatedFormat('d M Y');
        } else {
            $periode = 'Semua Waktu (All Time)';
        }

        $insidens = $query->orderBy('waktu_kejadian', 'asc')->get();

        $totalKerugian = 0;
        $totalKorban = 0;

        foreach ($insidens as $insiden) {
            if ($insiden->kerugian) {
                $angkaMurni = preg_replace('/[^0-9]/', '', $insiden->kerugian);
                $totalKerugian += (int) $angkaMurni;
            }
            $totalKorban += (int) $insiden->jumlah_korban;
        }

        $pdf = Pdf::loadView('pdf.laporan_kerugian', compact('insidens', 'totalKerugian', 'totalKorban', 'periode'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan_Statistik_Kerugian.pdf');
    }

    public function cetakKinerja(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if ($startDate && $endDate) {
            $relawans = User::whereIn('role', ['admin', 'petugas_lapangan'])
                ->withCount(['insidens' => function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('waktu_kejadian', [$startDate.' 00:00:00', $endDate.' 23:59:59']);
                }])
                ->orderByDesc('insidens_count')
                ->get();
            $periode = \Carbon\Carbon::parse($startDate)->translatedFormat('d M Y').' s/d '.\Carbon\Carbon::parse($endDate)->translatedFormat('d M Y');
        } else {
            $relawans = User::whereIn('role', ['admin', 'petugas_lapangan'])
                ->withCount('insidens')
                ->orderByDesc('insidens_count')
                ->get();
            $periode = 'Semua Waktu (All Time)';
        }

        $pdf = Pdf::loadView('pdf.laporan_kinerja', compact('relawans', 'periode'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan_Kinerja_Anggota.pdf');
    }

    public function cetakJadwal(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = \App\Models\JadwalSiaga::with('user');

        if ($startDate && $endDate) {
            $query->whereBetween('tanggal', [$startDate, $endDate]);
            $periode = \Carbon\Carbon::parse($startDate)->translatedFormat('d M Y').' s/d '.\Carbon\Carbon::parse($endDate)->translatedFormat('d M Y');
        } else {
            $periode = 'Semua Waktu (All Time)';
        }

        $jadwals = $query->orderBy('tanggal', 'asc')->get();

        $pdf = Pdf::loadView('pdf.laporan_jadwal', compact('jadwals', 'periode'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan_Jadwal_Piket.pdf');
    }

    public function cetakMaintenance(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = Maintenance::with('inventaris');

        if ($startDate && $endDate) {
            $query->whereBetween('tanggal_servis', [$startDate, $endDate]);
            $periode = \Carbon\Carbon::parse($startDate)->translatedFormat('d M Y').' s/d '.\Carbon\Carbon::parse($endDate)->translatedFormat('d M Y');
        } else {
            $periode = 'Semua Waktu (All Time)';
        }

        $maintenances = $query->orderBy('tanggal_servis', 'asc')->get();
        $totalBiaya = $maintenances->where('status', 'Selesai')->sum('biaya');

        $pdf = Pdf::loadView('pdf.laporan_maintenance', compact('maintenances', 'totalBiaya', 'periode'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan_Maintenance.pdf');
    }

    public function cetakKegiatan(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = \App\Models\Kegiatan::query();

        if ($startDate && $endDate) {
            $query->whereBetween('tanggal_kegiatan', [$startDate.' 00:00:00', $endDate.' 23:59:59']);
            $periode = \Carbon\Carbon::parse($startDate)->translatedFormat('d M Y').' s/d '.\Carbon\Carbon::parse($endDate)->translatedFormat('d M Y');
        } else {
            $periode = 'Semua Waktu (All Time)';
        }

        $kegiatans = $query->orderBy('tanggal_kegiatan', 'asc')->get();

        $pdf = Pdf::loadView('pdf.laporan_kegiatan', compact('kegiatans', 'periode'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan_Kegiatan.pdf');
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
