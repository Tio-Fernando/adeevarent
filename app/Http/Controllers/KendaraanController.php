<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Category;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kendaraan = Kendaraan::with(['category','cabang'])->latest()->get();
        return view('admin.kendaraan.index',compact('kendaraan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategory = Category::all();
        $cabang = Cabang::all();
        return view('admin.kendaraan.create',compact('cabang','kategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'nopol' => 'required|unique:kendaraan,nopol',
            'category_id' => 'required',
            'cabang_id' => 'required',
            'nama_kendaraan' => 'required',
            'transmisi' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
            'warna' => 'required',
            'kondisi' => 'required',
            'bbm' => 'required',
            'tahun' => 'required|numeric',
            'dir' => 'required',
        ]);

        Kendaraan::create($request->all());

        Swal::success([
            'title' => 'Berhasil!',
            'text' => 'Data kendaraan berhasil ditambahkan'
        ]);

        return redirect()->route('kendaraan.index');
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
    public function update(Request $request, string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $request->validate([
            'category_id' => 'required',
            'cabang_id' => 'required',
            'nama_kendaraan' => 'required',
            'transmisi' => 'required',
            'harga' => 'required|numeric',
            'warna' => 'required',
            'kondisi' => 'required',
            'bbm' => 'required',
            'tahun' => 'required|numeric',
        ]);

        $kendaraan->update($request->all());

        Swal::success([
            'title' => 'Berhasil!',
            'text' => 'Data kendaraan berhasil diupdate'
        ]);

        return redirect()->route('kendaraan.index');
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
