@extends('dashboard.layouts.main')


@section('container')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-table" style="margin-right: 10px"></i>Laporan Penjualan Langsung</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li class="active">Laporan Penjualan</li>
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
      <div class="col-4">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <strong class="card-title mb-0">Filter Per Tahun</strong>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="tahun" class=" form-control-label">Tahun</label>
              <select id="tahun" data-placeholder="{{ $data_tahun }}" name="tahun" class="standardSelect" tabindex="1">
                <option label="default"></option>  
                @for ($tahun = date('Y'); $tahun >= 2023; $tahun--)
                  <option value="{{ $tahun }}">{{ $tahun }}</option>
                @endfor
              </select>
            </div>
            <a href="/report/" id="terapkanLink" >
              <button id="terapkanButton" class="btn btn-success btn-sm" style="width: 100%;" disabled>Terapkan</button>
            </a>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <strong class="card-title mb-0">Filter Per Jadwal</strong>
          </div>
          <div class="card-body">
            <form id="reportForm" action="/report/{{ $data_tahun }}/detail" method="post">
              @csrf
              <div class="form-group">
                <label for="jadwal" class=" form-control-label">Jadwal Penjualan Langsung</label>
                <select data-placeholder="Pilih Jadwal" name="jadwal" class="standardSelect" tabindex="1">
                  @foreach ($data_jadwal as $jadwal)
                    <option value="{{ $jadwal->id }}">{{ $jadwal->no_sprint }}, Tanggal {{ $jadwal->tgl_sprint->format('d F Y') }}</option>
                  @endforeach  
                </select>
              </div>
              <button type="submit" id="terapkanLink" class="btn btn-success btn-sm" style="width: 100%;">Terapkan</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card" style="margin-bottom:5px">
          <div class="card-body">
            <div class="stat-widget-five">
              <div class="stat-icon dib flat-color-1">
                <i class="pe-7s-cash"></i>
              </div>
              <div class="stat-content">
                <div class="text-left dib">
                  <div class="stat-text">
                    <span>Rp. {{ number_format($total_pendapatan, 0, ',', '.') }}</span>
                  </div>
                  <div class="stat-heading">Pendapatan Kas Negara</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card" >
          <div class="card-body">
            <div class="stat-widget-five">
              <div class="stat-icon dib flat-color-2">
                <i class="pe-7s-box2"></i>
              </div>
              <div class="stat-content">
                <div class="text-left dib">
                  <div class="stat-text">
                    <span>{{ $data_transaksi->count() }}</span>
                  </div>
                  <div class="stat-heading">Barang Rampasan Terjual</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            @if($header == null)
              <strong class="card-title mb-0">Data Transaksi Tahun {{ $data_tahun }}</strong>
            @else
              <strong class="card-title mb-0">Data Transaksi No. Sprint Jadwal: {{ $header->no_sprint }}</strong>
              <a href="#"><button class="btn btn-success ml-auto"><i class="fa fa-print" style="margin-right: 10px"></i>Cetak</button></a>
            @endif
          </div>
          <div class="card-body">
            <table id="tabel" class="table table-striped table-bordered datatable">
              <thead>
                <tr>
                  <th style="vertical-align: middle;">No.</th>
                  <th style="vertical-align: middle;">Nama Barang</th>
                  <th style="vertical-align: middle;">Terpidana</th>
                  <th style="vertical-align: middle;">No. Putusan Pengadilan</th>
                  <th style="vertical-align: middle;">Tgl. Putusan</th>
                  <th style="vertical-align: middle;">Harga Terjual</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data_transaksi as $index => $transaksi)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{$transaksi->nama_barang}}</td>
                    <td>{{$transaksi->nama_terdakwa}}</td>
                    <td>{{$transaksi->no_putusan}}</td>
                    <td>{{$transaksi->tgl_putusan->format('d F Y')}}</td>
                    <td>Rp. {{ number_format($transaksi->harga_bid, 0, ',', '.') }}</td>
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