<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('books')->name('books.')->group(function () {
       Route::get('/', [BookController::class, 'index'])->name('index');
       Route::post('/', [BookController::class, 'store'])->name('store');
       Route::post('/{book}', [BookController::class, 'update'])->name('update');
       Route::delete('/{book}', [BookController::class, 'destroy'])->name('destroy');
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
