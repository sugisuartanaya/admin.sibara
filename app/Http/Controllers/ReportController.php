<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        return view('laporan.index',[
            'title' => 'Laporan',
            'active' => 'active',
            'report' => null
        ]);
    }

    public function filter($tahun){
        $jadwal = Jadwal::whereYear('tgl_sprint', $tahun)->get();
        foreach ($jadwal as $format_jadwal) {
            $format_jadwal->tgl_sprint = Carbon::parse($format_jadwal->tgl_sprint);
        }    
        
        $transaksi = Transaksi::join('penawarans', 'transaksis.id_penawaran', '=', 'penawarans.id')
            ->join('barang_rampasans', 'penawarans.id_barang', '=', 'barang_rampasans.id')
            ->join('jadwals', 'penawarans.id_jadwal', '=', 'jadwals.id')
            ->select('barang_rampasans.nama_barang',
                    'barang_rampasans.nama_terdakwa',
                    'barang_rampasans.no_putusan',
                    'barang_rampasans.tgl_putusan',
                    'jadwals.no_sprint', 
                    'penawarans.harga_bid')
            ->whereYear('transaksis.tanggal', $tahun)
            ->where('transaksis.status', 'verified')
            ->get();
        
        $total_pendapatan = $transaksi->sum('harga_bid');
        
        foreach ($transaksi as $format_transaksi) {
            $format_transaksi->tgl_putusan = Carbon::parse($format_transaksi->tgl_putusan);
        }  

        return view('laporan.filter',[
            'title' => 'Laporan',
            'active' => 'active',
            'data_tahun' => $tahun,
            'data_jadwal' => $jadwal,
            'data_transaksi' => $transaksi,
            'total_pendapatan' => $total_pendapatan,
            'header' => null
        ]);
    }

    public function filterByJadwal(Request $request, $tahun){
        $jadwal = Jadwal::whereYear('tgl_sprint', $tahun)->get();
        foreach ($jadwal as $format_jadwal) {
            $format_jadwal->tgl_sprint = Carbon::parse($format_jadwal->tgl_sprint);
        }  
        
        $data_header = Jadwal::find($request->jadwal);

        $transaksi = Transaksi::join('penawarans', 'transaksis.id_penawaran', '=', 'penawarans.id')
            ->join('barang_rampasans', 'penawarans.id_barang', '=', 'barang_rampasans.id')
            ->join('jadwals', 'penawarans.id_jadwal', '=', 'jadwals.id')
            ->select('barang_rampasans.nama_barang',
                    'barang_rampasans.nama_terdakwa',
                    'barang_rampasans.no_putusan',
                    'barang_rampasans.tgl_putusan',
                    'jadwals.no_sprint', 
                    'penawarans.harga_bid')
            ->whereYear('transaksis.tanggal', $tahun)
            ->where('jadwals.id', $request->jadwal)
            ->where('transaksis.status', 'verified')
            ->get();
        
        $total_pendapatan = $transaksi->sum('harga_bid');
        
        foreach ($transaksi as $format_transaksi) {
            $format_transaksi->tgl_putusan = Carbon::parse($format_transaksi->tgl_putusan);
        }  

        return view('laporan.filter',[
            'title' => 'Laporan',
            'active' => 'active',
            'data_tahun' => $tahun,
            'data_jadwal' => $jadwal,
            'data_transaksi' => $transaksi,
            'total_pendapatan' => $total_pendapatan,
            'header' => $data_header,
        ]);

    }

}
