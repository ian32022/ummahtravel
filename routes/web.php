<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;

// Public routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');
Route::get('/daftar-umroh', [PageController::class, 'packages'])->name('packages');
Route::get('/umroh-saya', [PageController::class, 'myUmrah'])->name('my.umrah');
Route::get('/hubungi-kami', [PageController::class, 'contact'])->name('contact');

// Package detail pages
Route::get('/paket/umroh-dubai', [PageController::class, 'packageDubai'])->name('package.dubai');
Route::get('/paket/umroh-turki', [PageController::class, 'packageTurki'])->name('package.turki');
Route::get('/paket/umroh-reguler', [PageController::class, 'packageReguler'])->name('package.reguler');

// Booking process
Route::get('/form-pemesanan', [PageController::class, 'bookingForm'])->name('booking.form');
Route::get('/konfirmasi-pemesanan', [PageController::class, 'confirmation'])->name('booking.confirmation');

// Authentication
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'webLogin']);
Route::post('/logout', [AuthController::class, 'webLogout'])->name('logout');
Route::post('/register', [AuthController::class, 'webRegister'])->name('register');

// Contact form
Route::post('/kontak', [ContactController::class, 'webStore'])->name('contact.store');

// Booking form
Route::post('/pesan', [BookingController::class, 'webStore'])->name('booking.store');
Route::post('/upload-bukti-bayar', [BookingController::class, 'webUploadPayment'])->name('booking.upload');

// Protected routes - User
Route::middleware(['auth'])->group(function () {
    Route::get('/profil', [PageController::class, 'profile'])->name('profile');
    Route::put('/profil/update', [PageController::class, 'updateProfile'])->name('profile.update');
});

// Protected routes - Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/beranda', [PageController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/kelola-paket', [PageController::class, 'adminManagePackages'])->name('manage.packages');
    Route::get('/verifikasi-pembayaran', [PageController::class, 'adminVerifyPayments'])->name('verify.payments');
    
    // API-like routes for admin
    Route::post('/paket/tambah', [\App\Http\Controllers\PackageController::class, 'webStore'])->name('packages.store');
    Route::put('/paket/{id}/update', [\App\Http\Controllers\PackageController::class, 'webUpdate'])->name('packages.update');
    Route::delete('/paket/{id}/hapus', [\App\Http\Controllers\PackageController::class, 'webDestroy'])->name('packages.destroy');
    Route::post('/tanggal/tambah', [\App\Http\Controllers\PackageController::class, 'webAddDate'])->name('dates.store');
    Route::put('/pembayaran/{id}/verifikasi', [BookingController::class, 'adminVerifyPayment'])->name('payment.verify');
    Route::delete('/pendaftar/{id}/hapus', [BookingController::class, 'adminDelete'])->name('booking.delete');
});
