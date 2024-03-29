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
       
    public function create($id)
    {
        $notif = DashboardController::notification();
        $verifikasi_count = $notif['verifikasi_count'];
        $transaksi_count = $notif['transaksi_count'];
        $sum = $notif['sum'];

        $jadwal = Jadwal::find($id);

        $barangRampasanData = Barang_rampasan::where(function ($query) use ($jadwal) {
            $query->whereDoesntHave('daftar_barang', function ($subQuery) use ($jadwal) {
                $subQuery->where('id_jadwal', $jadwal->id);
            });
        })->where('status', 0)
        ->with('izin', 'harga_wajar')
        ->whereHas('izin')
        ->whereHas('harga_wajar')   
        ->get();

        
        return view('daftarBarang.create')
            ->with('active', 'active')
            ->with('jadwal', $jadwal)
            ->with('verifikasi_count', $verifikasi_count)
            ->with('transaksi_count', $transaksi_count)
            ->with('sum', $sum)
            ->with('data_barang', $barangRampasanData)
            ->with('title', 'Jadwal');
    }

   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_barang' => 'required',
            'id_jadwal' => 'required',
        ]);

        foreach ($validatedData['id_barang'] as $key => $value) {
            Daftar_barang::create([
                'id_barang' => $validatedData['id_barang'][$key],
                'id_jadwal' => $validatedData['id_jadwal'],
            ]);
        }
        
        $jadwal = $request->id_jadwal;
        // Set flash message
        Session::flash('success', 'Barang rampasan berhasil ditambahkan.');

        return redirect('/jadwal/detail/'.$jadwal);
    }

    public function show($id)
    {
        $notif = DashboardController::notification();
        $verifikasi_count = $notif['verifikasi_count'];
        $transaksi_count = $notif['transaksi_count'];
        $sum = $notif['sum'];

        $jadwal = Jadwal::where('id', $id)->first();
        $jadwal->start_date = Carbon::parse($jadwal->start_date);
        $jadwal->end_date = Carbon::parse($jadwal->end_date);
        $jadwal->tgl_sprint = Carbon::parse($jadwal->tgl_sprint);

        $today = Carbon::now();
        $filteredJadwal = $jadwal->end_date->isBefore($today);

        $daftar = Daftar_barang::where('id_jadwal', $id)->get();

        return view('daftarBarang.show')
            ->with('jadwal', $jadwal)
            ->with('daftar', $daftar)
            ->with('filter', $filteredJadwal)
            ->with('verifikasi_count', $verifikasi_count)
            ->with('transaksi_count', $transaksi_count)
            ->with('sum', $sum)
            ->with('active', 'active')
            ->with('title', 'Jadwal');
    }

      
    public function destroy($id)
    {
        $h = Daftar_barang::find($id);
        $id_jadwal = Jadwal::find($h->id_jadwal);

        Daftar_barang::find($id)->delete();
        // // Set flash message
        Session::flash('success', 'Barang rampasan berhasil dihapus.');
        return redirect('/jadwal/detail/'.$id_jadwal->id);
    }
}
