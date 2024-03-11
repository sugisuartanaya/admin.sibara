<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PembeliController extends Controller
{
   
    public function index()
    {
        $notif = DashboardController::notification();
        $verifikasi_count = $notif['verifikasi_count'];
        $transaksi_count = $notif['transaksi_count'];
        $sum = $notif['sum'];

        $pembeli = Pembeli::orderBy('id', 'desc')->get();

        // Kembalikan data ke tampilan
        return view('pembeli.index', [
            'title' => 'Pembeli',
            'active' => 'active',
            'verifikasi_count' => $verifikasi_count,
            'transaksi_count' => $transaksi_count,
            'sum' => $sum,
            'daftarPembeli' => $pembeli,
        ]);
    }
    
    public function destroy($id)
    {
        $pembeli = Pembeli::find($id);

        $pembeli->verifikasi()->delete();

        User::find($pembeli->user_id)->delete();
        
        $pembeli->delete();
        // Set flash message
        Session::flash('success', 'pembeli berhasil dihapus.');

        return redirect('/pembeli');
    }
}
