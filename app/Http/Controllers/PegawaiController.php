<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
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

    public function create()
    {
        return view('pegawai.create', [
            'active' => 'active',
            'title' => 'Pegawai',
        ]);
    }

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
            $fileName = time() . '.' . $image->getClientOriginalExtension();

            // Path untuk menyimpan gambar di dalam folder storage
            $storagePath = $image->storeAs('public/photos/pegawai/', $fileName);

            // Path untuk menyimpan gambar di dalam folder public
            $publicPath = public_path('photos/pegawai/' . $fileName);

            // Resize gambar sebelum disimpan
            $resizedImage = Image::make($image)->fit(150, 150);
            $resizedImage->save($publicPath); // Simpan gambar di folder public

            // URL gambar yang akan disimpan di database
            $url = asset('photos/pegawai/' . $fileName);
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

}
