<?php

use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Registrasi\RegistrasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

//  Login
Route::get('/login', [LoginController::class, 'index'])->name('login');

// Registrasi
Route::get('/registrasi', [RegistrasiController::class, 'index']);