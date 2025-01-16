<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;

Route::get('/', function () { return view('home'); });
Route::get('/about-us', function () { return view('about'); });
Route::get('/our-services', function () { return view('services'); });
Route::get('/our-projects', function () { return view('projects'); });
Route::get('/contact-us', function () { return view('contact'); });

Route::get('/qr-menu-demo', [HomeController::class, 'index'])->name('index');
Route::post('/qr-menu-demo', [HomeController::class, 'addToCart'])->name('addToCart');
Route::get('/sepet', [CartController::class, 'viewCart'])->name('sepet');
Route::post('/sepet', [OrderController::class, 'store'])->name('store');
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/order', [OrderController::class, 'show'])->name('order');
Route::post('/order', [OrderController::class, 'come'])->name('order.come');
Route::post('/cart/decrease/{id}', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');
