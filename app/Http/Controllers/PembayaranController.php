<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\Penawaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Barang_rampasan;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function show($id){
        $payment = Transaksi::select('transaksis.*', 
                                     'barang_rampasans.id as id_barang', 
                                     'barang_rampasans.nama_barang', 
                                     'barang_rampasans.no_putusan')
                            ->join('penawarans', 'transaksis.id_penawaran', '=', 'penawarans.id')
                            ->join('barang_rampasans', 'penawarans.id_barang', '=', 'barang_rampasans.id')
                            ->where('transaksis.id_jadwal', $id)
                            ->get();
        
        $transaksi = Transaksi::where('id_jadwal', $id)
                        ->where('status', 'verified')
                        ->get();

        $pembelis = $transaksi->groupBy('id_pembeli')->filter(function ($group) {
            return $group->count() > 1;
        })->keys()->toArray();
        
        if (!empty($pembelis)) {
            $pembeli = Pembeli::whereIn('id', $pembelis)->get();
        } else {
            $pembeli = null;
        }
                        
        return view('pembayaran.show', [
            'title' => 'Transaksi',
            'active' => 'active',
            'payment' => $payment,
            'pembeli' => $pembeli
        ]);
    }

    public function update($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->status = 'verified';
        $transaksi->save();

        $barangID = $transaksi->penawaran->barang_rampasan->id;
        $barang = Barang_rampasan::find($barangID);
        $barang->status = 1;
        $barang->save();

        return back()->with('message', 'Berhasil konfirmasi pembayaran.');
    }

    
    public function updateSalah($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->status = 'data_salah';
        $transaksi->save();

        $barangID = $transaksi->penawaran->barang_rampasan->id;
        $barang = Barang_rampasan::find($barangID);
        $barang->status = 0;
        $barang->save();

        return back()->with('message', 'Berhasil konfirmasi data pembayaran salah.');
    }
}
