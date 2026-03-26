<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cabang = Cabang::latest()->get();

        return view('admin.wilayah.index',compact('cabang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.wilayah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
            'lokasi' => 'required|string|max:20'
        ]);

        Cabang::create([
            'lokasi' => $request->lokasi
        ]);

        Swal::success([
            'title' => 'Berhasil',
            'text' => 'Cabang berhasil ditambahkan',
            'confirmButtonText' => 'OK',
        ]);

        return redirect()->route('wilayah.index')->with('success','data berhasil ditambahkan');
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
        $cabang = Cabang::findOrFail($id);

        return view('admin.wilayah.edit',compact('cabang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'lokasi' => 'required|string|max:20'
        ]);

        $cabang = Cabang::findOrFail($id);

        $cabang->update([
            'lokasi' => $request->lokasi
        ]);

        Swal::success([
            'title' => 'Berhasil',
            'text' => 'Cabang berhasil diupdate',
            'confirmButtonText' => 'OK',
        ]);

        return redirect()->route('wilayah.index')->with('success','data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cabang = Cabang::findOrFail($id);

             try {
                    $cabang->delete();

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

                return redirect()->route('wilayah.index');
            }
}
