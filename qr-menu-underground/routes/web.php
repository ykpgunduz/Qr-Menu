<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;

Route::get('/menu', [HomeController::class, 'index'])->name('index');
Route::post('/menu', [HomeController::class, 'addToCart'])->name('addToCart');

Route::get('/sepet', [CartController::class, 'viewCart'])->name('sepet');
Route::post('/sepet', [OrderController::class, 'store'])->name('store');

Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

Route::get('/order', [OrderController::class, 'show'])->name('order');
