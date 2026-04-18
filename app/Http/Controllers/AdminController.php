<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'Administrator',
            'status' => 'aktif',
        ]);
        
        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan');
    }

    public function edit(string $id){
        $admin = User::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id){
        $admin = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|string|min:8|confirmed',
            'level' => 'required|in:Administrator',
            'status' => 'required|in:aktif,nonaktif',
        ]);
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
            'status' => $request->status,
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
        $admin->status = $admin->status === 'aktif' ? 'nonaktif' : 'aktif';
        $admin->save();
        
        return redirect()->route('admin.index')->with('success', 'Status admin berhasil diubah');
    }
}
