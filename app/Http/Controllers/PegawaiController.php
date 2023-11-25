<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
            'foto_pegawai' => 'required',
            'password' => 'nullable|min:3'
        ]);

        $pegawai = Pegawai::where('nip', $id)->first();
        $pegawai->nama_pegawai = $validatedData['nama_pegawai'];
        $pegawai->nip = $validatedData['nip'];
        $pegawai->pangkat = $validatedData['pangkat'];
        $pegawai->jabatan = $validatedData['jabatan'];
        $pegawai->foto_pegawai = $validatedData['foto_pegawai'];
        $pegawai->save();

        Session::flash('updated', 'Berhasil update profile');
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
