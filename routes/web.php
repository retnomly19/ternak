<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TernakController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\LaporanController;

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (Setelah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Semua route di bawah ini hanya bisa diakses jika user sudah login
Route::middleware('auth')->group(function () {

    // 🐄 Data Ternak
    Route::get('/ternak', [TernakController::class, 'index'])->name('ternak.index');
    Route::get('/ternak/create', [TernakController::class, 'create'])->name('ternak.create');
    Route::post('/ternak', [TernakController::class, 'store'])->name('ternak.store');

    // 📋 Aktivitas
    Route::get('/aktivitas', [AktivitasController::class, 'index'])->name('aktivitas.index');

    // 📊 Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

    // 👤 Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');        // Halaman profil (card view)
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');     // Form edit profil
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update.custom'); // Simpan perubahan custom
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');    // Jetstream update (jika pakai PATCH)
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Hapus akun
});

require __DIR__.'/auth.php';
