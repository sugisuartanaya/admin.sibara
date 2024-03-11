<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Daftar_barang;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;


class JadwalController extends Controller
{
    
    public function index()
    {
        $notif = DashboardController::notification();
        $verifikasi_count = $notif['verifikasi_count'];
        $transaksi_count = $notif['transaksi_count'];
        $sum = $notif['sum'];

        $jadwal = Jadwal::orderBy('id', 'desc')->get();
        foreach ($jadwal as $format_jadwal) {
            $format_jadwal->start_date = Carbon::parse($format_jadwal->start_date);
            $format_jadwal->end_date = Carbon::parse($format_jadwal->end_date);
            $format_jadwal->tgl_sprint = Carbon::parse($format_jadwal->tgl_sprint);
        }

        //filter tanggal berakhir
        $now = Carbon::now();
        $filteredJadwal = $jadwal->filter(function ($item) use ($now) {
            return $item->end_date >= $now;
        });


        return view('jadwal.index')
            ->with('verifikasi_count', $verifikasi_count)
            ->with('transaksi_count', $transaksi_count)
            ->with('sum', $sum)
            ->with('data_jadwal', $jadwal)
            ->with('filter', $filteredJadwal)
            ->with('active', 'active')
            ->with('title', 'Jadwal');
    }

    public function create()
    {
        $notif = DashboardController::notification();
        $verifikasi_count = $notif['verifikasi_count'];
        $transaksi_count = $notif['transaksi_count'];
        $sum = $notif['sum'];

        return view('jadwal.create',[
            'verifikasi_count' => $verifikasi_count,
            'transaksi_count' => $transaksi_count,
            'sum' => $sum,
            'title' => 'Jadwal',
            'active' => 'active'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_sprint' => 'required',
            'tgl_sprint' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'type' => 'required'
        ]);

        Jadwal::create([
            'no_sprint' => $validatedData['no_sprint'],
            'tgl_sprint' => $validatedData['tgl_sprint'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'type' => $validatedData['type'],
        ]);
        // Set flash message
        Session::flash('success', 'Jadwal berhasil ditambahkan.');

        return redirect('/jadwal');
    }

    public function edit($id)
    {
        $notif = DashboardController::notification();
        $verifikasi_count = $notif['verifikasi_count'];
        $transaksi_count = $notif['transaksi_count'];
        $sum = $notif['sum'];

        $jadwal = Jadwal::find($id);
        return view('jadwal.edit')
            ->with('verifikasi_count', $verifikasi_count)
            ->with('transaksi_count', $transaksi_count)
            ->with('sum', $sum)
            ->with('jadwal', $jadwal)
            ->with('active', 'active')
            ->with('title', 'Jadwal');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_sprint' => 'required',
            'tgl_sprint' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'type' => 'required'
        ]);

        $jadwal = Jadwal::find($id);
        $jadwal->no_sprint = $validatedData['no_sprint'];
        $jadwal->tgl_sprint = $validatedData['tgl_sprint'];
        $jadwal->start_date = $validatedData['start_date'];
        $jadwal->end_date = $validatedData['end_date'];
        $jadwal->type = $validatedData['type'];
        $jadwal->save();
        // Set flash message
        Session::flash('updated', 'Berhasil update jadwal.');

        return redirect('/jadwal');

    }

    public function destroy($id)
    {

        $jadwal = Jadwal::find($id);
        Daftar_barang::where('id_jadwal', $jadwal->id)->delete();
        Jadwal::find($id)->delete();
 

        // Set flash message
        Session::flash('success', 'Jadwal berhasil dihapus.');

        return redirect('/jadwal');
    }
}
