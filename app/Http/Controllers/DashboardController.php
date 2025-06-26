<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Insiden;
use App\Models\JadwalSiaga;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
    $totalInsiden = Insiden::count();
    $totalUser = User::count();
    $totalJadwal = JadwalSiaga::count();
    $relawanHariIni = JadwalSiaga::where('tanggal', Carbon::today())->count();

    $insidenTerbaru = Insiden::latest()->take(5)->get();

    return view('dashboard', compact(
        'totalInsiden',
        'totalUser',
        'totalJadwal',
        'relawanHariIni',
        'insidenTerbaru'
    ));
    }
}
