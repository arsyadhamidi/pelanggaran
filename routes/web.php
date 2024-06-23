<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Registrasi\RegistrasiController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Middleware\CekLevel;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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
Route::post('/registrasi-action', [RegistrasiController::class, 'store'])->name('registrasi.store');

// Verified Email
Route::get('/email/verify', function () {
    return view('verify');
})->middleware('auth')->name('verification.notice');

// Verifikasi email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Mengirim ulang link verifikasi
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Tautan verifikasi telah dikirim ulang!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::group(['middleware' => ['auth', 'verified']], function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Setting
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');

    // Admin
    Route::group(['middleware' => [CekLevel::class . ':Admin']], function () {});
});
