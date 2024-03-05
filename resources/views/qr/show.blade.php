<!doctype html>
<html class="no-js" lang="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIBARA | Informasi Barang Rampasan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <style>
    .containers {
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
  </style>
</head>

<body>
  <div class="containers mt-5">
    <a href="/"><img src="{{ asset('images/logo2.png') }}" alt="logo" class="logo"></a>
    <div class="text-container">
      <h5 style="font-weight: normal; margin-bottom: 1px">KEJAKSAAN REPUBLIK INDONESIA</h5>
      <h5 style="font-weight: normal; margin-bottom: 0px">KEJAKSAAN TINGGI BALI</h5>
      <h2 style="margin-bottom: 1px"><strong>KEJAKSAAN NEGERI DENPASAR</strong></h2>
      <p style="margin-bottom: 1px; font-size: 10pt;"> JALAN PB. SUDIRMAN NO. 3 DENPASAR BALI 80232</p>
      <p style="margin-bottom: 1px; font-size: 10pt;">Telp. (0361)-221999, Fax: (0361)-236954. <u>www.kejari-denpasar.go.id</u></p>
    </div>
  </div>
  <div class="container">
    <div class="row py-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3>Informasi Barang Rampasan</h3>
          </div>
          <div class="card-body">
            <p class="text-secondary mb-0">Nama Barang</p>
            <h6 class="mb-3"><strong>{{ $barang->nama_barang }}</strong></h6>

            <p class="text-secondary mb-0">Nama Terpidana</p>
            <h6 class="mb-3"><strong>{{ $barang->nama_terdakwa }}</strong></h6>
            
            <p class="text-secondary mb-0">Kategori Barang</p>
            <h6 class="mb-3"><strong>{{ $barang->kategori->nama_kategori }}</strong></h6>
            
            <p class="text-secondary mb-0">No Putusan Pengadilan</p>
            <h6 class="mb-3"><strong>{{ $barang->no_putusan }}</strong></h6>
            
            @if ($barang->izin)
              <p class="text-secondary mb-0">No Surat Keterangan Izin Penjualan Barang</p>
              <h6 class="mb-3"><strong>{{ $barang->izin->no_sk }}</strong></h6>

              <p class="text-secondary mb-0">Tanggal Surat Keterangan Izin Penjualan Barang</p>
              <h6 class="mb-3"><strong>{{ $barang->izin->tgl_sk }}</strong></h6>
            @else
              <p class="text-secondary mb-0">No Surat Keterangan Izin Penjualan Barang</p>
              <h6 class="mb-3"><strong>-</strong></h6>

              <p class="text-secondary mb-0">Tanggal Surat Keterangan Izin Penjualan Barang</p>
              <h6 class="mb-3"><strong>-</strong></h6>
            @endif

            @if ($barang->harga_wajar && $barang->harga_wajar->last())
              <p class="text-secondary mb-0">Harga Wajar Terkini</p>
              <h6 class="mb-3"><strong>Rp. {{ number_format($barang->harga_wajar->last()->harga, 0, ',', '.') }}</strong></h6>
            @else
              <p class="text-secondary mb-0">Harga Wajar Terkini</p>
              <h6 class="mb-3"><strong>-</strong></h6>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>