<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'min:8', Rules\Password::defaults()],
            'phone' => ['required','string','max:15'],
            'alamat' => ['required','string','max:255'],
        ]);

 
            DB::beginTransaction();
            try {
                $user = User::create([
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'status' => true,
                    'level' => 'Pelanggan'
                ]);

                Pelanggan::create([
                    'id_user' => $user->id_user, 
                    'nama_pelanggan' => $request->nama,
                    'alamat' => $request->alamat,
                    'no_hp' => $request->phone
                ]);

                DB::commit();

                event(new Registered($user));

                return redirect()->route('login');

            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
}
    }
}
