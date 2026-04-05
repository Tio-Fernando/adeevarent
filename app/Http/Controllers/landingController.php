<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Category;
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

        $kendaraans = $query->latest()->paginate(9);
        $categories = Category::all();

        return view('armada', compact('kendaraans', 'categories'));
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
