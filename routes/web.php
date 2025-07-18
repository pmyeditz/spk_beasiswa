<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\KeputusanController;

/*
|--------------------------------------------------------------------------
| ROUTE TAMU (BELUM LOGIN)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.loading');
});
// Route::get('/', fn() => redirect('/login'));
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login'); // ✅
Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| LUPA PASSWORD - OTP SYSTEM
|--------------------------------------------------------------------------
*/
Route::get('/lupa-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
Route::post('/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('password.sendOtp');
Route::get('/verify-otp', [ForgotPasswordController::class, 'showVerifyForm'])->name('password.verify');
Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('password.verify');
Route::get('/reset-password-form', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset');
/*
|--------------------------------------------------------------------------
| ROUTE SETELAH LOGIN (ADMIN SESSION)
|--------------------------------------------------------------------------
*/
Route::middleware(['admin.session'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');


    // guru
    Route::resource('guru', GuruController::class);

    // Master Data
    Route::resource('siswa', SiswaController::class)->except(['show']);
    Route::get('/siswa/download', [SiswaController::class, 'download'])->name('siswa.download');
    Route::resource('/kelas', KelasController::class)->except(['create', 'edit', 'show']);
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
    Route::resource('/kriteria', KriteriaController::class)->except(['create', 'edit', 'show']);
    Route::resource('/penilaian', PenilaianController::class)->except(['create', 'edit', 'show']);
    Route::resource('/keputusan', KeputusanController::class)->except(['create', 'edit', 'show']);

    // Tambahan SAW
    Route::get('/keputusan/hitung', [KeputusanController::class, 'hitungSAW'])->name('keputusan.hitung');
    Route::get('/keputusan/{nis}/export', [KeputusanController::class, 'exportPDF'])->name('keputusan.export');
});
