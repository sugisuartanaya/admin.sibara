<?php

namespace App\Http\Controllers;

use App\Models\Barang_rampasan;
use Illuminate\Http\Request;
use App\Models\Izin;
use Illuminate\Support\Facades\Session;

class IzinController extends Controller
{
       
    public function create($id)
    {
        $notif = DashboardController::notification();
        $verifikasi_count = $notif['verifikasi_count'];
        $transaksi_count = $notif['transaksi_count'];
        $sum = $notif['sum'];

        $barang = Barang_rampasan::find($id);
        return view('izin.create')
            ->with('verifikasi_count', $verifikasi_count)
            ->with('transaksi_count', $transaksi_count)
            ->with('sum', $sum)
            ->with('data_barang', $barang)
            ->with('active', 'active')
            ->with('title', 'Barang Rampasan');
    }

    
    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_sk' => 'required',
            'tgl_sk' => 'required',
        ]);

        Izin::create([
            'no_sk' => $validatedData['no_sk'],
            'tgl_sk' => $validatedData['tgl_sk'],
            'id_barang' => $id
        ]);

        // Set flash message
        Session::flash('success', 'Izin berhasil ditambahkan.');

        return redirect('/barang-rampasan/'.$id);
    }

    
    public function edit($id)
    {
        $notif = DashboardController::notification();
        $verifikasi_count = $notif['verifikasi_count'];
        $transaksi_count = $notif['transaksi_count'];
        $sum = $notif['sum'];

        $izin = Izin::find($id);
        return view('izin.edit')
        ->with('verifikasi_count', $verifikasi_count)
        ->with('transaksi_count', $transaksi_count)
        ->with('sum', $sum)
        ->with('izin', $izin)
        ->with('active', 'active')
        ->with('title', 'Barang Rampasan'); 
    }

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_sk' => 'required',
            'tgl_sk' => 'required',
        ]);
        
        $izin = Izin::find($id);
        $izin->no_sk = $validatedData['no_sk'];
        $izin->tgl_sk = $validatedData['tgl_sk'];
        $izin->save();

        $barang = $request->id_barang;
        $id_barang = Barang_rampasan::find($barang);
        // Set flash message
        Session::flash('updated', 'Berhasil update izin penjualan.');
        return redirect('/barang-rampasan/'.$id_barang->id);
    }

    
    public function destroy($id)
    {
        $b = Izin::find($id);
        $id_barang = Barang_rampasan::find($b->id_barang);
        $idBarang = $id_barang->id;

        Izin::find($id)->delete();
        // // Set flash message
        Session::flash('success', 'Izin berhasil dihapus.');
        return redirect('/barang-rampasan/'.$idBarang);
    }
}
