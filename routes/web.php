<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InsidenController;
use App\Http\Controllers\JadwalSiagaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Bisa diarahkan langsung ke halaman login agar lebih rapi
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| LEVEL 1: AKSES SEMUA USER (Admin, Relawan, Masyarakat)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Utama (Nanti UI-nya dibedakan di dalam Blade)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile bawaan Breeze (Semua user berhak mengedit profil dan password mereka sendiri)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Insiden (Semua user boleh melihat list insiden dan melapor/create insiden baru)
    Route::get('/insidens', [InsidenController::class, 'index'])->name('insidens.index');
    Route::get('/insidens/create', [InsidenController::class, 'create'])->name('insidens.create');
    Route::post('/insidens', [InsidenController::class, 'store'])->name('insidens.store');
    Route::get('/insidens/{insiden}', [InsidenController::class, 'show'])
        ->name('insidens.show')
        ->where('insiden', '[0-9]+'); // hanya angka
});

/*
|--------------------------------------------------------------------------
| LEVEL 2: AKSES ADMIN & RELAWAN (Masyarakat Dilarang Masuk)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin,relawan'])->group(function () {

    // Insiden (Update status insiden - misal dari "Berangkat" ke "Selesai")
    Route::get('/insidens/{insiden}/edit', [InsidenController::class, 'edit'])->name('insidens.edit');
    Route::put('/insidens/{insiden}', [InsidenController::class, 'update'])->name('insidens.update');

    // Jadwal Siaga (Relawan hanya butuh index/melihat jadwal piketnya)
    Route::get('/jadwal_siaga', [JadwalSiagaController::class, 'index'])->name('jadwal_siaga.index');
});

/*
|--------------------------------------------------------------------------
| LEVEL 3: KHUSUS ADMIN SANG PENGUASA (Superuser)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Hapus Insiden (Hanya admin yang boleh menghapus data valid)
    Route::delete('/insidens/{insiden}', [InsidenController::class, 'destroy'])->name('insidens.destroy');

    // Jadwal Siaga (Hanya admin yang bisa membuat, mengedit, dan menghapus jadwal)
    Route::get('/jadwal_siaga/create', [JadwalSiagaController::class, 'create'])->name('jadwal_siaga.create');
    Route::post('/jadwal_siaga', [JadwalSiagaController::class, 'store'])->name('jadwal_siaga.store');
    Route::get('/jadwal_siaga/{jadwal_siaga}/edit', [JadwalSiagaController::class, 'edit'])->name('jadwal_siaga.edit');
    Route::put('/jadwal_siaga/{jadwal_siaga}', [JadwalSiagaController::class, 'update'])->name('jadwal_siaga.update');
    Route::delete('/jadwal_siaga/{jadwal_siaga}', [JadwalSiagaController::class, 'destroy'])->name('jadwal_siaga.destroy');

    // Kelola Petugas/Users (Full CRUD. Relawan tidak perlu lihat ini karena sudah pakai /profile)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Fitur Laporan (Hanya admin yang bisa melihat rekap dan mencetak dokumen PDF)
    Route::get('/laporan-lengkap', [InsidenController::class, 'laporan'])->name('laporan-lengkap');
    Route::get('/laporan-lengkap/export/pdf', [InsidenController::class, 'exportLaporanLengkapPdf'])->name('laporan-lengkap.export.pdf');
    Route::get('/insidens/export/pdf', [InsidenController::class, 'exportPdf'])->name('insidens.export.pdf');
    Route::get('/jadwal_siaga/export/pdf', [JadwalSiagaController::class, 'exportPdf'])->name('jadwal_siaga.export.pdf');
});

require __DIR__.'/auth.php';
