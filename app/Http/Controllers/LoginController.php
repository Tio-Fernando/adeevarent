<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Socialite;

class LoginController extends Controller
{
    public function redirectToGoogle() {
    return Socialite::driver('google')->redirect();
}

public function handleGoogleCallback() {
    $googleUser = Socialite::driver('google')->user();
   
    $user = User::updateOrCreate([
        'email' => $googleUser->email,
    ], [
        'name' => $googleUser->name,
        'google_id' => $googleUser->id,
          'status' => true,
        'level' => 'Pelanggan',
        'phone' => null,
        'password' => bcrypt(str()->random(16)), // Kasih password random aja
    ]);

    Auth::login($user);
    return redirect()->route('home');
}
}
