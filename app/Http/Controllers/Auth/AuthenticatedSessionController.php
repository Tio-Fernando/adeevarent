<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View|RedirectResponse
    {

        if (Auth::check()) {

            $user = Auth::user();

            if ($user->level === 'Superadmin') {
                return redirect()->route('superadmin.dashboard');
            } elseif ($user->level === 'Administrator') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('home');
            }
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
    
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        if ((int) $user->status === 0) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'email' => 'Akun Anda dinonaktifkan.'
            ]);
        }

        if($user->level === 'Superadmin'){
            return redirect()->intended(route('superadmin.dashboard'));
        }elseif ($user->level === 'Administrator') {
             return redirect()->intended(route('dashboard'));
        } else {
            return redirect()->intended(route('home'));
        }

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
