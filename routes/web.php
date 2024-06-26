<?php

use App\Http\Controllers\Admin\AdminGuruController;
use App\Http\Controllers\Admin\AdminJenisPelanggaranController;
use App\Http\Controllers\Admin\AdminJurusanController;
use App\Http\Controllers\Admin\AdminKelasController;
use App\Http\Controllers\Admin\AdminLevelController;
use App\Http\Controllers\Admin\AdminUserController;
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
    Route::post('/setting/updateprofile', [SettingController::class, 'updateprofile'])->name('setting.updateprofile');
    Route::post('/setting/updateemail', [SettingController::class, 'updateemail'])->name('setting.updateemail');
    Route::post('/setting/updatepassword', [SettingController::class, 'updatepassword'])->name('setting.updatepassword');
    Route::post('/setting/updategambar', [SettingController::class, 'updategambar'])->name('setting.updategambar');
    Route::post('/setting/hapusgambar', [SettingController::class, 'hapusgambar'])->name('setting.hapusgambar');

    // Admin
    Route::group(['middleware' => [CekLevel::class . ':1']], function () {

        // Jenis Pelanggaran
        Route::get('/data-jenispelanggaran', [AdminJenisPelanggaranController::class, 'index'])->name('data-jenispelanggaran.index');
        Route::get('/data-jenispelanggaran/create', [AdminJenisPelanggaranController::class, 'create'])->name('data-jenispelanggaran.create');
        Route::get('/data-jenispelanggaran/edit/{id}', [AdminJenisPelanggaranController::class, 'edit'])->name('data-jenispelanggaran.edit');
        Route::post('/data-jenispelanggaran/store', [AdminJenisPelanggaranController::class, 'store'])->name('data-jenispelanggaran.store');
        Route::post('/data-jenispelanggaran/update/{id}', [AdminJenisPelanggaranController::class, 'update'])->name('data-jenispelanggaran.update');
        Route::post('/data-jenispelanggaran/destroy/{id}', [AdminJenisPelanggaranController::class, 'destroy'])->name('data-jenispelanggaran.destroy');

        // Data Guru
        Route::get('/data-guru', [AdminGuruController::class, 'index'])->name('data-guru.index');
        Route::get('/data-guru/create', [AdminGuruController::class, 'create'])->name('data-guru.create');
        Route::get('/data-guru/edit/{id}', [AdminGuruController::class, 'edit'])->name('data-guru.edit');
        Route::post('/data-guru/store', [AdminGuruController::class, 'store'])->name('data-guru.store');
        Route::post('/data-guru/update/{id}', [AdminGuruController::class, 'update'])->name('data-guru.update');
        Route::post('/data-guru/destroy/{id}', [AdminGuruController::class, 'destroy'])->name('data-guru.destroy');

        // Kelas
        Route::get('/data-kelas', [AdminKelasController::class, 'index'])->name('data-kelas.index');
        Route::get('/data-kelas/create', [AdminKelasController::class, 'create'])->name('data-kelas.create');
        Route::get('/data-kelas/edit/{id}', [AdminKelasController::class, 'edit'])->name('data-kelas.edit');
        Route::post('/data-kelas/store', [AdminKelasController::class, 'store'])->name('data-kelas.store');
        Route::post('/data-kelas/update/{id}', [AdminKelasController::class, 'update'])->name('data-kelas.update');
        Route::post('/data-kelas/destroy/{id}', [AdminKelasController::class, 'destroy'])->name('data-kelas.destroy');

        // Level
        Route::get('/data-level', [AdminLevelController::class, 'index'])->name('data-level.index');
        Route::get('/data-level/create', [AdminLevelController::class, 'create'])->name('data-level.create');
        Route::get('/data-level/edit/{id}', [AdminLevelController::class, 'edit'])->name('data-level.edit');
        Route::post('/data-level/store', [AdminLevelController::class, 'store'])->name('data-level.store');
        Route::post('/data-level/update/{id}', [AdminLevelController::class, 'update'])->name('data-level.update');
        Route::post('/data-level/destroy/{id}', [AdminLevelController::class, 'destroy'])->name('data-level.destroy');

        // Data Jurusan
        Route::get('/data-jurusan', [AdminJurusanController::class, 'index'])->name('data-jurusan.index');
        Route::get('/data-jurusan/create', [AdminJurusanController::class, 'create'])->name('data-jurusan.create');
        Route::get('/data-jurusan/edit/{id}', [AdminJurusanController::class, 'edit'])->name('data-jurusan.edit');
        Route::post('/data-jurusan/store', [AdminJurusanController::class, 'store'])->name('data-jurusan.store');
        Route::post('/data-jurusan/update/{id}', [AdminJurusanController::class, 'update'])->name('data-jurusan.update');
        Route::post('/data-jurusan/destroy/{id}', [AdminJurusanController::class, 'destroy'])->name('data-jurusan.destroy');

        // User Registrasi
        Route::get('/user-registrasi', [AdminUserController::class, 'index'])->name('data-user.index');
        Route::get('/user-registrasi/create', [AdminUserController::class, 'create'])->name('data-user.create');
        Route::get('/user-registrasi/edit/{id}', [AdminUserController::class, 'edit'])->name('data-user.edit');
        Route::post('/user-registrasi/store', [AdminUserController::class, 'store'])->name('data-user.store');
        Route::post('/user-registrasi/update/{id}', [AdminUserController::class, 'update'])->name('data-user.update');
        Route::post('/user-registrasi/destroy/{id}', [AdminUserController::class, 'destroy'])->name('data-user.destroy');
    });
});
