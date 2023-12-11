<?php

namespace App\Http\Controllers;

use App\Models\Barang_rampasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\Daftar_barang;
use App\Models\izin;



class DaftarBarangController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create($id)
    {
        $jadwal = Jadwal::where('id', $id)->first();

        $barangRampasanData = Barang_rampasan::whereDoesntHave('daftar_barang')
        ->with('izin', 'harga_wajar')
        ->has('harga_wajar')
        ->get();


        return view('daftarBarang.create')
            ->with('active', 'active')
            ->with('jadwal', $jadwal)
            ->with('data_barang', $barangRampasanData)
            ->with('title', 'Jadwal');
    }

   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_barang' => 'required',
            'id_jadwal' => 'required',
            'status' => 'required',
        ]);

        $jadwal = $request->id_jadwal;
        $id_jadwal = Barang_rampasan::find($jadwal);

        foreach ($validatedData['id_barang'] as $key => $value) {
            Daftar_barang::create([
                'id_barang' => $validatedData['id_barang'][$key],
                'id_jadwal' => $validatedData['id_jadwal'],
                'status' => $validatedData['status'],
            ]);
        }

        // Set flash message
        Session::flash('success', 'Barang rampasan berhasil ditambahkan.');

        return redirect('/daftar-barang/'.$id_jadwal->id);
    }

    public function show($id)
    {
        $jadwal = Jadwal::where('id', $id)->first();
        $jadwal->start_date = Carbon::parse($jadwal->start_date);
        $jadwal->end_date = Carbon::parse($jadwal->end_date);
        $jadwal->tgl_sprint = Carbon::parse($jadwal->tgl_sprint);

        $daftar = Daftar_barang::where('id_jadwal', $id)->get();

        return view('daftarBarang.show')
            ->with('jadwal', $jadwal)
            ->with('daftar', $daftar)
            ->with('active', 'active')
            ->with('title', 'Jadwal');
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
