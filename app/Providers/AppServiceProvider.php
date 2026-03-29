<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Logika untuk mengatur arah tendangan Middleware Guest
        RedirectIfAuthenticated::redirectUsing(function () {
            $user = Auth::user();

            if ($user->level === 'SuperAdmin') {
                return route('dashboard.super');
            } elseif ($user->level === 'Administrator') {
                return route('dashboard');
            }

            // Jika dia user biasa/Pelanggan, arahkan ke home
            return route('home');
        });
    }
}