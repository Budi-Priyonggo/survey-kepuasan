<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstansiController;

Route::get('/', [HasilController::class, 'index'])->name('home');
Route::resource('hasil', HasilController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('instansi', InstansiController::class);
});

require __DIR__ . '/auth.php';
