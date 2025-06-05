<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');

    Route::prefix('janjiperiksa')->group(function () {
        Route::get('/', [App\Http\Controllers\Pasien\JanjiPeriksaController::class, 'index'])->name('pasien.janjiperiksa.index');
        Route::post('/', [App\Http\Controllers\Pasien\JanjiPeriksaController::class, 'store'])->name('pasien.janjiperiksa.store');
    });
});

