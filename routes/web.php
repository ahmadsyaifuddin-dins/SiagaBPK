<?php

use App\Http\Controllers\InsidenController;
use App\Http\Controllers\JadwalSiagaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard umum
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Akses semua user (auth) termasuk relawan
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users (Relawan bisa edit dan melihat detail id akun miliknya)
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
    ->middleware('can:edit-user,user');
    Route::put('/users/{user}', [UserController::class, 'update'])
    ->middleware('can:edit-user,user');
    
    // Insidens (read only untuk relawan)
    Route::get('/insidens', [InsidenController::class, 'index'])->name('insidens.index');
    Route::get('/insidens/{insiden}', [InsidenController::class, 'show'])->name('insidens.show');

    // Jadwal Siaga dan User (read only)
    Route::get('/jadwal_siaga', [JadwalSiagaController::class, 'index'])->name('jadwal_siaga.index');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Laporan lengkap (read only)
    Route::get('/laporan-lengkap', [InsidenController::class, 'laporan'])->name('laporan-lengkap');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Akses khusus admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    // CRUD Insiden (tanpa resource)
    Route::get('/insidens/create', [InsidenController::class, 'create'])->name('insidens.create');
    Route::post('/insidens', [InsidenController::class, 'store'])->name('insidens.store');
    Route::get('/insidens/{insiden}/edit', [InsidenController::class, 'edit'])->name('insidens.edit');
    Route::put('/insidens/{insiden}', [InsidenController::class, 'update'])->name('insidens.update');
    Route::delete('/insidens/{insiden}', [InsidenController::class, 'destroy'])->name('insidens.destroy');

    // Jadwal Siaga (CRUD)
    Route::get('/jadwal_siaga/create', [JadwalSiagaController::class, 'create'])->name('jadwal_siaga.create');
    Route::post('/jadwal_siaga', [JadwalSiagaController::class, 'store'])->name('jadwal_siaga.store');
    Route::get('/jadwal_siaga/{jadwal_siaga}/edit', [JadwalSiagaController::class, 'edit'])->name('jadwal_siaga.edit');
    Route::put('/jadwal_siaga/{jadwal_siaga}', [JadwalSiagaController::class, 'update'])->name('jadwal_siaga.update');
    Route::delete('/jadwal_siaga/{jadwal_siaga}', [JadwalSiagaController::class, 'destroy'])->name('jadwal_siaga.destroy');

    // User (CRUD)
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Export PDF
    Route::get('/laporan-lengkap/export/pdf', [InsidenController::class, 'exportLaporanLengkapPdf'])->name('laporan-lengkap.export.pdf');
    Route::get('/insidens/export/pdf', [InsidenController::class, 'exportPdf'])->name('insidens.export.pdf');
    Route::get('/jadwal_siaga/export/pdf', [JadwalSiagaController::class, 'exportPdf'])->name('jadwal_siaga.export.pdf');
});

require __DIR__.'/auth.php';
