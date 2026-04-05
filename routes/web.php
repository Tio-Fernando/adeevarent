<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\landingController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', [landingController::class, 'index'])->name('home');

Route::get('/armada',[landingController::class,'armada'])->name('armada');
Route::get('/fasilitas',[landingController::class,'fasilitas'])->name('fasilitas');
Route::get('/gallery',[landingController::class,'gallery'])->name('gallery');

Route::resource('laporan',LaporanController::class);

Route::middleware(['auth','role:Administrator'])->group(function(){
    Route::resource('kendaraan',KendaraanController::class);
    Route::resource('kategori', CategoryController::class);
    Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
    Route::resource('wilayah',CabangController::class);
    Route::get('/booking',[BookingController::class,'index'])->name('booking.index');
    });
Route::middleware(['auth','role:Pelanggan'])->group(function(){
Route::post('/proses-booking/{nopol}', [BookingController::class, 'store'])->name('booking.store');
Route::get('/armada/{nopol}',[landingController::class,'detail'])->name('detail');
Route::get('/pembayaran/{id}', [BookingController::class, 'payment'])->name('payment');
Route::post('/charge-payment/{id}', [BookingController::class, 'chargePayment'])->name('charge.payment');
});

Route::middleware(['auth','role:SuperAdmin'])->group(function(){
    Route::get('/superAdmin', function () {
        return view('superAdmin');
    })->name('superadmin.dashboard');
    Route::resource('admin',AdminController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/user',[ProfileController::class,'editUser'])->name('profile.user');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
