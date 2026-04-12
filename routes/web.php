<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPelangganController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\landingController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', [landingController::class, 'index'])->name('home');

Route::get('/armada',[landingController::class,'armada'])->name('armada');
Route::get('/fasilitas',[landingController::class,'fasilitas'])->name('fasilitas');
Route::get('/gallery',[landingController::class,'gallery'])->name('gallery');



Route::get('/profilCompany',[landingController::class,'profile'])->name('profileCompany');

Route::get('/hubungiKami',[landingController::class,'hubungi'])->name('hubungi');
Route::resource('laporan',LaporanController::class);

Route::middleware(['auth','role:Administrator'])->group(function(){
    Route::resource('kendaraan',KendaraanController::class);
    Route::resource('kategori', CategoryController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('wilayah',CabangController::class);
    Route::get('/booking',[BookingController::class,'index'])->name('booking.index');
    Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');
    Route::get('/sewa/{id}/detail', [BookingController::class, 'detail'])->name('booking.detail');
    Route::resource('admin/pengguna', AdminPelangganController::class, ['as' => 'admin']);
    Route::post('/booking/{id}',[BookingController::class,'selesai'])->name('penyelesaian');
    });
Route::middleware(['auth','role:Pelanggan'])->group(function(){
    Route::post('/proses-booking/{nopol}', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/armada/{nopol}', [landingController::class, 'detail'])->name('detail');
    Route::get('/pembayaran/{id}', [BookingController::class, 'payment'])->name('payment');
    Route::get('/pelunasan/{id}', [BookingController::class, 'pelunasan'])->name('pelunasan');
    Route::post('/charge-payment/{id}', [BookingController::class, 'chargePayment'])->name('booking.charge');
    Route::get('/payment-status/{id}', [BookingController::class, 'paymentStatus'])->name('booking.status');
});

Route::middleware(['auth','role:SuperAdmin'])->group(function(){
    Route::get('/superAdmin', function () {
        return view('superAdmin');
    })->name('superadmin.dashboard');
    Route::resource('admin',AdminController::class);
    Route::get('/laporanSuper',[landingController::class,'laporanSuper'])->name('laporan.super');
});

Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/user',[ProfileController::class,'editUser'])->name('profile.user');
    Route::get('/profile/user/edit',[ProfileController::class,'editUserForm'])->name('profile.user.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/user', [ProfileController::class, 'updateUser'])->name('profile.user.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

require __DIR__.'/auth.php';
