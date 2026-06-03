<?php

use App\Http\Controllers\Admin\AdminPaymentController;
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
use App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\JaminanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [landingController::class, 'index'])->name('home');

Route::get('/armada',[landingController::class,'armada'])->name('armada');
Route::get('/fasilitas',[landingController::class,'fasilitas'])->name('fasilitas');
Route::get('/gallery',[landingController::class,'gallery'])->name('gallery');
Route::get('/laporan/excel', [LaporanController::class, 'exportExcel'])->name('laporan.export');
Route::get('/profilCompany',[landingController::class,'profile'])->name('profileCompany');

Route::get('/hubungiKami',[landingController::class,'hubungi'])->name('hubungi');
Route::resource('laporan',LaporanController::class);

Route::middleware(['auth', 'role:Administrator'])->group(function () {
    Route::resource('kendaraan', KendaraanController::class);
    Route::resource('kategori', CategoryController::class);

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/admin/profile', function () {
        return view('admin.profileAdmin');
    })->name('admin.profile');

    Route::get('/admin/profile/edit', [ProfileController::class, 'editAdmin'])->name('admin.profile.edit');
    Route::patch('/admin/profile/update', [ProfileController::class, 'updateAdmin'])->name('admin.profile.update');
    Route::put('/admin/password/update', [ProfileController::class, 'updateAdminPassword'])->name('admin.password.update');

    Route::resource('wilayah', CabangController::class);

    Route::get('/booking', [BookingController::class, 'index'])
        ->name('booking.index');

    Route::get('/booking/create', [BookingController::class, 'createBooking'])
        ->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'storeBooking'])
        ->name('booking.storeAdmin');

    Route::get('/booking/{id}/payment', [BookingController::class, 'adminPaymentPage'])
        ->name('booking.admin.payment');
    Route::get('/booking/{id}/pelunasan', [BookingController::class, 'adminPelunasanPage'])
        ->name('booking.admin.pelunasan');

    Route::get('/booking/{id}', [BookingController::class, 'show'])
        ->name('booking.show');

    Route::get('/sewa/{id}/detail', [BookingController::class, 'detail'])
        ->name('booking.detail');

    Route::resource('admin/pengguna', AdminPelangganController::class, ['as' => 'admin']);

    Route::post('/booking/{id}', [BookingController::class, 'selesai'])
        ->name('penyelesaian');

    Route::post(
        '/admin/payment/{id}/konfirmasi',
        [AdminPaymentController::class, 'konfirmasi']
    )->name('admin.payment.konfirmasi');

    Route::post(
        '/admin/payment/{id}/lunas',    
        [AdminPaymentController::class, 'konfirmasiLunas']
    )->name('admin.payment.konfirmasiLunas');
    Route::post(
        '/admin/payment/{id}/batal',
        [AdminPaymentController::class, 'batal']
    )->name('admin.payment.batal');
    Route::patch('pengguna/status/{id}',[AdminPelangganController::class,'toggleStatus']
    )->name('pelanggan.status');

    Route::get('/sewa/{id_tr_sewa}/jaminan', [JaminanController::class, 'adminShow']
    )->name('admin.jaminan.show');
    Route::get('/booking/{id_tr_sewa}/jaminan', [JaminanController::class, 'adminShowForm'])->name('booking.admin.jaminan');
    Route::post('/booking/{id_tr_sewa}/jaminan', [JaminanController::class, 'adminStore'])->name('booking.admin.jaminan.store');
});


Route::middleware(['auth','role:Pelanggan'])->group(function(){
    Route::post('/proses-booking/{nopol}', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/armada/{nopol}', [landingController::class, 'detail'])->name('detail');
    Route::get('/pembayaran/{id}', [BookingController::class, 'payment'])->name('payment');
    Route::get('/pelunasan/{id}', [BookingController::class, 'pelunasan'])->name('pelunasan');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/user',[ProfileController::class,'editUser'])->name('profile.user');
    Route::get('/profile/user/edit',[ProfileController::class,'editUserForm'])->name('profile.user.edit');
    Route::get('/profile/rental-history',[ProfileController::class,'rentalHistory'])->name('profile.rental-history');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/user', [ProfileController::class, 'updateUser'])->name('profile.user.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('password.update');
    Route::get('/jaminan/{id_tr_sewa}', [JaminanController::class, 'show'])->name('jaminan.show');
    Route::post('/jaminan/{id_tr_sewa}', [JaminanController::class, 'store'])->name('jaminan.store');
    Route::get('/jaminan/{id_tr_sewa}/view', [JaminanController::class, 'getUserJaminan'])->name('jaminan.view');

    });


Route::middleware(['auth','role:SuperAdmin'])->group(function(){
    Route::get('/superAdmin', [SuperAdmin::class,'index'])->name('superadmin.dashboard');
    Route::get('/superAdmin/profile/edit', [ProfileController::class, 'editSuperAdmin'])->name('superadmin.profile.edit');
    Route::get('/superAdmin/profile', function () {
        return view('superAdmin.profileSuperAdmin');
    })->name('superadmin.profile');
    Route::patch('/superAdmin/profile/update', [ProfileController::class, 'updateSuperAdmin'])->name('superadmin.profile.update');
    Route::post('/superAdmin/password/update', [ProfileController::class, 'updateSuperAdminPassword'])->name('superadmin.password.update');
    Route::resource('admin',AdminController::class);
    Route::patch('admin/status/{id}',[AdminController::class,'toggleStatus'])->name('toggle');
    Route::get('/laporanSuper',[LaporanController::class,'superIndex'])->name('laporan.super');
});

Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::middleware('auth')->group(function () {
        Route::get('/payment-status/{id}', [BookingController::class, 'paymentStatus'])->name('booking.status');
    Route::post('/charge-payment/{id}', [BookingController::class, 'chargePayment'])->name('booking.charge');
    
});

Route::middleware(['auth'])->group(function () {
    Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
    Route::get('/invoice/{id}/download', [InvoiceController::class, 'download'])->name('invoice.download');
});

Route::middleware(['auth', 'role:Administrator'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
    Route::get('/invoice/{id}/download', [InvoiceController::class, 'download'])->name('invoice.download');
});


require __DIR__.'/auth.php';
