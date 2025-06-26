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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Akses hanya untuk admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('insidens', InsidenController::class);
    Route::resource('jadwal_siaga', JadwalSiagaController::class);
    Route::resource('users', UserController::class);
    
    Route::get('/insidens/export/pdf', [InsidenController::class, 'exportPdf'])->name('insidens.export.pdf');
    Route::get('/jadwal_siaga/export/pdf', [JadwalSiagaController::class, 'exportPdf'])->name('jadwal_siaga.export.pdf');
    // Tambahkan route untuk kelola user jika perlu
});



require __DIR__.'/auth.php';
