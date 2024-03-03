<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;

use App\Models\Pembeli;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Barang_rampasan;
use App\Models\Penawaran;

class DashboardController extends Controller
{
    
    public function index()
    {
        $barang = Barang_rampasan::all();
        $datajadwal = Jadwal::all();
        $pembeli = Pembeli::all();
        $jadwal = $datajadwal->last();
        foreach ($datajadwal as $jadwal) {
            $jadwal->start_date = Carbon::parse($jadwal->start_date);
            $jadwal->end_date = Carbon::parse($jadwal->end_date);
        }

        $terjual = Barang_rampasan::where('status', 1)->count();
        
        if ($jadwal)
            $jumlah_harga_bid = Transaksi::join('penawarans', 'transaksis.id_penawaran', '=', 'penawarans.id')
            ->where('transaksis.status', 'verified')
            ->where('penawarans.id_jadwal', $jadwal->id)
            ->sum('penawarans.harga_bid');
        else
            $jumlah_harga_bid = null;
        

        return view('dashboard.index',[
            'title' => 'Dashboard',
            'active' => 'active',
            'barang' => $barang, 
            'pembeli' => $pembeli, 
            'jadwal' => $jadwal, 
            'terjual' => $terjual,
            'pendapatan' => $jumlah_harga_bid
        ]);
    }
}
