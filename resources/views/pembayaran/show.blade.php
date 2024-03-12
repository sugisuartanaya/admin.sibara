@extends('dashboard.layouts.main')


@section('container')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-credit-card" style="margin-right: 10px"></i>Pembayaran</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li><a href="/transaksi">Transaksi</a></li>
                          <li class="active">Pembayaran</li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="content">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
          <div class="card">

              <div class="card-header d-flex justify-content-between align-items-center"">
                  <strong class="card-title mb-0">Daftar Pembayaran</strong>
              </div>
              <div class="card-body">
                <table id="tabel" class="table table-striped table-bordered datatable">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Nama Pemenang</th>
                      <th scope="col">Tgl. Transaksi</th>
                      <th scope="col">Nama Barang</th>
                      <th scope="col">No. Putusan Pengadilan</th>
                      <th scope="col">Status</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($payment as $index => $pay )
                      <tr>
                        <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                        <td style="vertical-align: middle;">{{ $pay->pembeli->nama_pembeli }}</td>
                        <td style="vertical-align: middle;">{{ \Carbon\Carbon::parse($pay->tanggal)->format('d M Y \J\a\m\ H:i') }}</td>
                        <td style="vertical-align: middle; width: 25%;">{{ $pay->nama_barang }}</td>
                        <td style="vertical-align: middle;">{{ $pay->no_putusan }}</td>
                        @if($pay->status == 'review')
                          <td style="vertical-align: middle;"><span class="badge badge-secondary">Menunggu Konfirmasi</span></td>
                          <td style="vertical-align: middle;"><a href="/penawaran/{{ $pay->id_jadwal }}/showbidder/{{ $pay->id_barang }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-original-title="Cek Transaksi"><i class="menu-icon fa fa-eye"></i></a></td>
                        @elseif ($pay->status == 'data_salah')
                          <td style="vertical-align: middle;"><span class="badge badge-danger">Transaksi Salah</span></td>
                          <td style="vertical-align: middle;"><a href="/penawaran/{{ $pay->id_jadwal }}/showbidder/{{ $pay->id_barang }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-original-title="Cek Transaksi"><i class="menu-icon fa fa-eye"></i></a></td>
                        @else 
                          <td style="vertical-align: middle;"><span class="badge badge-success">Sukses</span></td>
                          <td style="vertical-align: middle;">
                            <a href="/cetak-kwitansi/{{ $pay->id_penawaran }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Cetak Kwitansi"><i class="fa fa-file-text"></i></a>
                            <a href="/cetak-bukti/{{ $pay->id_penawaran }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Cetak Bukti"><i class="menu-icon fa fa-print"></i></a>
                          </td>
                        @endif
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              
          </div>
      </div>

      @if($pembeli)
        <div class="col-12">
          <div class="card">
            <div class="card-header"><strong>Pembelian lebih dari 1 barang rampasan</strong></div>
            <div class="card-body">
              <table class="table table-striped table-bordered">
                <thead>
                  <th>Nama Pemenang</th>
                  <th>Cetak</th>
                </thead>
                <tbody>
                  @foreach($pembeli as $index => $p)
                    <tr>
                      <td>{{ $p->first()->pembeli->nama_pembeli }}</td>
                      <td>
                        <a href="/batch-kwitansi/{{ $p->first()->id_pembeli }}/{{ $p->first()->id_jadwal }}" class="btn btn-primary btn-sm"><i class="fa fa-file-text"></i> Kwitansi</a>
                        <a href="/batch-bukti/{{ $p->first()->id_pembeli }}/{{ $p->first()->id_jadwal }}" class="btn btn-warning btn-sm"><i class="fa fa-print"></i> Bukti</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      @endif
      
    </div>
  </div>
</div> 

@endsection