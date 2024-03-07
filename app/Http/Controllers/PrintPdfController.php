<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Izin;
use App\Models\Pegawai;
use App\Models\Pembeli;
use App\Models\Penawaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintPdfController extends Controller
{
    

    public function cetak_kwitansi($id){
        $penawaran = Penawaran::find($id);
        $pembeli = Pembeli::where('id', $penawaran->id_pembeli)->first();
        $nominal = $penawaran->harga_bid;
        $terbilang = $this->terbilang($nominal);

        $today = now();
        $today = Carbon::parse($today)->translatedFormat('j F Y');

        $petugas = Pegawai::where('jabatan', 'petugas')
                            ->where('is_admin', 0)
                            ->first();
        $kasi = Pegawai::where('jabatan', 'kasi')
                            ->first();

        $pdf = PDF::loadView('pdf.kwitansi', 
            ['penawaran' => $penawaran, 
            'terbilang' =>$terbilang, 
            'today' => $today,
            'petugas' => $petugas,
            'kasi' => $kasi]);

        return $pdf->download('Kwitansi ' . $pembeli->nama_pembeli . '.pdf');
    }
    
    public function cetak_bukti($id){
        $penawaran = Penawaran::find($id);
        $pembeli = Pembeli::where('id', $penawaran->id_pembeli)->first();
        $nominal = $penawaran->harga_bid;
        $terbilang = $this->terbilang($nominal);

        $today = Carbon::now();
        $day = $this->terbilang($today->format('j'));
        $month = $today->translatedFormat('F');
        $year = $this->terbilang($today->format('Y'));
        $month = strtolower($month);
        $year = strtolower(substr($year, 0, 1)) . substr($year, 1);

        $tgl_sk = Izin::where('id_barang', $penawaran->id_barang)->first();
        $tgl_sk = Carbon::parse($today)->translatedFormat('j F Y');

        $petugas = Pegawai::where('jabatan', 'petugas')
                            ->where('is_admin', 0)
                            ->get();
        $kasi = Pegawai::where('jabatan', 'kasi')
                            ->first();

        $pdf = PDF::loadView('pdf.bukti', 
            ['penawaran' => $penawaran, 
            'terbilang' =>$terbilang, 
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'tgl_sk' => $tgl_sk,
            'pembeli' => $pembeli,
            'petugas' => $petugas,
            'kasi' => $kasi
        ]);

        return $pdf->download('BA ' . $pembeli->nama_pembeli . '.pdf');
    }

    private function terbilang($number)
    {
        $angka = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $terbilang = "";

        if ($number < 12) {
            $terbilang = $angka[$number];
        } else if ($number < 20) {
            $terbilang = $this->terbilang($number - 10) . " belas";
        } else if ($number < 100) {
            $terbilang = $this->terbilang(intdiv($number, 10)) . " puluh " . $angka[$number % 10];
        } else if ($number < 200) {
            $terbilang = "seratus " . $this->terbilang($number - 100);
        } else if ($number < 1000) {
            $terbilang = $this->terbilang(intdiv($number, 100)) . " ratus " . $this->terbilang($number % 100);
        } else if ($number < 2000) {
            $terbilang = "seribu " . $this->terbilang($number - 1000);
        } else if ($number < 1000000) {
            $terbilang = $this->terbilang(intdiv($number, 1000)) . " ribu " . $this->terbilang($number % 1000);
        } else if ($number < 1000000000) {
            $terbilang = $this->terbilang(intdiv($number, 1000000)) . " juta " . $this->terbilang($number % 1000000);
        }

        return $terbilang;

    }
}
