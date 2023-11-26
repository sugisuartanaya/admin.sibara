<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myProfile()
    {
        return view('pegawai.profile', [
            'active' => 'active',
            'title' => 'Profile',
        ]);
    }

    public function index()
    {
        $pegawai = Pegawai::all();
        return view('pegawai.index')->with('data_pegawai', $pegawai)
        ->with('active', 'active')
        ->with('title', 'Pegawai');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.create', [
            'active' => 'active',
            'title' => 'Pegawai',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_pegawai' => 'required',
            'nip' => 'required',
            'pangkat' => 'required',
            'jabatan' => 'required',
            'foto_pegawai' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|min:3'
        ]);

        $pegawai = Pegawai::where('nip', $id)->first();

        if ($request->hasFile('foto_pegawai')) {
            $image = $request->file('foto_pegawai');
            $path = $image->storeAs('public/photos', time() . '.' . $image->getClientOriginalExtension());
            // Resize gambar sebelum disimpan
            Image::make($image)->fit(150, 150)->save(storage_path('app/' . $path));
            $url = Storage::url($path);
            $pegawai->foto_pegawai = $url;  

        }

        $pegawai->nama_pegawai = $validatedData['nama_pegawai'];
        $pegawai->nip = $validatedData['nip'];
        $pegawai->pangkat = $validatedData['pangkat'];
        $pegawai->jabatan = $validatedData['jabatan'];
        $pegawai->save();

        Session::flash('success', 'Berhasil update profile');
        return redirect('/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
