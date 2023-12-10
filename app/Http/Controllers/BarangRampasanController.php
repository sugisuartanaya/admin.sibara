<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Barang_rampasan;
use App\Models\Kategori;
use App\Models\Harga_wajar;


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
            'nama_terdakwa' => 'required',
            'no_putusan' => 'required',
            'tgl_putusan' => 'required',
            'kategori_id' => ['required',
                            function ($attribute, $value, $fail) {
                                if ($value === '0') {
                                    $fail('Please select a valid category.');
                                }
                            },],
            'deskripsi' => 'required',
            'foto_thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_barang.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Simpan foto
        if ($request->hasFile('foto_thumbnail')) {
            $image = $request->file('foto_thumbnail');
            $path = $image->storeAs('public/photos', time() . '.' . $image->getClientOriginalExtension());
            // Resize gambar sebelum disimpan
            Image::make($image)->fit(150, 150)->save(storage_path('app/' . $path));
            $url_foto_thumbnail = Storage::url($path);
        }

        if ($request->hasFile('foto_barang')) {
            if (count($request->file('foto_barang')) <= 5) {
                $foto_paths = [];
                foreach ($request->file('foto_barang') as $image) {
                $path = $image->storeAs('public/photos/products', uniqid() . '.' . $image->getClientOriginalExtension());
                // Resize gambar sebelum disimpan
                Image::make($image)->fit(800, 650)->save(storage_path('app/' . $path));
                $url_foto_barang = Storage::url($path);

                $foto_paths[] = $url_foto_barang;
            }
            $url_foto_barang = json_encode($foto_paths);
            $url_foto_barang = stripslashes($url_foto_barang);
            } else{
                Session::flash('error', 'Foto tidak boleh lebih dari 5 file');

                return redirect('/barang-rampasan/create');
            }
            
        } else {
            Session::flash('errorKosong', 'Anda belum upload foto barang');

            return redirect('/barang-rampasan/create');
        }
        
        barang_rampasan::create([
            'nama_barang' => $validatedData['nama_barang'],
            'nama_terdakwa' => $validatedData['nama_terdakwa'],
            'no_putusan' => $validatedData['no_putusan'],
            'tgl_putusan' => $validatedData['tgl_putusan'],
            'kategori_id' => $validatedData['kategori_id'],
            'deskripsi' => $validatedData['deskripsi'],
            'foto_thumbnail' => $url_foto_thumbnail,
            'foto_barang' => $url_foto_barang,
        ]);
        // Set flash message
        Session::flash('success', 'Barang rampasan berhasil ditambahkan.');

        return redirect('/barang-rampasan');
    }

   
    public function show($id)
    {
        $barang = Barang_rampasan::find($id);
        $fotoBarangArray = json_decode($barang->foto_barang, true);
        $harga = Harga_wajar::where('id_barang', $id)
            ->orderBy('tgl_laporan_penilaian', 'desc')    
            ->first();

        //cek apakah harga ada
        if ($harga){
            $tglHarga = $harga->tgl_laporan_penilaian;
            $selisih = Carbon::now()->diffInMonths($tglHarga);
            $expired = $selisih >= 6;
        } else {
            $tglHarga = null;
            $selisih = null;
            $expired = false;
        }

        return view('barangRampasan.show')
            ->with('data_barang', $barang)
            ->with('foto_barang', $fotoBarangArray)
            ->with('expired', $expired)
            ->with('active', 'active')
            ->with('title', 'Barang Rampasan'); 
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
            'nama_terdakwa' => 'required',
            'no_putusan' => 'required',
            'tgl_putusan' => 'required',
            'kategori_id' => ['required',
                            function ($attribute, $value, $fail) {
                                if ($value === '0') {
                                    $fail('Please select a valid category.');
                                }
                            },],
            'deskripsi' => 'required',
            'foto_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_barang.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $barang = Barang_rampasan::find($id);

        if ($request->hasFile('foto_thumbnail')) {
            $image = $request->file('foto_thumbnail');
            $path = $image->storeAs('public/photos', time() . '.' . $image->getClientOriginalExtension());
            // Resize gambar sebelum disimpan
            Image::make($image)->fit(800, 600)->save(storage_path('app/' . $path));
            $url = Storage::url($path);
            $barang->foto_thumbnail = $url;
        }

        if ($request->hasfile('foto_barang')){
            if (count($request->file('foto_barang')) <= 5){
                $foto_paths = [];
                foreach ($request->file('foto_barang') as $image) {
                    $path = $image->storeAs('public/photos/products', uniqid() . '.' . $image->getClientOriginalExtension());
                    // Resize gambar sebelum disimpan
                    Image::make($image)->fit(800, 600)->save(storage_path('app/' . $path));
                    $url_foto_barang = Storage::url($path);

                    $foto_paths[] = $url_foto_barang;
                }
                $url_foto_barang = json_encode($foto_paths);
                $url_foto_barang = stripslashes($url_foto_barang);
                $barang->foto_barang = $url_foto_barang;
            } else {
                Session::flash('Error', 'Foto tidak boleh lebih dari 5 file');
                return redirect('/barang-rampasan/'.$barang->nama_barang.'/edit');
            }
        } 
            
        $barang->nama_barang = $validatedData['nama_barang'];
        $barang->nama_terdakwa = $validatedData['nama_terdakwa'];
        $barang->no_putusan = $validatedData['no_putusan'];
        $barang->tgl_putusan = $validatedData['tgl_putusan'];
        $barang->kategori_id = $validatedData['kategori_id'];
        $barang->deskripsi = $validatedData['deskripsi'];
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
