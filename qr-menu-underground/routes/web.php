<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/menu', [HomeController::class, 'index'])->name('index');
