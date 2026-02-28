<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController; // <-- TAMBAHKAN INI
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// ROUTE ABOUT (WAJIB LOGIN)
Route::middleware(['auth'])->group(function () {
    
    Route::get('/about', [AboutController::class, 'index'])->name('about');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';