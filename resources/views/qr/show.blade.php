<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIBARA | Informasi Barang Rampasan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

</head>

<body>
  <div class="container py-5">
    <div class="row">
      <div class="col-md-12 d-flex align-items-center justify-content-center text-center">
        <a href="/"><img src="{{ asset('images/logo2.png') }}" alt="logo" class="logo"></a>
        &nbsp;&nbsp;
        <div>
          <h5 class="mb-0" style="font-weight: normal;">Kejaksaan Republik Indonesia</h6>
          <h4 class="mb-0" style="font-weight: normal;">Kejaksaan Tinggi Bali</h5>
          <h3 class="mt-0"><strong>Kejaksaan Negeri Denpasar</strong></h4>
        </div>
      </div>
    </div>
    <div class="row py-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3>Informasi Barang Rampasan</h3>
          </div>
          <div class="card-body">
            <p class="text-secondary mb-0">Nama Barang</p>
            <h6 class="mb-3"><strong>{{ $barang->nama_barang }}</strong></h6>

            <p class="text-secondary mb-0">Nama Terdakwa</p>
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