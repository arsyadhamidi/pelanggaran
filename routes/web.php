<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Registrasi\RegistrasiController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Verify\VerifyEmailController;
use App\Http\Middleware\CekLevel;
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
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login-action', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('/login-logout', [LoginController::class, 'logout'])->name('login.logout');

// Registrasi
Route::get('/registrasi', [RegistrasiController::class, 'index']);

// Verify
Route::get('/verify', [VerifyEmailController::class, 'index']);

Route::group(['middleware' => ['auth', 'verified']], function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Setting
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');

    // Admin
    Route::group(['middleware' => [CekLevel::class . ':Admin']], function () {});
});
