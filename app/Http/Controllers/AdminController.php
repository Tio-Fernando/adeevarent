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
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:ms_users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        try{

            User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'level' => 'Administrator',
                'status' => True,
            ]);
    
      Swal::success([
            'title' => 'Berhasil',
            'text' => 'Admin berhasil ditambahkan',
            'confirmButtonText' => 'OK',
        ]);            
            
            return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan');
        }catch(\Exception $e){

        return back()->with('error', 'Gagal menambahkan Admin'. $e);

        }
    }

    public function edit(string $id){
        $admin = User::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id){
        $admin = User::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:ms_users,email,' . $admin->id_user . ',id_user',
            'password' => 'nullable|string|min:8|confirmed',
            'status' => 'required|in:aktif,nonaktif',
        ]);
        
        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'level' => 'Administrator',
            'status' => $request->status == 'aktif' ? 1 : 0,
        ];
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        
        $admin->update($data);
        
        return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui');
    }

    public function destroy(string $id){
        $admin = User::findOrFail($id);
        $admin->delete();
        
        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus');
    }

    public function toggleStatus(string $id){
        $admin = User::findOrFail($id);
        $admin->status = $admin->status == 1 ? 0 : 1;
        $admin->save();
        
        return redirect()->route('admin.index')->with('success', 'Status admin berhasil diubah');
    }
}
