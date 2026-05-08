<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\KategoriApiController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Bebas Akses Tanpa Token)
|--------------------------------------------------------------------------
*/
Route::post('/login', [AuthController::class, 'getToken']);

// Kategori (Read Only)
Route::get('/kategori', [KategoriApiController::class, 'index']);
Route::get('/kategori/{id}', [KategoriApiController::class, 'show']);

// Product (Read Only)
Route::get('/product', [ProductApiController::class, 'index']);
Route::get('/product/{id}', [ProductApiController::class, 'show']);

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (Wajib Menggunakan Bearer Token)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
    
    // Kategori CRUD (Create, Update, Delete)
    Route::post('/kategori', [KategoriApiController::class, 'store']);
    Route::put('/kategori/{id}', [KategoriApiController::class, 'update']);
    Route::delete('/kategori/{id}', [KategoriApiController::class, 'destroy']);

    // Product CRUD (Create, Update, Delete)
    Route::post('/product', [ProductApiController::class, 'store']);
    Route::put('/product/{id}', [ProductApiController::class, 'update']);
    Route::delete('/product/{id}', [ProductApiController::class, 'destroy']);

    // (Opsional) Route untuk mendapatkan data user yang sedang login via token
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});