<?php

namespace App\Http\Controllers;

use App\Models\Insiden;
use App\Models\Inventaris;
use App\Models\JadwalSiaga;
use App\Models\User; // Tambahkan model Inventaris
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalInsiden = Insiden::count();
        $totalUser = User::whereIn('role', ['admin', 'petugas_lapangan', 'kepala_bpk'])->count();
        $totalJadwal = JadwalSiaga::count();
        $relawanHariIni = JadwalSiaga::where('tanggal', Carbon::today())->count();
        $insidenTerbaru = Insiden::latest()->take(5)->get();
        $inventarisKritis = Inventaris::whereIn('kondisi', ['Rusak Ringan', 'Rusak Berat'])->get();

        $stokMenipisCount = Inventaris::whereColumn('jumlah', '<=', 'stok_minimum')->count();
        $kadaluarsaCount = Inventaris::whereNotNull('tanggal_kadaluarsa')
            ->where('tanggal_kadaluarsa', '<=', Carbon::now()->addDays(30))
            ->count();
        $totalNotif = $stokMenipisCount + $kadaluarsaCount;

        return view('dashboard', compact(
            'totalInsiden', 'totalUser', 'totalJadwal', 'relawanHariIni',
            'insidenTerbaru', 'inventarisKritis',
            'stokMenipisCount', 'kadaluarsaCount', 'totalNotif'
        ));
    }
}
