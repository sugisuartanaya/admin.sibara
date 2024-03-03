<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\Penawaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class CheckPaymentController extends Controller
{
    public function index(){
        $jadwal = Jadwal::orderBy('tgl_sprint', 'desc')->get();

        foreach ($jadwal as $format_jadwal) {
            $format_jadwal->start_date = Carbon::parse($format_jadwal->start_date);
            $format_jadwal->end_date = Carbon::parse($format_jadwal->end_date);
            $format_jadwal->tgl_sprint = Carbon::parse($format_jadwal->tgl_sprint);
        }
        return view('pembayaran.index', [
            'title' => 'Transaksi',
            'active' => 'active',
            'data_jadwal' => $jadwal
        ]);
    }

    public function show($id){
        $payment = Transaksi::join('penawarans', 'transaksis.id_penawaran', '=', 'penawarans.id')
            ->join('barang_rampasans', 'penawarans.id_barang', '=', 'barang_rampasans.id')
            ->join('jadwals', 'penawarans.id_jadwal', '=', 'jadwals.id')
            ->select('transaksis.status as transaksi_status', 
                    'transaksis.tanggal', 
                    'barang_rampasans.nama_barang',
                    'barang_rampasans.id',
                    'barang_rampasans.no_putusan',
                    'jadwals.no_sprint', 
                    'penawarans.harga_bid')
            ->where('penawarans.id_jadwal', $id)
            ->get();

        return view('pembayaran.show', [
            'title' => 'Transaksi',
            'active' => 'active',
            'payment' => $payment
        ]);
    }
}
