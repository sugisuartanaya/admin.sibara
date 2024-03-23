<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\Penawaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Barang_rampasan;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function show($id){
        $notif = DashboardController::notification();
        $verifikasi_count = $notif['verifikasi_count'];
        $transaksi_count = $notif['transaksi_count'];
        $sum = $notif['sum'];
        $petugas = Pegawai::where('jabatan', 'petugas')
                            ->where('is_admin', 0)
                            ->get();
        $kasi = Pegawai::where('jabatan', 'kasi')->first();

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
        
        $pembeliTransaksi = [];

        if (!empty($pembelis)) {
            foreach ($pembelis as $pembeliId) {
                $transaksiPembeli = Transaksi::where('id_pembeli', $pembeliId)->get();
                $pembeliTransaksi[$pembeliId] = $transaksiPembeli;
            }
        } else {
            $pembeliTransaksi = null;
        }

        return view('pembayaran.show', [
            'title' => 'Transaksi',
            'active' => 'active',
            'verifikasi_count' => $verifikasi_count,
            'transaksi_count' => $transaksi_count,
            'sum' => $sum,
            'payment' => $payment,
            'pembeli' => $pembeliTransaksi,
            'pegawai' => $petugas,
            'kasi' => $kasi
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
