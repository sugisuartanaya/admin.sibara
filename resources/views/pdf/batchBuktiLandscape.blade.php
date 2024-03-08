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

      hr {
        width: 100%; /* Atur lebar garis horizontal agar memenuhi lebar container */
        margin: 5px 0; /* Atur jarak atas dan bawah dari hr */
        border: none; /* Hapus border */
        border-top: 3px solid black; /* Tambahkan border atas dengan warna hitam */
      }

      table {
        border-collapse: collapse;
        border: 1px solid black;
        width: 100%; 
      }

      th, td {
        border: 1px solid black;
        padding: 0px;
        text-align: center;
        vertical-align: top;
        vertical-align: middle;
      }

      .signature-container {
        position: relative;
        width: 100%;
        height: 100px; /* Sesuaikan tinggi container sesuai kebutuhan */
        margin-top: 25px; /* Jarak antara tanda tangan dengan konten sebelumnya */
      }

      .right-signature {
          position: absolute;
          right: -30px;
          top: 0;
          width: 50%;
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
    <p style="text-align: right">
      Lampiran Berita Acara Penjualan Langsung Barang Rampasan Negara
    </p>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>No.</th>
          <th>Nama Barang</th>
          <th>Jumlah</th>
          <th>Terpidana</th>
          <th>Putusan Nomor</th>
          <th>Tanggal Putusan</th>
          <th>Harga Terjual</th>
        </tr>
        <tr>
          <td>1</td>
          <td>2</td>
          <td>3</td>
          <td>4</td>
          <td>5</td>
          <td>6</td>
          <td>7</td>
        </tr>
      </thead>
      <tbody>
        @foreach($penawaran as $index => $p)
          <tr>
            <td style="width: 5%;">{{ $index + 1 }}</td>
            <td style="width: 20%;">{{ $p->penawaran->barang_rampasan->nama_barang }}</td>
            <td style="width: 10%;">1 (unit)</td>
            <td>{{ $p->penawaran->barang_rampasan->nama_terdakwa }}</td>
            <td>{{ $p->penawaran->barang_rampasan->no_putusan }}</td>
            <td>{{ \Carbon\Carbon::parse($p->penawaran->barang_rampasan->tgl_putusan)->format('d/m/Y') }}</td>
            <td>Rp. {{ number_format($p->penawaran->harga_bid, 0, ',', '.') }}</td>
          </tr>
        @endforeach
        <tr>
          <td colspan="6" style="text-align: right;">Total Hasil Penjualan &nbsp;</td>
          <td>Rp. {{ number_format($totalHargaBid, 0, ',', '.') }}</td>
        </tr>
      </tbody>
    </table>

    <br>

    <div class="signature-container">
      <div class="right-signature">
          <p class="mb-0">Kepala Seksi Pengelolaan Barang Bukti</p>
          <p class="mt-0">dan Barang Rampasan</p>
          <br><br>
          <p class="mb-1" style="text-decoration: underline">{{ $kasi->nama_pegawai }}</p>
          <p class="mt-0">{{ $kasi->pangkat }} NIP. {{ $kasi->nip }}</p>
      </div>
    </div>
    <br><br><br><br><br>
  </body>
    
</html>