<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth','role:Administrator'])->group(function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
});

Route::middleware(['auth','role:Pelanggan'])->group(function(){
    Route::get('/beranda', function () {
        return view('home');
    })->middleware(['auth', 'verified'])->name('home');
});


Route::middleware(['auth','role:SuperAdmin'])->group(function(){
    Route::get('/superAdmin', function () {
        return view('superAdmin');
    })->name('dashboard.super');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
