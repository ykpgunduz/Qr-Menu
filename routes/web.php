<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReceiptController;

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
Route::post('/cart/update/{id}', [CartController::class, 'ajaxUpdate'])->name('cart.ajaxUpdate');
Route::post('/cart/remove/{id}', [CartController::class, 'ajaxRemove'])->name('cart.ajaxRemove');
Route::get('/cart/get-items', [CartController::class, 'getCartItems'])->name('cart.getItems');
Route::get('/admin/adisyon/{table_number}', [ReceiptController::class, 'show'])->name('receipt.show');
Route::get('/print-receipt/{calculation}', [ReceiptController::class, 'print'])->name('print.receipt');
Route::get('/past-order/{orderNumber}', [OrderController::class, 'showPastOrder'])->name('past.order.show');
Route::get('/rating/{orderNumber}', [RatingController::class, 'screen'])->name('rating.show');
Route::post('rating/{orderNumber}', [RatingController::class, 'store'])->name('rating.store');
