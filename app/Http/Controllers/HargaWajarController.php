<?php

namespace App\Http\Controllers;

use App\Models\Barang_rampasan;
use Illuminate\Http\Request;
use App\Models\Harga_wajar;
use Illuminate\Support\Facades\Session;

class HargaWajarController extends Controller
{
    
    public function create($id)
    {
        $barang = Barang_rampasan::find($id);
        return view('hargaWajar.create')
            ->with('data_barang', $barang)
            ->with('active', 'active')
            ->with('title', 'Barang Rampasan');
    }

    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_laporan_penilaian' => 'required',
            'tgl_laporan_penilaian' => 'required',
            'harga' => 'required',
        ]);

        Harga_wajar::create([
            'no_laporan_penilaian' => $validatedData['no_laporan_penilaian'],
            'tgl_laporan_penilaian' => $validatedData['tgl_laporan_penilaian'],
            'harga' => $validatedData['harga'],
            'id_barang' => $id,
        ]);

        // Set flash message
        Session::flash('success', 'Harga wajar berhasil ditambahkan.');

        return redirect('/barang-rampasan/'.$id);
    }

    public function edit($id)
    {
        $harga = Harga_wajar::find($id);
        return view('hargaWajar.edit')->with('harga', $harga)
        ->with('active', 'active')
        ->with('title', 'Barang Rampasan');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_laporan_penilaian' => 'required',
            'tgl_laporan_penilaian' => 'required',
            'harga' => 'required',
        ]);
        
        $harga = Harga_wajar::find($id);
        $harga->no_laporan_penilaian = $validatedData['no_laporan_penilaian'];
        $harga->tgl_laporan_penilaian = $validatedData['tgl_laporan_penilaian'];
        $harga->harga = $validatedData['harga'];
        $harga->save();

        $barang = $request->id_barang;
        $id_barang = Barang_rampasan::find($barang);
        // Set flash message
        Session::flash('updated', 'Berhasil update harga wajar.');
        return redirect('/barang-rampasan/'.$id_barang->id);
    }

    public function destroy($id)
    {
        $h = Harga_wajar::find($id);
        $id_barang = Barang_rampasan::find($h->id_barang);
        $idBarang = $id_barang->id;

        Harga_wajar::find($id)->delete();
        // // Set flash message
        Session::flash('success', 'Harga wajar berhasil dihapus.');
        return redirect('/barang-rampasan/'.$idBarang);
    }
}
