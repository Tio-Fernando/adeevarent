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
    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::firstOrCreate(
        ['email' => $googleUser->email],
        [
            'nama' => $googleUser->name,
            'google_id' => $googleUser->id,
            'status' => 1,
            'level' => 'Pelanggan',
            'password' => bcrypt(str()->random(16)),
        ]
    );

    // Update nama dan google_id jika user sudah ada tapi data belum lengkap
    $user->update([
        'nama' => $googleUser->name,
        'google_id' => $googleUser->id,
    ]);

    // Create or update Pelanggan record
    $user->pelanggan()->updateOrCreate(
        ['id_user' => $user->id_user],
        [
            'nama_pelanggan' => $googleUser->name,
            'no_hp' => null,
            'alamat' => '',
        ]
    );

    Auth::login($user);
    return redirect()->route('home');
}
}
