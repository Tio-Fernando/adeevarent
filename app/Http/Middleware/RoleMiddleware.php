<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if(!$user->status){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->withErrors([
                'email' => 'Akun Anda telah dinonaktifkan. Silakan hubungi Owner.'
            ]);
        }

        if(!empty($roles) && !in_array($user->level,$roles)){
            abort(403,'Anda tidak memilik Akses');
        }

        return $next($request);
    }
}
