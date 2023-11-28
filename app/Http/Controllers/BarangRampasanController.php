<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use App\Models\Barang_rampasan;
use App\Models\Kategori;


class BarangRampasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang_rampasan::with('kategori')->get();
        return view('barangRampasan.index')->with('data_barang', $barang)
        ->with('active', 'active')
        ->with('title', 'Barang Rampasan');
    }

    
    public function create()
    {
        $kategori = Kategori::all();
        return view('barangRampasan.create')->with('data_kategori', $kategori)
        ->with('active', 'active')
        ->with('title', 'Barang Rampasan');
    }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'no_putusan' => 'required',
            'kategori_id' => ['required',
                            function ($attribute, $value, $fail) {
                                if ($value === '0') {
                                    $fail('Please select a valid category.');
                                }
                            },],
            'deskripsi' => 'required',
            'foto_thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_barang' => 'required',
        ]);
        
        // Simpan foto
        if ($request->hasFile('foto_thumbnail')) {
            $image = $request->file('foto_thumbnail');
            $path = $image->storeAs('public/photos', time() . '.' . $image->getClientOriginalExtension());
            // Resize gambar sebelum disimpan
            Image::make($image)->fit(150, 150)->save(storage_path('app/' . $path));
            $url = Storage::url($path);
        }

        barang_rampasan::create([
            'nama_barang' => $validatedData['nama_barang'],
            'no_putusan' => $validatedData['no_putusan'],
            'kategori_id' => $validatedData['kategori_id'],
            'deskripsi' => $validatedData['deskripsi'],
            'foto_thumbnail' => $url,
            'foto_barang' => $validatedData['foto_barang'],
        ]);
        // Set flash message
        Session::flash('success', 'Barang rampasan berhasil ditambahkan.');

        return redirect('/barang-rampasan');
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $kategori = Kategori::all();
        $barang = Barang_rampasan::where('nama_barang', $id)->first();
        return view('barangRampasan.edit')
            ->with('data_barang', $barang)
            ->with('data_kategori', $kategori)
            ->with('active', 'active')
            ->with('title', 'Barang Rampasan'); 
    }

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'no_putusan' => 'required',
            'kategori_id' => ['required',
                            function ($attribute, $value, $fail) {
                                if ($value === '0') {
                                    $fail('Please select a valid category.');
                                }
                            },],
            'deskripsi' => 'required',
            'foto_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_barang' => 'required',
        ]);

        $barang = Barang_rampasan::find($id);

        if ($request->hasFile('foto_thumbnail')) {
            $image = $request->file('foto_thumbnail');
            $path = $image->storeAs('public/photos', time() . '.' . $image->getClientOriginalExtension());
            // Resize gambar sebelum disimpan
            Image::make($image)->fit(150, 150)->save(storage_path('app/' . $path));
            $url = Storage::url($path);
            $barang->foto_thumbnail = $url;
        }

        $barang->nama_barang = $validatedData['nama_barang'];
        $barang->no_putusan = $validatedData['no_putusan'];
        $barang->kategori_id = $validatedData['kategori_id'];
        $barang->deskripsi = $validatedData['deskripsi'];
        $barang->foto_barang = $validatedData['foto_barang'];
        $barang->save();
        // Set flash message
        Session::flash('updated', 'Berhasil update data barang rampasan.');

        return redirect('/barang-rampasan');


    }

    public function destroy($id)
    {
        Barang_rampasan::find($id)->delete();
        // Set flash message
        Session::flash('success', 'Barang rampasan berhasil dihapus.');

        return redirect('/barang-rampasan');
    }
}
