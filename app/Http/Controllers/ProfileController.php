<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Sewa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    
    /**
     * Show the user profile page.
     */
    public function editUser(Request $request): View
    {
        $user = Auth::user();

        return view('userProfile', [
            'user' => $user,
        ]);
    }

    /**
     * Show the edit user profile form.
     */
    public function editUserForm(Request $request): View
    {
        return view('editUserProfile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Show the rental history page.
     */
    public function rentalHistory(Request $request): View
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan;

        $riwayat = [];
        if ($pelanggan) {
            $riwayat = Sewa::with(['kendaraan', 'pelanggan', 'payments'])
                ->where('pelanggan_id', $pelanggan->id)
                ->latest()
                ->get();
        }

        return view('rentalHistory', [
            'user' => $user,
            'riwayat' => $riwayat,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    public function updateUser(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Update atau create pelanggan record
        $pelanggan = $user->pelanggan;
        if ($pelanggan) {
            $pelanggan->update([
                'nama_pelanggan' => $validated['name'],
                'alamat' => $validated['address'] ?? $pelanggan->alamat,
            ]);
        } else {
            $user->pelanggan()->create([
                'nama_pelanggan' => $validated['name'],
                'alamat' => $validated['address'] ?? '',
            ]);
        }

        return Redirect::route('profile.user')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
