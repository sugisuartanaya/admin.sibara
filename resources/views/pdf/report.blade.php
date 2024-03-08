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

      .indent {
          text-indent: 22px;
      }

      table {
        border-collapse: collapse;
        width: 100%; 
      }
      
      th, td {
        border: none;
        padding: 0px;
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
          left: -30;
          top: 0;
          width: 55%;
          text-align: center;
      }

      .right-signature {
          position: absolute;
          right: 10;
          top: 0;
          width: 45%;
          text-align: center;
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
    <h4 class="mt-0 mb-0 text-center"><strong>BERITA ACARA</strong></h4>
    <h4 class="mt-0 text-center"><strong>PENYERAHAN UANG HASIL PENJUALAN LANGSUNG BARANG RAMPASAN</strong></h4>
    <p style="text-align: justify">
      ----Pada hari ini tanggal {{ $day }} bulan {{ $month }} tahun {{ $year }}, Kami:
    </p>
    
    <table style="margin-left: 30px;">
      <tr>
        <td style="width: 25%;">Nama</td>
        <td>: {{ $kasi->nama_pegawai }}</td>
      </tr>
      <tr>
        <td style="width: 25%;">Pangkat/NIP</td>
        <td>: {{ $kasi->pangkat }} / NIP. {{ $kasi->nip }}</td>
      </tr>
      <tr>
        <td style="width: 25%;">Jabatan</td>
        <td>: Kepala Seksi Pengelolaan Barang Bukti dan Barang Rampasan</td>
      </tr>
    </table>

    <p class="indent" style="text-align: justify; margin-top: 10px">
      Telah menyerahkan uang hasil penjualan langsung Barang Rampasan yang dilaksanakan pada tanggal {{ $start_date }} sebesar : Rp. {{ number_format($totalHargaBid, 0, ',', '.') }},- ({{ ucfirst($terbilang) }} rupiah) berdasarkan Surat Perintah Penjualan Langsung Kepala Kejaksaann Negeri Denpasar nomor : {{ $jadwal->no_sprint }} tanggal {{ $tgl_sprint }} berupa dengan rincian sebagaimana terlampir.
    </p>

    <p class="mb-0" style="text-indent: 30px;">Kepada :</p>

    <table class="mt-0" style="margin-left: 30px;">
      <tr>
        <td style="width: 25%;">Nama</td>
        <td>: {{ $bendahara->first()->nama_pegawai }}</td>
      </tr>
      <tr>
        <td style="width: 25%;">Pangkat / NIP</td>
        <td>: {{ $bendahara->first()->pangkat }} / NIP. {{ $bendahara->first()->nip }}</td>
      </tr>
      <tr>
        <td style="width: 25%;">Jabatan</td>
        <td>: Bendahara Penerimaan</td>
      </tr>
    </table>

    <p class="indent" style="text-align: justify; margin-top: 10px">
      Demikianlah Berita Acara penyerahan tanggung jawab / penerimaan uang hasil bersih lelang barang rampasan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.
    </p>

    <div class="signature-container">
      <div class="left-signature" >
          <p style="margin-bottom:1px">Yang menerima,</p>
          <p>Bendahara Penerimaan</p>
          <br><br><br>
          <p class="mb-1" style="text-decoration: underline">{{ $bendahara->first()->nama_pegawai }}</p>
          <p class="mt-0">{{ $bendahara->first()->pangkat }} NIP. {{ $bendahara->first()->nip }}</p>
      </div>
      <div class="right-signature">
          <p style="margin-bottom:1px">Yang menyerahkan,</p>
          <p>Kepala Seksi Pengelolaan Barang Bukti dan Barang Rampasan</p>
          <br><br>
          <p class="mb-1" style="text-decoration: underline">{{ $kasi->nama_pegawai }}</p>
          <p class="mt-0">{{ $kasi->pangkat }} NIP. {{ $kasi->nip }}</p>
      </div>
    </div>
    <br><br><br><br><br>
    <p style="text-align: center">Saksi - saksi</p>
    <br><br>
    <div class="signature-container">
      <div class="left-signature" >
          <p class="mb-1"> 1. <span style="text-decoration: underline">{{ $petugas->first()->nama_pegawai }}</span></p>
          <p class="mt-0">{{ $petugas->first()->pangkat }} NIP. {{ $petugas->first()->nip }}</p>
      </div>
      <div class="right-signature">
          <p class="mb-1">2. <span style="text-decoration: underline">{{ $petugas->last()->nama_pegawai }}</span></p>
          <p class="mt-0">{{ $petugas->last()->pangkat }} NIP. {{ $petugas->last()->nip }}</p>
      </div>
    </div>
  

    
    {{-- <br><br><br><br><br>
    <p>Saksi-saksi</p>
    @foreach ($petugas as $index => $p)
      <div class="mb-3">
        <div style="float: left; width: 5px;">{{ $index + 1 }}.</div>
        <div style="margin-left: 18px;">
          <table class="mt-0">
            <tr>
              <td style="width: 65%;">{{ $p->nama_pegawai }}</td>
              <td>........................</td>
            </tr>
            <tr>
          </table>
        </div>
        <div style="clear: both;"></div>
      </div>
    @endforeach  --}}
  </body>
    
</html>