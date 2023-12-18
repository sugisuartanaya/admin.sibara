<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;

use App\Models\Pembeli;
use Illuminate\Http\Request;
use App\Models\Barang_rampasan;

class DashboardController extends Controller
{
    
    public function index()
    {
        $barang = Barang_rampasan::all();
        $datajadwal = Jadwal::all();
        $pembeli = Pembeli::all();
        $jadwal = $datajadwal->last();
        foreach ($datajadwal as $jadwal) {
            $jadwal->start_date = Carbon::parse($jadwal->start_date);
            $jadwal->end_date = Carbon::parse($jadwal->end_date);
        }

        return view('dashboard.index',[
            'title' => 'Dashboard',
            'active' => 'active',
            'barang' => $barang, 
            'pembeli' => $pembeli, 
            'jadwal' => $jadwal, 
        ]);
    }
}
