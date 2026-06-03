<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Category;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $kendaraans = Kendaraan::with(['category','cabang'])
            ->when($search, function ($query) use ($search) {
                return $query->where('nama_kendaraan', 'like', '%' . $search . '%')
                    ->orWhere('nopol', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('nama_kategori', 'like', '%' . $search . '%');
                    });
            })
            ->latest()
            ->get();
        
        return view('admin.kendaraan.index', compact('kendaraans', 'search'));
    }

  
    public function create()
    {
        $categories = Category::all();
        $cabangs = Cabang::all();
        return view('admin.kendaraan.create',compact('cabangs','categories'));
    }

    public function edit(string $nopol)
    {
        $kendaraan = Kendaraan::findOrFail($nopol);
        $categories = Category::all();
        $cabangs = Cabang::all();

        return view('admin.kendaraan.edit', compact('kendaraan', 'categories', 'cabangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nopol'          => 'required|string|max:20|unique:ms_kendaraan,nopol',
            'id_kategori'    => 'required|exists:ms_kategori,id_kategori',
            'id_cabang'      => 'required|exists:ms_cabang,id_cabang',
            'nama_kendaraan' => 'required|string|max:20',
            'transmisi'      => 'required|in:Matic,Manual',
            'harga'          => 'required|integer|min:0',
            'deskripsi'      => 'required|string',
            'warna'          => 'required|in:Merah,Hitam,Putih',
            'jumlah_kursi'   => 'required|integer|min:1|max:20',
            'kondisi'        => 'required|in:Rusak,Baik',
            'bbm'            => 'required|in:Solar,Pertalite,Pertamax',
            'tahun'          => 'required|integer|digits:4',
            'denda_terlambat' => 'required|integer|min:0',
            'dir'            => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('dir');
        $data['status'] = 'free'; 

        if ($request->hasFile('dir')) {
            $data['dir'] = $request->file('dir')->store('kendaraan', 'public');
        }

        Kendaraan::create($data);
            Swal::success([
            'title' => 'Berhasil',
            'text' => 'Kendaraan baru berhasil ditambahkan',
            'confirmButtonText' => 'OK',
        ]);
        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan baru berhasil ditambahkan.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $nopol)
    {
        $kendaraan = Kendaraan::with(['category', 'cabang'])->findOrFail($nopol);
        return view('admin.kendaraan.detail', compact('kendaraan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, string $nopol)
    {
       $kendaraan = Kendaraan::findOrFail($nopol);

       $request->validate([
            'nopol'          => 'required|string|max:20|unique:ms_kendaraan,nopol,' . $nopol . ',nopol',
            'id_kategori'    => 'required|exists:ms_kategori,id_kategori',
            'id_cabang'      => 'required|exists:ms_cabang,id_cabang',
            'nama_kendaraan' => 'required|string|max:20',
            'transmisi'      => 'required|in:Matic,Manual',
            'harga'          => 'required|integer|min:0',
            'deskripsi'      => 'required|string',
            'warna'          => 'required|in:Merah,Hitam,Putih',
            'jumlah_kursi'   => 'required|integer|min:1|max:20',
            'kondisi'        => 'required|in:Rusak,Baik',
            'bbm'            => 'required|in:Solar,Pertalite,Pertamax',
            'tahun'          => 'required|integer|digits:4',
            'denda_terlambat' => 'required|integer|min:0',
            'dir'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('dir');

        if($request->hasFile('dir')){
            if($kendaraan->dir && Storage::disk('public')->exists($kendaraan->dir)){
                Storage::disk('public')->delete($kendaraan->dir);
            }
            $data['dir'] = $request->file('dir')->store('kendaraan','public');
        }
    
        $kendaraan->update($data);
        $kendaraan->refresh();
    
         Swal::success([
            'title' => 'Berhasil',
            'text' => 'Data mobil ' . $kendaraan->nama_kendaraan . ' berhasil diperbarui!',
            'confirmButtonText' => 'OK',
        ]);

        return redirect()->route('kendaraan.index');
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nopol)
    {
        $kendaraan = Kendaraan::findOrFail($nopol);
        
         try {
                    $kendaraan->delete();

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

        return redirect()->route('kendaraan.index');
    }
}
