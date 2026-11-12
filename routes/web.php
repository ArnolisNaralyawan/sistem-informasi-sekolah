<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\PesanController;
use App\Http\Controllers\Admin\DokumentasiController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// LUPA PASSWORD
Route::get('/lupa-password', [PasswordResetController::class, 'showLupaPassword'])->name('password.request');
Route::post('/lupa-password', [PasswordResetController::class, 'kirimLink'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');

// ROUTE UNTUK KIRIM PESAN DARI WEBSITE (PUBLIC)
Route::post('/pesan', [App\Http\Controllers\Admin\PesanController::class, 'storeFromWebsite'])->name('pesan.store');

// GALERI ROUTES (PUBLIC)
Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri');
Route::get('/galeri/{dokumentasi}', [GalleryController::class, 'show'])->name('galeri.show');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::put('/profil/email', [ProfilController::class, 'updateEmail'])->name('profil.email');

    // PENGUMUMAN ROUTES
    Route::resource('pengumuman', PengumumanController::class);

    // PESAN ROUTES
    Route::resource('pesan', PesanController::class);
    Route::post('/pesan/{id}/mark-read', [PesanController::class, 'markAsRead'])->name('pesan.mark-read');
    Route::post('/pesan/mark-all-read', [PesanController::class, 'markAllAsRead'])->name('pesan.mark-all-read');

    // DOKUMENTASI ROUTES
    Route::resource('dokumentasi', DokumentasiController::class);

    // PENGATURAN WEBSITE
    Route::get('/setting', [SettingController::class, 'edit'])->name('setting.edit');
    Route::put('/setting', [SettingController::class, 'update'])->name('setting.update');

    // FASILITAS (konten beranda)
    Route::resource('fasilitas', FasilitasController::class)->except(['show']);

    // PROFIL (ganti password)
    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password');
});
