<?php

namespace App\Http\Controllers;

use App\Models\Insiden;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MonitoringController extends Controller
{
    public function index(Request $request)
    {
        // ===== FILTER =====
        $tahun = $request->filled('tahun') ? (int) $request->tahun : Carbon::now()->year;
        $kecamatan = $request->filled('kecamatan') ? $request->kecamatan : null;
        $jenisInsiden = $request->filled('jenis_insiden') ? $request->jenis_insiden : null;

        // Daftar tahun yang tersedia untuk filter
        $daftarTahun = Insiden::selectRaw('DISTINCT YEAR(waktu_kejadian) as tahun')
            ->orderByDesc('tahun')
            ->pluck('tahun')
            ->map(fn ($t) => (int) $t)
            ->push(Carbon::now()->year)
            ->unique()
            ->sortDesc()
            ->values();

        // Query dasar sesuai filter
        $query = Insiden::query()
            ->whereYear('waktu_kejadian', $tahun);

        if ($kecamatan) {
            $query->where('kecamatan', $kecamatan);
        }

        if ($jenisInsiden) {
            $query->where('jenis_insiden', $jenisInsiden);
        }

        $insidensTerfilter = (clone $query)->get();

        // ===== STATISTIK UTAMA =====
        $statistik = [
            'total_insiden' => $insidensTerfilter->count(),
            'total_meninggal' => $insidensTerfilter->sum('korban_meninggal'),
            'total_luka' => $insidensTerfilter->sum('korban_luka_berat') + $insidensTerfilter->sum('korban_luka_ringan'),
            'total_jiwa_terdampak' => $insidensTerfilter->sum('korban_jiwa_terdampak'),
            'total_mengungsi_kk' => $insidensTerfilter->sum('korban_mengungsi_kk'),
            'total_mengungsi_jiwa' => $insidensTerfilter->sum('korban_mengungsi_jiwa'),
            'total_rumah_terbakar' => $insidensTerfilter->sum('rumah_terbakar'),
            'total_rumah_rusak' => $insidensTerfilter->sum('rumah_rusak'),
            'total_bangunan_lain' => $insidensTerfilter->sum('bangunan_lain_terdampak'),
            'total_kendaraan' => $insidensTerfilter->sum('kendaraan_terbakar'),
            'total_luas_dampak' => round((float) $insidensTerfilter->sum('luas_area_dampak'), 2),
            'total_kerugian' => $insidensTerfilter->sum('kerugian_material'),
            'belum_selesai' => $insidensTerfilter->where('status', '!=', 'Selesai')->count(),
        ];

        // ===== DATA CHART =====

        // 1. Tren insiden per bulan
        $perBulan = (clone $query)
            ->selectRaw("MONTH(waktu_kejadian) as bulan, COUNT(*) as jumlah,
                SUM(korban_meninggal + korban_luka_berat + korban_luka_ringan) as korban")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');

        $chartBulanLabels = [];
        $chartBulanInsiden = [];
        $chartBulanKorban = [];

        for ($i = 1; $i <= 12; $i++) {
            $chartBulanLabels[] = Carbon::create(null, $i)->translatedFormat('M');
            $chartBulanInsiden[] = (int) ($perBulan[$i]->jumlah ?? 0);
            $chartBulanKorban[] = (int) ($perBulan[$i]->korban ?? 0);
        }

        // 2. Rekap per kecamatan (hanya wilayah Kota Banjarmasin)
        $rekapRows = (clone $query)
            ->whereIn('kecamatan', Insiden::KECAMATAN_BANJARMASIN)
            ->groupBy('kecamatan')
            ->selectRaw("kecamatan, COUNT(*) as jumlah_insiden,
                SUM(korban_meninggal) as meninggal,
                SUM(korban_luka_berat + korban_luka_ringan) as luka,
                SUM(korban_mengungsi_kk) as mengungsi_kk,
                SUM(korban_mengungsi_jiwa) as mengungsi_jiwa,
                SUM(rumah_terbakar) as rumah_terbakar,
                SUM(rumah_terbakar + rumah_rusak) as total_rumah,
                SUM(kerugian_material) as kerugian")
            ->get()
            ->keyBy('kecamatan');

        $rekapKecamatan = collect(Insiden::KECAMATAN_BANJARMASIN)
            ->map(function ($nama) use ($rekapRows) {
                return $rekapRows[$nama]
                    ?? (object) ['kecamatan' => $nama, 'jumlah_insiden' => 0, 'meninggal' => 0, 'luka' => 0, 'mengungsi_kk' => 0, 'mengungsi_jiwa' => 0, 'rumah_terbakar' => 0, 'total_rumah' => 0, 'kerugian' => 0];
            });

        $chartKecamatanLabels = $rekapKecamatan->pluck('kecamatan')->map(fn ($k) => str_replace('Banjarmasin ', '', $k));
        $chartKecamatanInsiden = $rekapKecamatan->pluck('jumlah_insiden');

        // 3. Distribusi jenis insiden (top 8 + lainnya)
        $jenisData = (clone $query)
            ->selectRaw('jenis_insiden, COUNT(*) as jumlah')
            ->whereNotNull('jenis_insiden')
            ->groupBy('jenis_insiden')
            ->orderByDesc('jumlah')
            ->limit(8)
            ->get();

        $chartJenisLabels = $jenisData->pluck('jenis_insiden');
        $chartJenisValues = $jenisData->pluck('jumlah');

        // 4. Top kelurahan rawan (5 teratas)
        $topKelurahan = (clone $query)
            ->whereNotNull('kelurahan')
            ->selectRaw('kelurahan, kecamatan, COUNT(*) as jumlah, SUM(rumah_terbakar) as rumah')
            ->groupBy('kelurahan', 'kecamatan')
            ->orderByDesc('jumlah')
            ->limit(5)
            ->get();

        // ===== DAFTAR JENIS INSIDEN UNTUK FILTER =====
        $daftarJenis = Insiden::whereNotNull('jenis_insiden')
            ->distinct()
            ->orderBy('jenis_insiden')
            ->pluck('jenis_insiden');

        // ===== INSIDEN TERBARU (sesuai filter) =====
        $insidenTerbaru = (clone $query)
            ->with(['pelapor', 'petugas'])
            ->latest('waktu_kejadian')
            ->take(8)
            ->get();

        return view('monitoring.index', compact(
            'tahun', 'kecamatan', 'jenisInsiden',
            'daftarTahun', 'daftarJenis',
            'statistik', 'rekapKecamatan', 'topKelurahan', 'insidenTerbaru',
            'chartBulanLabels', 'chartBulanInsiden', 'chartBulanKorban',
            'chartKecamatanLabels', 'chartKecamatanInsiden',
            'chartJenisLabels', 'chartJenisValues'
        ));
    }
}
