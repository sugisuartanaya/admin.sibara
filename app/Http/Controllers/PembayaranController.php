<?php

namespace App\Http\Controllers;

use App\Models\Penawaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Barang_rampasan;

class PembayaranController extends Controller
{
    public function show($id){
        $payment = Transaksi::join('penawarans', 'transaksis.id_penawaran', '=', 'penawarans.id')
            ->join('barang_rampasans', 'penawarans.id_barang', '=', 'barang_rampasans.id')
            ->join('jadwals', 'penawarans.id_jadwal', '=', 'jadwals.id')
            ->join('pembelis', 'penawarans.id_pembeli', '=', 'pembelis.id')
            ->select('transaksis.status as transaksi_status', 
                    'transaksis.tanggal', 
                    'barang_rampasans.nama_barang',
                    'barang_rampasans.id',
                    'barang_rampasans.no_putusan',
                    'jadwals.no_sprint', 
                    'pembelis.nama_pembeli', 
                    'penawarans.id',
                    'penawarans.harga_bid')
            ->where('penawarans.id_jadwal', $id)
            ->get();
        
        return view('pembayaran.show', [
            'title' => 'Transaksi',
            'active' => 'active',
            'payment' => $payment
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
