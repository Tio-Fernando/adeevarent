<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
     
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

//    URL::forceScheme('https');

        RedirectIfAuthenticated::redirectUsing(function () {
            $user = Auth::user();

            if ($user->level === 'SuperAdmin') {
                return route('superadmin.dashboard');
            } elseif ($user->level === 'Administrator') {
                return route('dashboard');
            }

      
            return route('home');
        });
    }
}