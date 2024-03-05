<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Carbon\Carbon;
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

    private function terbilang($number)
    {
        $angka = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $terbilang = "";
        if ($number < 12) {
            $terbilang = " " . $angka[$number];
        } else if ($number < 20) {
            $terbilang = $this->terbilang($number - 10) . " belas";
        } else if ($number < 100) {
            $terbilang = $this->terbilang($number / 10) . " puluh" . $this->terbilang($number % 10);
        } else if ($number < 200) {
            $terbilang = " seratus" . $this->terbilang($number - 100);
        } else if ($number < 1000) {
            $terbilang = $this->terbilang($number / 100) . " ratus" . $this->terbilang($number % 100);
        } else if ($number < 2000) {
            $terbilang = " seribu" . $this->terbilang($number - 1000);
        } else if ($number < 1000000) {
            $terbilang = $this->terbilang($number / 1000) . " ribu" . $this->terbilang($number % 1000);
        } else if ($number < 1000000000) {
            $terbilang = $this->terbilang($number / 1000000) . " juta" . $this->terbilang($number % 1000000);
        } 
        return $terbilang;

    }
}
