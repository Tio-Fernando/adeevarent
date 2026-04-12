<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SweetAlert2\Laravel\Swal;

class AdminController extends Controller
{
    public function index(){
        $admins = User::where('level','Administrator')->paginate(10);
        return view('admin.index',compact('admins'));
    }

    public function create(){
        return view('admin.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required|string',
            'email' =>'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            ' password_confirmation ' => ' required ',
            'level' => 'required|in:Administrator',
            'status' => 'required|in:aktif:nonaktif',
        ]);
    User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
            'status' => $request->status,
    ]);
    Swal::success([
        'title' => 'Berhasil',
        'text' => 'Berhasil Menambahkan',
        'confirmButtonText' => 'OK',
    ]);
    return redirect()->route('admin.index');
    }

    public function edit(string $id){

    $admin = User::findOrFail($id);
    return view('admin.edit',compact('admin'));
    }


    public function update(Request $request,$id){
     $request->validate([
            'nama' => 'required|string',
            'email' =>'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            ' password_confirmation ' => ' required ',
            'level' => 'required|in:Administrator',
            'status' => 'required|in:aktif:nonaktif',
        ]);
    $admin = User::findOrFail($id);
    
    $admin->update([
        'nama' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'level' => $request->level,
        'status' => $request->status,
    ]);

      Swal::success([
            'title' => 'Berhasil',
            'text' => 'Admin berhasil diupdate',
            'confirmButtonText' => 'OK',
        ]);
    return redirect()->route('admin.index');
    }

    public function destroy(string $id){
    
    $admin = User::findOrFail($id);
    $admin->delete();
     Swal::success([
     'title' => 'Berhasil!',
    'text' => 'Data berhasil dihapus',
                    ]);

    return redirect()->route('admin.index');
    }
}
