<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TernakController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KandangController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Resource routes untuk ternak, kecuali show
    Route::resource('ternak', TernakController::class)->except(['show']);

    // Route khusus untuk delete multiple ternak, metode DELETE
    Route::delete('ternak/delete-multiple', [TernakController::class, 'destroyMultiple'])->name('ternak.destroyMultiple');

    // Aktivitas
    Route::get('aktivitas', [AktivitasController::class, 'index'])->name('aktivitas.index');

    // Laporan
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');

    // Profil user
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // Update profile bisa lewat POST dan PATCH (keduanya mengarah ke update)
    Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update.custom');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');

    // Hapus profile
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Data Kandang
    Route::resource('kandang', KandangController::class);

});

require __DIR__.'/auth.php';
