<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembeli;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VerifikasiController extends Controller
{
    
    public function show($id)
    {
        $pembeli = Pembeli::find($id);
        $user = User::where('id', $pembeli->user_id)->first();

        return view('verifikasi.show')
        ->with('active', 'active')
        ->with('title', 'Pembeli')
        ->with('user', $user)
        ->with('pembeli', $pembeli);
    }
    
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'jenis_kesalahan.*' => 'required',
            'komentar' => 'required',
        ]);

        $verifikasi = Verifikasi::where('id_pembeli', $id)->first();

        // $verifikasi->id_pembeli = $request->id;
        $verifikasi->status = $request->status;
        $verifikasi->jenis_kesalahan = $validatedData['jenis_kesalahan'];
        $verifikasi->komentar = $validatedData['komentar'];
        $verifikasi->save();

        Session::flash('success', 'Berhasil verifikasi akun.');

        return redirect('/pembeli');
    }

    public function verified(Request $request, $id)
    {

        $verifikasi = Verifikasi::where('id_pembeli', $id)->first();

        $verifikasi->status = $request->status;
        $verifikasi->save();

        Session::flash('success', 'Berhasil verifikasi akun.');

        return redirect('/pembeli');
    }

   
    public function destroy($id)
    {
        //
    }
}
