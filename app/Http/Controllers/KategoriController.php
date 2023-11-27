<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index')->with('data_kategori', $kategori)
        ->with('active', 'active')
        ->with('title', 'Kategori');
    }

   
    public function create()
    {
        return view('kategori.create', [
            'active' => 'active',
            'title' => 'Kategori',
        ]);
    }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required',
        ]);
        
        kategori::create([
            'nama_kategori' => $validatedData['nama_kategori']
        ]);
        // Set flash message
        Session::flash('success', 'Kategori berhasil ditambahkan.');

        return redirect('/kategori');

    }

    
    public function show(Kategori $kategori)
    {
        //
    }

    
    public function edit($id)
    {
        $kategori = Kategori::where('nama_kategori', $id)->first();
        return view('kategori.edit')->with('data_kategori', $kategori)
        ->with('active', 'active')
        ->with('title', 'Kategori');  
    }

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required',
        ]);

        $kategori = Kategori::find($id);
        $kategori->nama_kategori = $validatedData['nama_kategori'];
        $kategori->save();
        // Set flash message
        Session::flash('updated', 'Berhasil update data kategori.');

        return redirect('/kategori');
    }

    
    public function destroy($id)
    {
        Kategori::find($id)->delete();
        // Set flash message
        Session::flash('success', 'Kategori berhasil dihapus.');

        return redirect('/kategori');
    }
}
