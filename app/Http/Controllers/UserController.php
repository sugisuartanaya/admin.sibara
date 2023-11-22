<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\pegawai;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi 
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
            'nama_pegawai' => 'required',
            'nip' => 'required',
            'pangkat' => 'required',
            'jabatan' => 'required',
            'foto_pegawai' => 'required',
        ]);

        // Simpan data ke tabel 'users'
        $user = User::create([
            'username' => $validatedData['username'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'],
            // tambahkan kolom-kolom lain yang diperlukan
        ]);

        // Simpan foto
        // if ($request->hasFile('foto_pegawai')) {
        //     $path = $request->file('foto_pegawai')->store('photos', 'public');
        //     $user->foto_pegawai = $path;
        //     $user->save();
        // }

        // Simpan data ke tabel 'pegawai' dengan user_id yang terkait
        Pegawai::create([
            'user_id' => $user->id,
            'nama_pegawai' => $validatedData['nama_pegawai'],
            'nip' => $validatedData['nip'],
            'pangkat' => $validatedData['pangkat'],
            'jabatan' => $validatedData['jabatan'],
            'foto_pegawai' => $validatedData['foto_pegawai'],
            // 'foto_pegawai' => $user->photo,
            // tambahkan kolom-kolom lain yang diperlukan
            'is_admin' => isset($validatedData['is_admin']) ? true : false,
        ]);

        // Set flash message
        Session::flash('success', 'Pegawai berhasil ditambahkan.');

        return redirect('/pegawai');
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
        //
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
