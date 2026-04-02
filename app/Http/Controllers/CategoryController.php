<?php

namespace App\Http\Controllers;
use SweetAlert2\Laravel\Swal;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Category::latest()->get();
        return view('admin.kategori.index',compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:10'
        ]);

        Category::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        Swal::success([
            'title' => 'Berhasil',
            'text' => 'Kategori berhasil ditambahkan',
            'confirmButtonText' => 'OK',
        ]);

        return redirect()->route('kategori.index')->with('success','data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Category::findOrFail($id);
        return view('admin.kategori.edit',compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'nama_kategori' => 'required|string|max:10'
        ]);

        $kategori = Category::findOrFail($id);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);
        
        
        Swal::success([
            'title' => 'Berhasil',
            'text' => 'Kategori berhasil diupdate',
            'confirmButtonText' => 'OK',
        ]);

        return redirect()->route('kategori.index')->with('success','data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
            public function destroy(string $id)
            {
                $kategori = Category::findOrFail($id);

                try {
                    $kategori->delete();

                    Swal::success([
                        'title' => 'Berhasil!',
                        'text' => 'Data berhasil dihapus',
                    ]);

                } catch (\Exception $e) {
                    Swal::error([
                        'title' => 'Gagal!',
                        'text' => 'Data masih digunakan',
                    ]);
                }

                return redirect()->route('kategori.index');
            }
}
