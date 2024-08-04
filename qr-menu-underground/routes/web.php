<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/menu', [HomeController::class, 'index'])->name('index');
Route::post('/menu', [HomeController::class, 'addToCart'])->name('addToCart');
Route::get('/sepet', [HomeController::class, 'viewCart'])->name('sepet');
Route::delete('/cart/remove/{id}', [HomeController::class, 'removeFromCart'])->name('cart.remove');
