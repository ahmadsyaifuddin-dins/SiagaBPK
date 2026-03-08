<?php

namespace App\Http\Controllers;

use App\Models\Insiden;
use App\Models\Inventaris;
use App\Models\JadwalSiaga;
use App\Models\Kegiatan;
use App\Models\Maintenance;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf; // Pastikan library ini sudah terinstal

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
    public function cetakInsiden()
    {
        // Ambil semua data insiden urut dari yang paling baru
        $insidens = Insiden::orderBy('waktu_kejadian', 'desc')->get();

        // Load view PDF dan kirim datanya
        $pdf = Pdf::loadView('pdf.laporan_insiden', compact('insidens'))
            ->setPaper('a4', 'landscape'); // Pakai landscape agar tabel luas

        // Render PDF langsung di browser (stream)
        return $pdf->stream('Laporan_Insiden_SiagaBPK.pdf');
    }

    public function cetakKerugian()
    {
        // Ambil data insiden yang valid (yang sudah ditangani/selesai)
        $insidens = Insiden::whereIn('status', ['Tiba di TKP', 'Selesai'])
            ->orderBy('waktu_kejadian', 'desc')
            ->get();

        $totalKerugian = 0;
        $totalKorban = 0;

        foreach ($insidens as $insiden) {
            // Trik Ninja: Membersihkan string "Rp 138.465.279" jadi "138465279" (Hanya menyisakan angka)
            if ($insiden->kerugian) {
                $angkaMurni = preg_replace('/[^0-9]/', '', $insiden->kerugian);
                $totalKerugian += (int) $angkaMurni;
            }

            // Menjumlahkan korban
            $totalKorban += (int) $insiden->jumlah_korban;
        }

        $pdf = Pdf::loadView('pdf.laporan_kerugian', compact('insidens', 'totalKerugian', 'totalKorban'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan_Statistik_Kerugian.pdf');
    }

    public function cetakKinerja()
    {
        // Ambil data user (Admin & Relawan) beserta jumlah insiden yang mereka ikuti
        // Urutkan dari yang paling rajin (insidens_count terbanyak)
        $relawans = User::whereIn('role', ['admin', 'relawan'])
            ->withCount('insidens')
            ->orderByDesc('insidens_count')
            ->get();

        // Load view PDF. Pakai kertas Portrait (Berdiri) karena kolomnya tidak terlalu banyak
        $pdf = Pdf::loadView('pdf.laporan_kinerja', compact('relawans'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan_Kinerja_Relawan_SiagaBPK.pdf');
    }

    public function cetakJadwal()
    {
        // Ambil data jadwal siaga beserta data usernya, urutkan dari tanggal terdekat
        $jadwals = JadwalSiaga::with('user')
            ->orderBy('tanggal', 'asc')
            ->get();

        // Load view PDF. Pakai kertas Portrait karena tabelnya standar
        $pdf = Pdf::loadView('pdf.laporan_jadwal', compact('jadwals'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan_Jadwal_Piket_SiagaBPK.pdf');
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

    public function cetakMaintenance()
    {
        // Ambil data pemeliharaan beserta data asetnya, urutkan dari yang terbaru
        $maintenances = Maintenance::with('inventaris')
            ->orderBy('tanggal_servis', 'desc')
            ->get();

        // Hitung grand total seluruh biaya servis
        $totalBiaya = $maintenances->sum('biaya');

        // Load view PDF. Pakai kertas Portrait
        $pdf = Pdf::loadView('pdf.laporan_maintenance', compact('maintenances', 'totalBiaya'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan_Biaya_Pemeliharaan_SiagaBPK.pdf');
    }

    public function cetakKegiatan()
    {
        // Ambil data kegiatan, urutkan dari tanggal pelaksanaan terbaru
        $kegiatans = Kegiatan::orderBy('tanggal_kegiatan', 'desc')->get();

        // Load view PDF. Pakai kertas Landscape agar muat deskripsi panjang
        $pdf = Pdf::loadView('pdf.laporan_kegiatan', compact('kegiatans'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan_Kegiatan_Operasional_SiagaBPK.pdf');
    }

    public function cetakKontak()
    {
        // Ambil data user admin dan relawan yang statusnya masih aktif
        $anggotas = User::whereIn('role', ['admin', 'relawan'])
            ->where('status_aktif', 1)
            ->orderBy('role', 'asc') // Admin di atas, baru relawan
            ->orderBy('name', 'asc')
            ->get();

        // Load view PDF. Pakai kertas Portrait
        $pdf = Pdf::loadView('pdf.laporan_kontak', compact('anggotas'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Buku_Kontak_Anggota_SiagaBPK.pdf');
    }
}
