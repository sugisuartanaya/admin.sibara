@extends('dashboard.layouts.main')

@section('container')
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-calendar" style="margin-right: 10px"></i>Jadwal Penjualan Langsung</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li><a href="/jadwal">Jadwal</a></li>
                          <li class="active">Detail Jadwal</li>
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
          <div class="card-header">
            <strong>Informasi Jadwal Penjualan Langsung</strong>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-7">
                <div class="d-flex justify-content-between align-items-center">
                  <strong>Daftar Barang yang akan Dijual</strong>
                  <a href="/daftar-barang/create/{{ $jadwal->id }}"><button class="btn btn-success btn-sm ml-auto"><i class="fa fa-plus" style="margin-right: 10px"></i>Tambah Barang</button></a>
                </div>
                <br>
                <table id="tabel" class="table table-striped table-bordered datatable">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Nama Barang</th>
                      <th scope="col">Kategori</th>
                      <th scope="col">Harga</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($daftar as $index => $barang)
                      <tr>
                        <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                        <td style="vertical-align: middle;">{{ $barang->barang_rampasan->nama_barang }}</td>
                        <td style="vertical-align: middle;">{{ $barang->barang_rampasan->kategori->nama_kategori }}</td>
                        <td style="vertical-align: middle;">
                          @if ($barang->barang_rampasan->harga_wajar->isNotEmpty())
                            Rp. {{ number_format($barang->barang_rampasan->harga_wajar->last()->harga, 0, ',', '.') }}
                          @else
                            -
                          @endif
                      </td>
                        <td style="vertical-align: middle;">aksi</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="col-md-5">
                <table class="table table-borderless table-sm table-compact">
                  <tbody>
                    <tr>
                      <td scope="col">Surat Perintah Penjualan langsung: </td>
                      <td scope="col">{{ $jadwal->no_sprint }}</td>
                    </tr>
                    <tr>
                      <td scope="col">Tgl. Surat Perintah Penjualan langsung: </td>
                      <td scope="col">{{ $jadwal->tgl_sprint->format('F j, Y') }}</td>
                    </tr>
                    <tr><td>
                      <strong>Dilaksanakan pada</strong>
                    </td></tr>
                    <tr>
                      <td scope="col">Tgl Dimulai: </td>
                      <td scope="col">{{ $jadwal->start_date->format('F j, Y') }}</td>
                    </tr>
                    <tr>
                      <td scope="col">Tgl Berakhir: </td>
                      <td scope="col">{{ $jadwal->end_date->format('F j, Y') }}</td>
                    </tr>
                    <tr>
                      <td scope="col">Waktu: </td>
                      <td scope="col">{{ $jadwal->start_date->format('H:i') }} - {{ $jadwal->end_date->format('H:i') }}</td>
                    </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection