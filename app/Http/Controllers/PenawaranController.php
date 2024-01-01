<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\Penawaran;
use App\Models\Barang_rampasan;
use Illuminate\Http\Request;

class PenawaranController extends Controller
{
    
    public function index()
    {
        $jadwal = Jadwal::orderBy('tgl_sprint', 'desc')->get();

        foreach ($jadwal as $format_jadwal) {
            $format_jadwal->start_date = Carbon::parse($format_jadwal->start_date);
            $format_jadwal->end_date = Carbon::parse($format_jadwal->end_date);
            $format_jadwal->tgl_sprint = Carbon::parse($format_jadwal->tgl_sprint);
        }

        return view('penawaran.index', [
            'title' => 'Transaksi',
            'active' => 'active',
            'data_jadwal' => $jadwal
        ]);
    }
    
    public function show($id)
    {
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
            'jadwal' => $jadwal,
            'daftar_barang' => $barangs,
            'penawaran' => $penawaran
        ]);
    }

    public function detail($jadwalId, $barangId){

        $jadwal = Jadwal::where('no_sprint', $jadwalId)->first();
        $id_jadwal = $jadwal->id;

        $barang = Barang_rampasan::find($barangId);
        
        $penawaran = Penawaran::with('jadwal')
            ->where('id_jadwal', $id_jadwal)
            ->where('id_barang', $barangId)
            ->orderBy('harga_bid', 'desc')
            ->get();
            
        $penawarTertinggi = Penawaran::with('jadwal')
            ->where('id_jadwal', $id_jadwal)
            ->where('id_barang', $barangId)
            ->orderBy('harga_bid', 'desc')
            ->first();

        return view('penawaran.bidder', [
            'title' => 'Transaksi',
            'active' => 'active',
            'jadwal' => $jadwal,
            'barang' => $barang,
            'data_penawaran' => $penawaran,
            'penawarTertinggi' => $penawarTertinggi
        ]);
        
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
