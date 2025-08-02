<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('products', ProductController::class);

    Route::post('products/{id}/receipt', [ProductController::class, 'addStock'])->name('products.receipt');
    Route::post('products/{id}/used', [ProductController::class, 'reduceStock'])->name('products.used');
});

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

Route::get('/products/export', [App\Http\Controllers\ProductController::class, 'exportCsv'])->name('products.export');

require __DIR__.'/auth.php';
