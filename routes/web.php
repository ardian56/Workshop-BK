<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::patch('/dokter/memeriksa/{janji}/toggle-status', [\App\Http\Controllers\Dokter\MemeriksaController::class, 'toggleStatus'])->name('dokter.memeriksa.toggle-status');
Route::get('/dokter/obat/trash', [\App\Http\Controllers\Dokter\ObatController::class, 'trash'])->name('dokter.obat.trash');
Route::post('/dokter/obat/{id}/restore', [\App\Http\Controllers\Dokter\ObatController::class, 'restore'])->name('dokter.obat.restore');

require __DIR__.'/auth.php';
require __DIR__.'/pasien.php';
require __DIR__.'/dokter.php';
