<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Kendaraan;
use App\Models\Category;
use App\Models\Sewa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class landingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kendaraans = Kendaraan::with(['category','cabang'])->latest()->take(6)->get();
        return view('welcome',compact('kendaraans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function armada(Request $request)
    {
        $query = Kendaraan::with(['category', 'cabang']);

        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request){
                $q->where('nama_kategori', $request->category);
            });
        }
        if ($request->filled('lokasi')) {
       $query->whereHas('cabang', function($q) use ($request){
                $q->where('lokasi', $request->lokasi);
            });
    }

        $kendaraans = $query->latest()->paginate(9);
        $cabangs = Cabang::all();
        $categories = Category::all();

        return view('armada', compact('kendaraans', 'categories', 'cabangs'));
    }


    public function detail(Request $request,$nopol){
        $kendaraan = Kendaraan::with(['cabang','category'])->findOrFail($nopol);

        return view('detail',compact('kendaraan'));
    }

    public function fasilitas()
    {
        return view('fasilitas');
    }

    public function gallery()
    {
        return view('gallery');
    }

    public function hubungi(){
        return view('hubungiKami');
    }

    public function profile(){
        return view('profileCompany');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function laporanSuper(){
        return view('owner.laporan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mobil = Kendaraan::with(['category', 'cabang'])->findOrFail($id);
        return view('armada_detail', compact('mobil'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function riwayat(){
      
    }

}
