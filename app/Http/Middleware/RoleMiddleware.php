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
    // 1. Belum login
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();
    
    if ((int) $user->status === 0) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->withErrors([
            'email' => 'Akun Anda dinonaktifkan.'
        ]);
    }

    // 3. Cek role (optional)
    if (!empty($roles)) {
        $userRole = strtolower($user->level);
        $allowedRoles = array_map('strtolower', $roles);

        if (!in_array($userRole, $allowedRoles)) {
            abort(403, 'Tidak punya akses');
        }
    }

    return $next($request);
}
}
