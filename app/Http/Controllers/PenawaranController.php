<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\Penawaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Barang_rampasan;
use Illuminate\Support\Facades\URL;

class PenawaranController extends Controller
{
    
    public function show($id)
    {
        $notif = DashboardController::notification();
        $verifikasi_count = $notif['verifikasi_count'];
        $transaksi_count = $notif['transaksi_count'];
        $sum = $notif['sum'];

        $jadwal = Jadwal::find($id);
        $id_jadwal = $jadwal->id;

        $barangs = Barang_rampasan::whereHas('daftar_barang', function ($query) use ($id_jadwal) {
            $query->where('id_jadwal', $id_jadwal);
        })->get();

        $penawaran = [];

        foreach ($barangs as $barang) {
            $penawar = Penawaran::where('id_jadwal', $id_jadwal)
                ->where('id_barang', $barang->id)
                ->orderBy('harga_bid', 'desc')
                ->get();

            if ($penawar->isNotEmpty()) {
                $penawaran[$barang->id] = $penawar;
            }
        }

        return view('penawaran.show',[
            'title' => 'Transaksi',
            'active' => 'active',
            'verifikasi_count' => $verifikasi_count,
            'transaksi_count' => $transaksi_count,
            'sum' => $sum,
            'jadwal' => $jadwal,
            'daftar_barang' => $barangs,
            'penawaran' => $penawaran
        ]);
    }

    public function detail($jadwalId, $barangId)
    {

        $notif = DashboardController::notification();
        $verifikasi_count = $notif['verifikasi_count'];
        $transaksi_count = $notif['transaksi_count'];
        $sum = $notif['sum'];

        $jadwal = Jadwal::find($jadwalId);
        $id_jadwal = $jadwal->id;

        $barang = Barang_rampasan::find($barangId);
        
        $penawaranNormal = Penawaran::with('jadwal')
            ->where('id_jadwal', $id_jadwal)
            ->where('id_barang', $barangId)
            ->whereNotIn('status', ['wanprestasi'])
            ->orderBy('harga_bid', 'desc')
            ->get();

        // Mengambil penawaran dengan status 'wanprestasi'
        $penawaranWanprestasi = Penawaran::with('jadwal')
            ->where('id_jadwal', $id_jadwal)
            ->where('id_barang', $barangId)
            ->whereIn('status', ['wanprestasi'])
            ->orderBy('status', 'asc') // 'wanprestasi' paling terakhir
            ->get();

        // Menggabungkan kedua hasil query
        $penawaran = $penawaranNormal->concat($penawaranWanprestasi);
            
        $penawarTertinggi = Penawaran::with('jadwal')
            ->where('id_jadwal', $id_jadwal)
            ->where('id_barang', $barangId)
            ->whereNotIn('status', ['wanprestasi'])
            ->orderBy('harga_bid', 'desc')
            ->first();
        
        if($penawarTertinggi !== null) {
            $dataEndDate = Carbon::parse($penawarTertinggi->updated_at)->toIso8601String();
            $countdownWinner = Carbon::parse($dataEndDate)->addHours(24)->toIso8601String();
            $transaksi = Transaksi::where('id_penawaran', $penawarTertinggi->id)->first();
        } else {
            $countdownWinner = null;
            $transaksi = null;
        }

        return view('penawaran.bidder', [
            'title' => 'Transaksi',
            'active' => 'active',
            'verifikasi_count' => $verifikasi_count,
            'transaksi_count' => $transaksi_count,
            'sum' => $sum,
            'jadwal' => $jadwal,
            'barang' => $barang,
            'data_penawaran' => $penawaran,
            'penawarTertinggi' => $penawarTertinggi,
            'countdownWinner' => $countdownWinner,
            'transaksi' => $transaksi
        ]);
        
    }

    public function updateWinner($jadwalId, $barangId, $penawarId){
        
        Penawaran::where('id_jadwal', $jadwalId)
            ->where('id_barang', $barangId)
            ->whereIn('status', ['pending', 'kalah'])
            ->update(['status' => 'kalah']);
        
        $penawar = Penawaran::find($penawarId);
        $penawar->status = 'menang';
        $penawar->updated_at = Carbon::now();
        $penawar->save();
        
        return back()->with('message', 'Berhasil konfirmasi penawaran.');
    }

    public function updateWanprestasi($penawarId){
        
        $penawar = Penawaran::find($penawarId);
        $penawar->status = 'wanprestasi';
        $penawar->save();
        
        return back()->with('message', 'Berhasil konfirmasi wanprestasi.');
    }

}
