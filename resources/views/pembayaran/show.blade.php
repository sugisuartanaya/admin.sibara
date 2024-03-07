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
                          <li class="active">Detail</li>
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
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pay->nama_pembeli }}</td>
                        <td>{{ \Carbon\Carbon::parse($pay->tanggal)->format('d M Y \J\a\m\ H:i') }}</td>
                        <td>{{ $pay->nama_barang }}</td>
                        <td>{{ $pay->no_putusan }}</td>
                        @if($pay->transaksi_status == 'review')
                          <td><span class="badge badge-secondary">Menunggu Konfirmasi</span></td>
                          <td><a href="/penawaran/{{ $pay->no_sprint }}/showbidder/{{ $pay->id }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-original-title="Cek Transaksi"><i class="menu-icon fa fa-eye"></i></a></td>
                        @elseif ($pay->transaksi_status == 'data_salah')
                          <td><span class="badge badge-danger">Transaksi Salah</span></td>
                          <td><a href="/penawaran/{{ $pay->no_sprint }}/showbidder/{{ $pay->id }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-original-title="Cek Transaksi"><i class="menu-icon fa fa-eye"></i></a></td>
                        @else 
                          <td><span class="badge badge-success">Sukses</span></td>
                          <td>
                            <a href="/cetak-kwitansi/{{ $pay->id }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Cetak Kwitansi"><i class="fa fa-file-text"></i></a>
                            <a href="/cetak-bukti" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Cetak Bukti"><i class="menu-icon fa fa-print"></i></a>
                          </td>
                        @endif
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

@endsection