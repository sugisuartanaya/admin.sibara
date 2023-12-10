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
        $barang = Barang_rampasan::find($id);
        return view('izin.create')
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
        $izin = Izin::where('no_sk', $id)->first();
        return view('izin.edit')->with('izin', $izin)
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
