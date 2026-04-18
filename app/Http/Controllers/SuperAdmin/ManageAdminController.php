<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SweetAlert2\Laravel\Swal;

class ManageAdminController extends Controller
{
    public function index()
    {
        $admins = User::where('level', 'Administrator')->paginate(10);
        return view('superadmin.admin.index', compact('admins'));
    }

    public function create()
    {
        return view('superadmin.admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'level'    => 'Administrator',
            'status'   => 'aktif',
        ]);

        Swal::success([
            'title'             => 'Berhasil!',
            'text'              => 'Admin berhasil ditambahkan.',
            'confirmButtonText' => 'OK',
        ]);

        return redirect()->route('superadmin.admin.index');
    }

    public function edit(string $id)
    {
        $admin = User::findOrFail($id);
        return view('superadmin.admin.edit', compact('admin'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $admin = User::findOrFail($id);

        $data = [
            'nama'  => $request->nama,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        Swal::success([
            'title'             => 'Berhasil!',
            'text'              => 'Admin berhasil diupdate.',
            'confirmButtonText' => 'OK',
        ]);

        return redirect()->route('superadmin.admin.index');
    }

    public function toggleStatus(string $id)
    {
        $admin = User::findOrFail($id);

        $admin->update([
            'status' => $admin->status === 'aktif' ? 'nonaktif' : 'aktif',
        ]);

        Swal::success([
            'title' => 'Berhasil!',
            'text'  => 'Status admin berhasil diubah.',
        ]);

        return redirect()->route('superadmin.admin.index');
    }

    public function destroy(string $id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        Swal::success([
            'title' => 'Berhasil!',
            'text'  => 'Admin berhasil dihapus.',
        ]);

        return redirect()->route('superadmin.admin.index');
    }
}