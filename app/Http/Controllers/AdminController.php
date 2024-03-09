<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Pegawai;

class AdminController extends Controller
{
    public function storePegawai(Request $request)
    {
        // Validasi 
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required|min:3',
            'role' => 'required',
            'nama_pegawai' => 'required',
            'nip' => 'required|unique:pegawais',
            'pangkat' => 'required',
            'jabatan' => ['required',
                            function ($attribute, $value, $fail) {
                                if ($value === '0') {
                                    $fail('Please select a valid jabatan.');
                                }
                            },],
            'foto_pegawai' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan data ke tabel 'users'
        $user = User::create([
            'username' => $validatedData['username'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'],
        ]);

        // Simpan foto
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
        }

        // Simpan data ke tabel 'pegawai' dengan user_id yang terkait
        Pegawai::create([
            'user_id' => $user->id,
            'nama_pegawai' => $validatedData['nama_pegawai'],
            'nip' => $validatedData['nip'],
            'pangkat' => $validatedData['pangkat'],
            'jabatan' => $validatedData['jabatan'],
            'foto_pegawai' => $url,
            'is_admin' => $request->has('is_admin')
        ]);

        // Set flash message
        Session::flash('success', 'Pegawai berhasil ditambahkan.');

        return redirect('/pegawai');
    }

    public function editPegawai($id)
    {
        $pegawai = Pegawai::where('nip',$id)->first();
        return view('pegawai.edit')->with('data_pegawai', $pegawai)
        ->with('active', 'active')
        ->with('title', 'Pegawai');        
    }

    public function updatePegawai(Request $request, $id)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'nama_pegawai' => 'required',
            'nip' => 'required',
            'pangkat' => 'required',
            'jabatan' => 'required',
            'password' => 'nullable|min:3',
            'foto_pegawai' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Update data pada tabel user
        $pegawai = Pegawai::where('nip', $id)->first();
        $user = User::find($pegawai->user_id);
        $user->username = $validatedData['username'];
        if (!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }
        $user->save();

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

        // Update data pada tabel pegawai
        $pegawai->nama_pegawai = $validatedData['nama_pegawai'];
        $pegawai->nip = $validatedData['nip'];
        $pegawai->pangkat = $validatedData['pangkat'];
        $pegawai->jabatan = $validatedData['jabatan'];
        $pegawai->is_admin = $request->has('is_admin');
        $pegawai->save();

        // Set flash message
        Session::flash('updated', 'Berhasil update data pegawai');

        return redirect('/pegawai');
    }

    public function destroyPegawai($id)
    {
        $pegawai = Pegawai::where('nip', $id)->first();
        User::find($pegawai->user_id)->delete();
        $pegawai->delete();

        // Set flash message
        Session::flash('success', 'Pegawai berhasil dihapus.');

        return redirect('/pegawai');
    }
    
}
