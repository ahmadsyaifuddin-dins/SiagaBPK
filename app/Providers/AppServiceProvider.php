<?php

namespace App\Providers;

use App\Models\Inventaris;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Bagikan data Notifikasi Inventaris ke komponen Topbar
        View::composer('layouts.partials.topbar', function ($view) {
            // Hitung barang yang stoknya <= batas minimum
            $stokMenipisCount = Inventaris::whereColumn('jumlah', '<=', 'stok_minimum')->count();

            // Hitung barang (APAR) yang expired atau sisa 30 hari lagi
            $kadaluarsaCount = Inventaris::whereNotNull('tanggal_kadaluarsa')
                ->where('tanggal_kadaluarsa', '<=', Carbon::now()->addDays(30))
                ->count();

            $totalNotif = $stokMenipisCount + $kadaluarsaCount;

            $view->with(compact('stokMenipisCount', 'kadaluarsaCount', 'totalNotif'));
        });
    }
}
