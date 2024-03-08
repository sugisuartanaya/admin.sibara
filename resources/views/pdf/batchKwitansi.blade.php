<!doctype html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIBARA | Informasi Barang Rampasan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
      .container {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
      }
    
      .logo {
        width: 100px; /* Atur ukuran logo sesuai kebutuhan */
        height: auto; /* Atur ketinggian agar logo tidak terdistorsi */
        margin-right: 50px; /* Memberi jarak antara logo dan teks */
        margin-left: -50px;
      }
    
      .text-container {
        margin-left: 20px; /* Atur jarak antara logo dan teks */
      }

      hr {
        width: 100%; /* Atur lebar garis horizontal agar memenuhi lebar container */
        margin: 5px 0; /* Atur jarak atas dan bawah dari hr */
        border: none; /* Hapus border */
        border-top: 3px solid black; /* Tambahkan border atas dengan warna hitam */
      }

      table {
        border-collapse: collapse;
        width: 100%;
      }
      
      th, td {
        border: none;
        padding: 8px;
        text-align: left;
        vertical-align: top;
      }

      td:first-child, th:first-child {
        width: 25%; /* Atur lebar sesuai kebutuhan */
      }

      .signature-container {
        position: relative;
        width: 100%;
        height: 100px; /* Sesuaikan tinggi container sesuai kebutuhan */
        margin-top: 25px; /* Jarak antara tanda tangan dengan konten sebelumnya */
      }

      .left-signature {
          position: absolute;
          left: 0;
          top: 0;
          width: 55%;
          text-align: left;
      }

      .right-signature {
          position: absolute;
          right: -25;
          top: 0;
          width: 50%;
          text-align: left;
      }
    
      @media print {
        /* Atur tata letak untuk saat dicetak */
        .container {
          flex-direction: column;
        }
    
        .text-container {
          margin-top: 10px; /* Atur jarak antara logo dan teks saat dicetak */
          margin-left: 0; /* Setel margin kembali ke 0 */
        }
      }
    </style>
  </head>
  <body>
    <div class="container">
      <a href="/"><img src="{{ asset('images/logo2.png') }}" alt="logo" class="logo"></a>
      <div class="text-container">
        <h5 style="font-weight: normal; margin-bottom: 1px">KEJAKSAAN REPUBLIK INDONESIA</h5>
        <h5 style="font-weight: normal; margin-bottom: 0px">KEJAKSAAN TINGGI BALI</h5>
        <h2 style="margin-bottom: 1px"><strong>KEJAKSAAN NEGERI DENPASAR</strong></h2>
        <p style="margin-bottom: 1px; font-size: 10pt;"> JALAN PB. SUDIRMAN NO. 3 DENPASAR BALI 80232</p>
        <p style="margin-bottom: 1px; font-size: 10pt;">Telp. (0361)-221999, Fax: (0361)-236954. <u>www.kejari-denpasar.go.id</u></p>
      </div>
    </div>
    <hr style="border-top: 3px solid black;">
    <br>
    <h3 class="mt-0 text-center"><strong>KWITANSI / BUKTI PEMBAYARAN</strong></h4>
    <br><br>
    
    <table>
      <tr>
        <td>Sudah diterima dari</td>
        <td>: {{ $penawaran->first()->pembeli->nama_pembeli }}</td>
      </tr>
      <tr>
        <td>Jumlah Uang</td>
        <td>: Rp. {{ number_format($totalHargaBid, 0, ',', '.') }}</td>
      </tr>
      <tr>
        <td>Terbilang</td>
        <td>: *** {{ ucfirst($terbilang) . " rupiah ***" }}</td>
      </tr>
      <tr>
        <td>Untuk Pembayaran</td>
        <td>: Penjualan langsung barang rampasan berupa sesuai dengan terlampir:</td>
      </tr>
    </table>
    <h4></h4>

    <br><br>

    <div style="margin-left: 55%">
      <p>Denpasar, {{ $today }}</p>
      <br><br><br><br>
      <p style="margin-bottom:1px">{{ $petugas->nama_pegawai }}</p>
      <p>Panitia Penjualan Langsung</p>
    </div>

    <br><hr>

    <div class="signature-container">
      <div class="left-signature" >
          <br><br>
          <p>Lunas dibayar</p>
          <br><br><br><br>
          <p>{{ $penawaran->first()->pembeli->nama_pembeli }}</p>
      </div>
      <div class="right-signature">
          <p style="margin-bottom:1px">Mengetahui</p>
          <p>Kepala Seksi Pengelolaan Barang Bukti dan Barang Rampasan</p>
          <br><br><br><br>
          <p style="margin-bottom:1px">{{ $kasi->nama_pegawai }}</p>
          <p>{{ $kasi->pangkat }} NIP. {{ $kasi->nip }}</p>
      </div>
  </div>
      
  </body>
    
</html>