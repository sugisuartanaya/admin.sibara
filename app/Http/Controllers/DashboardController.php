<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Barang_rampasan;
use App\Models\Jadwal;

class DashboardController extends Controller
{
    
    public function index()
    {
        $barang = Barang_rampasan::all();
        $datajadwal = Jadwal::all();
        foreach ($datajadwal as $jadwal) {
            $jadwal->start_date = Carbon::parse($jadwal->start_date);
            $jadwal->end_date = Carbon::parse($jadwal->end_date);
        }

        return view('dashboard.index',[
            'title' => 'Dashboard',
            'active' => 'active',
            'barang' => $barang, 
            'jadwal' => $datajadwal, 
        ]);
    }
}
