@extends('dashboard.layouts.main')


@section('container')
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-gavel" style="margin-right: 10px"></i>Detail Penawaran</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li><a href="/penawaran">Penawaran</a></li>
                          <li><a href="/penawaran/{{ $jadwal->id }}">{{ $jadwal->no_sprint }}</a></li>
                          <li class="active">Detail Penawaran</li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="content">
  <div class="row">
    <div class="col-md-12">
      @if(session('message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
          {{ session('message') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <strong class="card-title mb-0">Penawaran pada {{ $barang->nama_barang }}</strong>
        </div>
        <div class="card-body">
          <div class="row">
            @if($penawarTertinggi)
              <div class="col-md-4">
                @if($penawarTertinggi->status == 'menang')
                  <h3 style="font-weight: bold; margin-bottom:10px">Pemenang Lelang</h3>
                  <h5>Nama Pembeli:</h5>
                  <p>{{ $penawarTertinggi->pembeli->nama_pembeli }}</p>
                  <h5>Harga Penawaran:</h5>
                  <p>Rp. {{ number_format($penawarTertinggi->harga_bid, 0, ',', '.') }}</p>
                  <h5>Tanggal Penawaran:</h5>
                  <p>{{ \Carbon\Carbon::parse($penawarTertinggi->created_at)->format('d M Y \J\a\m\ H:i') }} WITA</p>

                  <h5>Batas Waktu Pembayaran:</h5>
                  <p><strong id="countdown" class="text-danger"></strong></p>
                  <p id="end_date" dataEndDate= {{ $countdownWinner }}></p>

                  <div class="d-flex">
                    <a href="https://wa.me/62{{ $penawarTertinggi->pembeli->no_telepon }}?text=Selamat!%0A%0AAnda%20berhasil%20memenangkan%20lelang%20pada%20website%20Sistem%20Informasi%20Penjualan%20Langsung%20Barang%20Rampasan%20Negara%20Kejaksaan%20Negeri%20Denpasar%20dengan%20item%20barang%3A%20%0A%0A{{ $penawarTertinggi->barang_rampasan->nama_barang }}%0A%0ASegera%20lakukan%20pembayaran%20dengan%20klik%20link%20berikut%20http%3A%2F%2Fsibara.test%2F%0AKami%20tunggu%20dalam%201x24%20jam.%20Jika%20tidak%20melakukan%20pembayaran%2C%20maka%20kami%20anggap%20Anda%20Wanprestasi.%0A%0ATerima%20kasih" class="btn btn-success" data-toggle="tooltip" data-original-title="Chat Pembeli"><i class="menu-icon fa fa-whatsapp"></i>&nbsp;Hubungi</a>
                    &nbsp;&nbsp;
                    <form action="/penawaran/{{ $penawarTertinggi->id }}" method="post">
                      @csrf
                      @method('PUT')
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#wanprestasi{{ $penawarTertinggi->id }}"><i class="fa fa-times-circle"></i>&nbsp;Wanprestasi</button>

                      <!-- The Modal -->
                      <div class="modal" id="wanprestasi{{ $penawarTertinggi->id }}">
                        <div class="modal-dialog modal-dialog-centered mt-2">
                          <div class="modal-content">
    
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Konfirmasi Penawaran</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body">
                              <p>Apakah anda yakin pemenang lelang wanprestasi?</p>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" name="submit" class="btn btn-danger btn-sm">Confirm
                              </button>
                            </div>
    
                          </div>
                        </div>
                      </div>

                    </form>

                  </div>
                  
                @else
                  <h3 style="font-weight: bold; margin-bottom:10px">Penawar Lelang tertinggi</h3>
                  <h5>Nama Pembeli:</h5>
                  <p>{{ $penawarTertinggi->pembeli->nama_pembeli }}</p>
                  <h5>Harga Penawaran:</h5>
                  <p>Rp. {{ number_format($penawarTertinggi->harga_bid, 0, ',', '.') }}</p>
                  <h5>Tanggal Penawaran:</h5>
                  <p>{{ \Carbon\Carbon::parse($penawarTertinggi->created_at)->format('d M Y \J\a\m\ H:i') }} WITA</p>
                  
                  <form action="/penawaran/{{ $jadwal->id }}/{{ $barang->id }}/{{ $penawarTertinggi->id }}" method="post">
                  @csrf
                  @method('PUT')
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square"></i>&nbsp;Konfirmasi</button>
                  </form>
                @endif
            
              </div>
            @else
              <div class="col-md-4">
                <h3 style="font-weight: bold; margin-bottom:10px">Tidak ada pemenang lelang</h3> 
                <h5>Penawaran yang masuk wanprestasi</h5>
              </div> 
            @endif

            
            <div class="col-md-8">
              <h3 style="font-weight: bold; margin-bottom:10px">Daftar Peserta Lelang</h3>
              <table id="tabel" class="table table-bordered datatable">
                <thead>
                  <tr>
                    <th style="vertical-align: middle;">No.</th>
                    <th style="vertical-align: middle;">Nama Pembeli</th>
                    <th style="vertical-align: middle;">Harga Penawaran</th>
                    <th style="vertical-align: middle;">Tanggal Penawaran</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_penawaran as $index => $penawaran)
                    <tr class="{{ $penawaran->status == 'menang' ? 'table-active' : ($penawaran->status == 'wanprestasi' ? 'table-danger' : '') }}">
                      <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                      <td style="vertical-align: middle;">{{ $penawaran->pembeli->nama_pembeli }}</td>
                      <td style="vertical-align: middle;">Rp. {{ number_format($penawaran->harga_bid, 0, ',', '.') }}</td>
                      <td style="vertical-align: middle;">
                          {{ \Carbon\Carbon::parse($penawaran->created_at)->format('d M Y \J\a\m\ H:i') }} WITA
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
@endsection