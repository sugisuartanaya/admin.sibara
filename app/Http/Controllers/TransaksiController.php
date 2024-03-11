<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Barang_rampasan;

class transaksiController extends Controller
{
    public function index(){
        $notif = DashboardController::notification();
        $verifikasi_count = $notif['verifikasi_count'];
        $transaksi_count = $notif['transaksi_count'];
        $sum = $notif['sum'];

        $jadwal = Jadwal::orderBy('tgl_sprint', 'desc')->get();

        foreach ($jadwal as $format_jadwal) {
            $format_jadwal->start_date = Carbon::parse($format_jadwal->start_date);
            $format_jadwal->end_date = Carbon::parse($format_jadwal->end_date);
            $format_jadwal->tgl_sprint = Carbon::parse($format_jadwal->tgl_sprint);
        }
        return view('transaksi.index', [
            'title' => 'Transaksi',
            'active' => 'active',
            'verifikasi_count' => $verifikasi_count,
            'transaksi_count' => $transaksi_count,
            'sum' => $sum,
            'data_jadwal' => $jadwal
        ]);
    }
    
}
