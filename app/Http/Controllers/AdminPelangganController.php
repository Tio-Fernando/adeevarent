<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use SweetAlert2\Laravel\Swal;

class AdminPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $users = User::with('pelanggan')
                     ->where('level', 'Pelanggan')
                     ->when($search, function ($query) use ($search) {
                        return $query->where('email', 'like', '%' . $search . '%')
                            ->orWhere('nama', 'like', '%' . $search . '%')
                            ->orWhereHas('pelanggan', function ($q) use ($search) {
                                $q->where('nama_pelanggan', 'like', '%' . $search . '%')
                                  ->orWhere('no_hp', 'like', '%' . $search . '%')
                                  ->orWhere('alamat', 'like', '%' . $search . '%');
                            });
                     })
                     ->latest()
                     ->paginate(10);
        
        return view('admin.pengguna.index', compact('users', 'search'));
    }

    public function show(string $id)
    {
        $user = User::with('pelanggan')->findOrFail($id);
        
        return response()->json([
            'id_user' => $user->id_user,
            'nama' => $user->pelanggan ? $user->pelanggan->nama_pelanggan : $user->nama,
            'email' => $user->email,
            'no_hp' => $user->pelanggan ? $user->pelanggan->no_hp : null,
            'alamat' => $user->pelanggan ? $user->pelanggan->alamat : null,
            'status' => $user->status,
            'created_at' => $user->created_at->format('d M Y'),
        ]);
    }

    public function create()
    {
        return view('admin.pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:ms_users,email',
            'no_hp'    => 'required|string|max:20',
            'alamat'   => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'nama'     => $request->nama,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'level'    => 'Pelanggan',
                'status'   => 1,
            ]);

            Pelanggan::create([
                'id_user'        => $user->id_user,
                'nama_pelanggan' => $request->nama,
                'no_hp'          => $request->no_hp,
                'alamat'         => $request->alamat,
            ]);
        });

        Swal::success([
            'title'             => 'Berhasil!',
            'text'              => 'Pengguna berhasil ditambahkan.',
            'confirmButtonText' => 'OK',
        ]);

        return redirect()->route('admin.pengguna.index');
    }

    /**
     * Toggle user status (activate/deactivate)
     */
    public function toggleStatus(string $id)
    {
        $user = User::findOrFail($id);
        $user->status = $user->status === 1 ? 0 : 1;
        $user->save();
        
        $statusAsli = $user->status === 1 ? 'Aktif' : 'Nonaktif';

        Swal::success([
            'title'             => 'Berhasil!',
            'text'              => "Pengguna berhasil {$statusAsli}.",
            'confirmButtonText' => 'OK',
        ]);

        return redirect()->route('admin.pengguna.index');
    }

    
}
