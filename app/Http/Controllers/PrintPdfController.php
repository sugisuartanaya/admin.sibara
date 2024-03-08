<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Izin;
use App\Models\Jadwal;
use App\Models\Pegawai;
use App\Models\Pembeli;
use App\Models\Penawaran;
use App\Models\Transaksi;
use iio\libmergepdf\Merger;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintPdfController extends Controller
{
    
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

    public function batch_kwitansi($pembeliID, $jadwalID){
        $penawaran = Transaksi::where('id_jadwal', $jadwalID)
                            ->where('id_pembeli', $pembeliID)
                            ->where('status', 'verified')
                            ->with('penawaran')
                            ->get();

        $pembeli = Pembeli::find($pembeliID);

        $totalHargaBid = $penawaran->sum(function ($transaksi) {
            return $transaksi->penawaran->harga_bid;
        });

        $terbilang = $this->terbilang($totalHargaBid);

        $today = now();
        $today = Carbon::parse($today)->translatedFormat('j F Y');

        $petugas = Pegawai::where('jabatan', 'petugas')
                            ->where('is_admin', 0)
                            ->limit(2)
                            ->first();
        $kasi = Pegawai::where('jabatan', 'kasi')
                            ->first();

        $pdf = PDF::loadView('pdf.batchKwitansi', 
            ['penawaran' => $penawaran, 
            'terbilang' =>$terbilang, 
            'totalHargaBid' =>$totalHargaBid, 
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

        $id_jadwal = $penawaran->id_jadwal;
        $jadwal = Jadwal::find($id_jadwal);
        $tgl_sprint = $jadwal->tgl_sprint;
        $tgl_sprint = Carbon::parse($tgl_sprint)->translatedFormat('j F Y');

        $petugas = Pegawai::where('jabatan', 'petugas')
                            ->where('is_admin', 0)
                            ->limit(2)
                            ->get();
        $kasi = Pegawai::where('jabatan', 'kasi')
                            ->first();

        $pdf = PDF::loadView('pdf.bukti', 
            ['penawaran' => $penawaran, 
            'terbilang' =>$terbilang, 
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'tgl_sprint' => $tgl_sprint,
            'pembeli' => $pembeli,
            'petugas' => $petugas,
            'kasi' => $kasi
        ]);

        return $pdf->download('BA ' . $pembeli->nama_pembeli . '.pdf');
    }

    public function batch_bukti($pembeliID, $jadwalID){
        $penawaran = Transaksi::where('id_jadwal', $jadwalID)
                            ->where('id_pembeli', $pembeliID)
                            ->where('status', 'verified')
                            ->with('penawaran')
                            ->get();

        $pembeli = Pembeli::find($pembeliID);

        $totalHargaBid = $penawaran->sum(function ($transaksi) {
            return $transaksi->penawaran->harga_bid;
        });
        $terbilang = $this->terbilang($totalHargaBid);

        $today = Carbon::now();
        $day = $this->terbilang($today->format('j'));
        $month = $today->translatedFormat('F');
        $year = $this->terbilang($today->format('Y'));
        $month = strtolower($month);
        $year = strtolower(substr($year, 0, 1)) . substr($year, 1);

        $jadwal = Jadwal::find($jadwalID);
        $tgl_sprint = $jadwal->tgl_sprint;
        $tgl_sprint = Carbon::parse($tgl_sprint)->translatedFormat('j F Y');

        $petugas = Pegawai::where('jabatan', 'petugas')
                            ->where('is_admin', 0)
                            ->limit(2)
                            ->get();
        $kasi = Pegawai::where('jabatan', 'kasi')
                            ->first();

        // Buat PDF dengan halaman potret
        $pdfPortrait = PDF::loadView('pdf.batchBukti', [
            'penawaran' => $penawaran, 
            'terbilang' =>$terbilang, 
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'jadwal' => $jadwal,
            'tgl_sprint' => $tgl_sprint,
            'pembeli' => $pembeli,
            'petugas' => $petugas,
            'kasi' => $kasi
        ]);
        $pdfPortrait->setPaper('A4', 'portrait'); // Atur orientasi halaman potret

        // Buat PDF dengan halaman lanskap
        $pdfLandscape = PDF::loadView('pdf.batchBuktiLandscape', [
            'penawaran' => $penawaran, 
            'totalHargaBid' => $totalHargaBid, 
            'kasi' => $kasi
        ]);
        $pdfLandscape->setPaper('A4', 'landscape'); // Atur orientasi halaman lanskap

        // Menggabungkan dua objek PDF
        $merger = new Merger;
        $merger->addRaw($pdfPortrait->output());
        $merger->addRaw($pdfLandscape->output());

        // Simpan konten PDF ke dalam file
        $pdfFileName = 'BA_' . $pembeli->nama_pembeli . '.pdf';
        file_put_contents($pdfFileName, $merger->merge());

        // Unduh file
        return response()->download($pdfFileName)->deleteFileAfterSend();
    }

    public function cetak_report($id){
        $penawaran = Transaksi::where('id_jadwal', $id)
                            ->where('status', 'verified')
                            ->with('penawaran')
                            ->get();

        $totalHargaBid = $penawaran->sum(function ($transaksi) {
            return $transaksi->penawaran->harga_bid;
        });
        $terbilang = $this->terbilang($totalHargaBid);

        $today = Carbon::now();
        $day = $this->terbilang($today->format('j'));
        $month = $today->translatedFormat('F');
        $year = $this->terbilang($today->format('Y'));
        $month = strtolower($month);
        $year = strtolower(substr($year, 0, 1)) . substr($year, 1);

        $jadwal = Jadwal::find($id);
        $tgl_sprint = $jadwal->tgl_sprint;
        $start_date = $jadwal->start_date;
        $tgl_sprint = Carbon::parse($tgl_sprint)->translatedFormat('j F Y');
        $start_date = Carbon::parse($start_date)->translatedFormat('j F Y');

        $petugas = Pegawai::where('jabatan', 'petugas')
                            ->where('is_admin', 0)
                            ->limit(2)
                            ->get();
        $bendahara = Pegawai::where('jabatan', 'bendahara')
                            ->where('is_admin', 0)
                            ->get();
        $kasi = Pegawai::where('jabatan', 'kasi')
                            ->first();

        // Buat PDF dengan halaman potret
        $pdfPortrait = PDF::loadView('pdf.report', [
            'penawaran' => $penawaran, 
            'totalHargaBid' =>$totalHargaBid, 
            'terbilang' =>$terbilang, 
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'jadwal' => $jadwal,
            'tgl_sprint' => $tgl_sprint,
            'start_date' => $start_date,
            'petugas' => $petugas,
            'bendahara' => $bendahara,
            'kasi' => $kasi
        ]);
        $pdfPortrait->setPaper('A4', 'portrait'); // Atur orientasi halaman potret

        // Buat PDF dengan halaman lanskap
        $pdfLandscape = PDF::loadView('pdf.reportLandscape', [
            'penawaran' => $penawaran, 
            'totalHargaBid' => $totalHargaBid, 
            'kasi' => $kasi
        ]);
        $pdfLandscape->setPaper('A4', 'landscape'); // Atur orientasi halaman lanskap

        // Menggabungkan dua objek PDF
        $merger = new Merger;
        $merger->addRaw($pdfPortrait->output());
        $merger->addRaw($pdfLandscape->output());

        // Simpan konten PDF ke dalam file
        $pdfFileName = 'BA_Penyerahan.pdf';
        file_put_contents($pdfFileName, $merger->merge());

        // Unduh file
        return response()->download($pdfFileName)->deleteFileAfterSend();
    }

}
