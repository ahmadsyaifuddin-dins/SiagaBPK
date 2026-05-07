<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InsidenController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\JadwalSiagaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| LEVEL 1: AKSES SEMUA USER (Admin, Petugas Lapangan, Kepala BPK)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile bawaan Breeze (Semua user berhak mengedit profil dan password mereka sendiri)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| LEVEL 2: OPERASIONAL LAPANGAN (Admin & Petugas Lapangan)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin,petugas_lapangan'])->group(function () {

    // Insiden (Melihat list insiden dan melapor/create insiden baru serta update)
    Route::get('/insidens', [InsidenController::class, 'index'])->name('insidens.index');
    Route::get('/insidens/create', [InsidenController::class, 'create'])->name('insidens.create');
    Route::post('/insidens', [InsidenController::class, 'store'])->name('insidens.store');
    Route::get('/insidens/{insiden}', [InsidenController::class, 'show'])
        ->name('insidens.show')
        ->where('insiden', '[0-9]+'); // hanya angka
    Route::get('/insidens/{insiden}/edit', [InsidenController::class, 'edit'])->name('insidens.edit');
    Route::put('/insidens/{insiden}', [InsidenController::class, 'update'])->name('insidens.update');

    // Jadwal Siaga (Petugas Lapangan hanya butuh index/melihat jadwal piketnya)
    Route::get('/jadwal_siaga', [JadwalSiagaController::class, 'index'])->name('jadwal_siaga.index');

    // Dokumentasi Kegiatan
    Route::resource('kegiatans', KegiatanController::class);

});

/*
|--------------------------------------------------------------------------
| LEVEL 3: MASTER DATA & MANAJEMEN (Khusus Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Hapus Insiden (Hanya admin yang boleh menghapus data valid)
    Route::delete('/insidens/{insiden}', [InsidenController::class, 'destroy'])->name('insidens.destroy');

    // Inventaris & Maintenance
    Route::resource('inventaris', InventarisController::class);
    Route::resource('maintenances', MaintenanceController::class)->except(['index', 'show']);
    Route::get('/maintenances-calendar-data', [MaintenanceController::class, 'getCalendarData'])->name('maintenances.calendar.data');

    // Jadwal Siaga (Hanya admin yang bisa membuat, mengedit, dan menghapus jadwal)
    Route::get('/jadwal_siaga/create', [JadwalSiagaController::class, 'create'])->name('jadwal_siaga.create');
    Route::post('/jadwal_siaga', [JadwalSiagaController::class, 'store'])->name('jadwal_siaga.store');
    Route::get('/jadwal_siaga/{jadwal_siaga}/edit', [JadwalSiagaController::class, 'edit'])->name('jadwal_siaga.edit');
    Route::put('/jadwal_siaga/{jadwal_siaga}', [JadwalSiagaController::class, 'update'])->name('jadwal_siaga.update');
    Route::delete('/jadwal_siaga/{jadwal_siaga}', [JadwalSiagaController::class, 'destroy'])->name('jadwal_siaga.destroy');

    // Kelola Petugas/Users (Full CRUD. Petugas Lapangan/Kepala BPK cukup pakai /profile)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

});

/*
|--------------------------------------------------------------------------
| LEVEL 4: ADMINISTRASI & LAPORAN (Admin & Kepala BPK)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin,kepala_bpk'])->group(function () {

    // Fitur Laporan (Hanya admin & kepala bpk yang bisa melihat rekap dan mencetak dokumen PDF)
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Rute cetak dikembalikan secara utuh satu per satu tanpa ada yang hilang
    Route::get('/reports/insiden', [ReportController::class, 'cetakInsiden'])->name('reports.cetak.insiden');
    Route::get('/reports/kerugian', [ReportController::class, 'cetakKerugian'])->name('reports.cetak.kerugian');
    Route::get('/reports/kinerja', [ReportController::class, 'cetakKinerja'])->name('reports.cetak.kinerja');
    Route::get('/reports/jadwal', [ReportController::class, 'cetakJadwal'])->name('reports.cetak.jadwal');
    Route::get('/reports/inventaris', [ReportController::class, 'cetakInventaris'])->name('reports.cetak.inventaris');
    Route::get('/reports/maintenance', [ReportController::class, 'cetakMaintenance'])->name('reports.cetak.maintenance');
    Route::get('/reports/kegiatan', [ReportController::class, 'cetakKegiatan'])->name('reports.cetak.kegiatan');
    Route::get('/reports/kontak', [ReportController::class, 'cetakKontak'])->name('reports.cetak.kontak');

    Route::get('/laporan-lengkap', [InsidenController::class, 'laporan'])->name('laporan-lengkap');
    Route::get('/laporan-lengkap/export/pdf', [InsidenController::class, 'exportLaporanLengkapPdf'])->name('laporan-lengkap.export.pdf');
    Route::get('/insidens/export/pdf', [InsidenController::class, 'exportPdf'])->name('insidens.export.pdf');
    Route::get('/jadwal_siaga/export/pdf', [JadwalSiagaController::class, 'exportPdf'])->name('jadwal_siaga.export.pdf');

});

require __DIR__.'/auth.php';
