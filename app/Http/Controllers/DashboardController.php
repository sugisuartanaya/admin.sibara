<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;

use App\Models\Pembeli;
use App\Models\Penawaran;
use App\Models\Transaksi;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use App\Models\Barang_rampasan;

class DashboardController extends Controller
{
    
    public function index()
    {
        $notif = DashboardController::notification();
        $verifikasi_count = $notif['verifikasi_count'];
        $transaksi_count = $notif['transaksi_count'];
        $sum = $notif['sum'];

        $barang = Barang_rampasan::all();
        $datajadwal = Jadwal::all();
        $pembeli = Pembeli::all();
        $jadwal = $datajadwal->last();
        foreach ($datajadwal as $jadwal) {
            $jadwal->start_date = Carbon::parse($jadwal->start_date);
            $jadwal->end_date = Carbon::parse($jadwal->end_date);
        }
        
        $jumlah_harga_bid = null;
        $terjual = null;
        
        if ($jadwal) {
            $jumlah_harga_bid = Transaksi::join('penawarans', 'transaksis.id_penawaran', '=', 'penawarans.id')
                                        ->where('transaksis.status', 'verified')
                                        ->where('penawarans.id_jadwal', $jadwal->id)
                                        ->sum('penawarans.harga_bid');

            $terjual = Transaksi::join('penawarans', 'transaksis.id_penawaran', '=', 'penawarans.id')
                                ->where('transaksis.status', 'verified')
                                ->where('penawarans.id_jadwal', $jadwal->id)
                                ->count();
        }
            
        return view('dashboard.index',[
            'title' => 'Dashboard',
            'active' => 'active',
            'barang' => $barang, 
            'pembeli' => $pembeli, 
            'jadwal' => $jadwal, 
            'terjual' => $terjual,
            'pendapatan' => $jumlah_harga_bid,
            'sum' => $sum,
            'transaksi_count' => $transaksi_count,
            'verifikasi_count' => $verifikasi_count
        ]);
    }

    public static function notification()
    {
        $verifikasi_count = Verifikasi::where('status', 'belum_verified')->orWhere('status', 'revisi')->count();
        $transaksi_count = Transaksi::where('status', 'review')->count();
        $sum = $verifikasi_count + $transaksi_count;

        return ['transaksi_count' => $transaksi_count, 'verifikasi_count' => $verifikasi_count, 'sum' => $sum];
    } 
}
