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
        $notif = DashboardController::notification();
        $verifikasi_count = $notif['verifikasi_count'];
        $transaksi_count = $notif['transaksi_count'];
        $sum = $notif['sum'];
        
        $pembeli = Pembeli::find($id);
        $verifikasi = Verifikasi::where('id_pembeli', $pembeli->id)->get();
        $last_verify = Verifikasi::where('id_pembeli', $pembeli->id)->orderBy('id', 'desc')->first();
        $komentarweb = rawurlencode($last_verify->komentar);

        return view('verifikasi.show')
        ->with('active', 'active')
        ->with('title', 'Pembeli')
        ->with('verifikasi_count', $verifikasi_count)
        ->with('transaksi_count', $transaksi_count)
        ->with('sum', $sum)
        ->with('verifikasi', $verifikasi)
        ->with('last_verify', $last_verify)
        ->with('waKomentar', $komentarweb)
        ->with('pembeli', $pembeli);
    }
    
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'jenis_kesalahan.*' => 'required',
            'komentar' => 'required',
        ]);

        $verifikasi = Verifikasi::find($id);

        // $verifikasi->id_pembeli = $request->id;
        $verifikasi->status = $request->status;
        $verifikasi->jenis_kesalahan = $validatedData['jenis_kesalahan'];
        $verifikasi->komentar = $validatedData['komentar'];
        $verifikasi->save();

        Session::flash('success', 'Berhasil verifikasi akun.');

        return back()->with('success', 'Berhasil verifikasi akun.');
    }

    public function verified(Request $request, $id)
    {
        
        $verifikasi = Verifikasi::find($id);

        $verifikasi->status = $request->status;
        $verifikasi->save();

        Session::flash('success', 'Berhasil verifikasi akun.');

        return back()->with('success', 'Berhasil verifikasi akun.');
    }

   
    public function updateTelp(Request $request, $id)
    {
        $pembeli = Pembeli::find($id);
        $pembeli->no_telepon = $request->no_telepon;
        $pembeli->save();

        Session::flash('success', 'Berhasil Update No. Telepon');
        return back();
    }
}
