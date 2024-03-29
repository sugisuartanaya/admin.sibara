@extends('dashboard.layouts.main')


@section('container')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-shopping-cart" style="margin-right: 10px"></i>Transaksi</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li class="active">Transaksi</li>
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
          <div class="card-header d-flex justify-content-between align-items-center">
              <strong class="card-title mb-0">Transaksi Tiap Jadwal</strong>
          </div>
          <div class="card-body">
            <table id="tabel" class="table table-striped table-bordered datatable">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">No. Sprint Jadwal</th>
                  <th scope="col">Tgl. Sprint Jadwal</th>
                  <th scope="col">Waktu Pelaksanaan</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data_jadwal as $index => $jadwal)
                  <tr>
                    <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                    <td style="vertical-align: middle;">{{ $jadwal->no_sprint }}</td>
                    <td style="vertical-align: middle;">
                      {{ \Carbon\Carbon::parse($jadwal->tgl_sprint)->translatedFormat('d F Y') }}  
                    </td>
                    <td style="vertical-align: middle;">
                      {{ \Carbon\Carbon::parse($jadwal->start_date)->translatedFormat('d F Y') }} s/d 
                      {{ \Carbon\Carbon::parse($jadwal->end_date)->translatedFormat('d F Y') }} jam 
                      {{ $jadwal->start_date->format('H:i') }} - {{ $jadwal->start_date->format('H:i') }} WITA
                    </td>
                    <td class="text-center align-middle">
                      <a href="/penawaran/{{ $jadwal->id }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Cek Penawaran"><i class="menu-icon fa fa-gavel"></i></a>
                      <a href="/pembayaran/{{ $jadwal->id }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-original-title="Cek Pembayaran"><i class="menu-icon fa fa-credit-card-alt"></i></a>
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
@endsection