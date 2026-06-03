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
            $riwayat = Sewa::with(['kendaraan', 'pelanggan', 'payments', 'jaminan'])
                ->where('id_pelanggan', $pelanggan->id_pelanggan)
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
        $validated = $request->validated();
        $user = $request->user();

        $user->fill([
            'nama' => $validated['name'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'] ?? $user->no_hp,
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Determine redirect based on user role
        if ($user->level === 'Superadmin') {
            return Redirect::route('superAdmin.profileSuperAdmin')->with('status', 'profile-updated');
        } elseif ($user->level === 'Administrator') {
            return Redirect::route('admin.profile')->with('status', 'profile-updated');
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    public function updateUser(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        $user->fill([
            'nama' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

    
        $pelanggan = $user->pelanggan;
        if ($pelanggan) {
            $pelanggan->update([
                'nama_pelanggan' => $validated['name'],
                'no_hp' => $validated['no_hp'] ?? $pelanggan->no_hp,
                'alamat' => $validated['address'] ?? $pelanggan->alamat,
            ]);
        } else {
            $user->pelanggan()->create([
                'nama_pelanggan' => $validated['name'],
                'no_hp' => $validated['no_hp'] ?? null,
                'alamat' => $validated['address'] ?? '',
            ]);
        }

        return Redirect::route('profile.user')->with('status', 'profile-updated');
    }

    /**
     * Update the user's password.
     */
    public function changePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = $request->user();
        $user->password = bcrypt($request->password);
        $user->save();
// Determine redirect based on user role
        if ($user->level === 'Superadmin') {
            return Redirect::route('superadmin.profile')->with('status', 'password-updated');
        } elseif ($user->level === 'Administrator') {
            return Redirect::route('admin.profile')->with('status', 'password-updated');
        }

        
        return Redirect::route('profile.user')->with('status', 'password-updated');
    }

    /**
     * Update the admin's profile information.
     */
    public function updateAdmin(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'no_hp' => ['nullable', 'string', 'max:20'],
        ]);

        $user = $request->user();

        $user->fill([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'] ?? $user->no_hp,
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('admin.profile')->with('status', 'profile-updated');
    }

    /**
     * Update the admin's password.
     */
    public function updateAdminPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = $request->user();
        $user->password = bcrypt($request->password);
        $user->save();

        return Redirect::route('admin.profile')->with('status', 'password-updated');
    }

    /**
     * Update the super admin's profile information.
     */
    public function updateSuperAdmin(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'no_hp' => ['nullable', 'string', 'max:20'],
        ]);

        $user = $request->user();

        $user->fill([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'] ?? $user->no_hp,
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('superadmin.profile')->with('status', 'profile-updated');
    }

    /**
     * Update the super admin's password.
     */
    public function updateSuperAdminPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'current_password.current_password' => 'Password saat ini tidak cocok!',
        ]);

        $user = $request->user();
        $user->password = bcrypt($request->password);
        $user->save();

        return Redirect::route('superadmin.profile')->with('status', 'password-updated');
    }

    /**
     * Show the edit admin profile form.
     */
    public function editAdmin(Request $request): View
    {
        return view('admin.editProfileAdmin', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Show the edit super admin profile form.
     */
    public function editSuperAdmin(Request $request): View
    {
        return view('superAdmin.editProfileSuperAdmin', [
            'user' => $request->user(),
        ]);
    }
}
