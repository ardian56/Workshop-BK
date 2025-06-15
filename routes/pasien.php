<?php

use App\Http\Controllers\pasien\RiwayatPeriksaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');

    Route::prefix('janjiperiksa')->group(function () {
        Route::get('/', [App\Http\Controllers\Pasien\JanjiPeriksaController::class, 'index'])->name('pasien.janjiperiksa.index');
        Route::post('/', [App\Http\Controllers\Pasien\JanjiPeriksaController::class, 'store'])->name('pasien.janjiperiksa.store');
    });

    Route::prefix('riwayatperiksa')->group(function(){
        Route::get('/', [RiwayatPeriksaController::class, 'index'])->name('pasien.riwayatperiksa.index');
        Route::get('/{id}/detail', [RiwayatPeriksaController::class, 'detail'])->name('pasien.riwayatperiksa.detail');
        Route::get('/{id}/riwayat', [RiwayatPeriksaController::class, 'riwayat'])->name('pasien.riwayatperiksa.riwayat');
    });
});

