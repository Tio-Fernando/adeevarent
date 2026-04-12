<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::post('/midtrans/callback', [BookingController::class, 'midtransCallback'])
    ->name('midtrans.callback');
