<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class AdminPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Pelanggan::with('user')
                         ->latest()
                         ->get()
                         ->map(function($pelanggan) {
                             $pelanggan->user->pelanggan = $pelanggan;
                             return $pelanggan->user;
                         });
        
        return view('admin.pengguna.index', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        $pelanggan = Pelanggan::where('id_user', $id)->firstOrFail();
        
        return response()->json([
            'nama' => $pelanggan->nama_pelanggan,
            'alamat' => $pelanggan->alamat,
            'email' => $user->email,
            'phone' => $user->phone,
            'status' => $pelanggan->status,
            'created_at' => $user->created_at->format('d M Y')
        ]);
    }
}
