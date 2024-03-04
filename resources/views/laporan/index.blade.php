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
              <select id="tahun" data-placeholder="Pilih Tahun" name="tahun" class="standardSelect" tabindex="1">
                <option value="" label="default"></option>  
                @for ($tahun = date('Y'); $tahun >= 2024; $tahun--)
                  <option value="{{ $tahun }}">{{ $tahun }}</option>
                @endfor
              </select>
            </div>
            <a href="/report/" id="terapkanLink" ><button class="btn btn-success btn-sm" style="width: 100%;">Terapkan</button></a>
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
                    <span class="count">0</span>
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
                    <span class="count">0</span>
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
            <strong class="card-title mb-0">Data Transaksi Penjualan Langsung</strong>
          </div>
          <div class="card-body">
            <table id="tabel" class="table table-striped table-bordered datatable">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Nama Barang</th>
                  <th scope="col">Terpidana</th>
                  <th scope="col">No. Putusan Pengadilan</th>
                  <th scope="col">Tgl. Putusan</th>
                  <th scope="col">Harga Terjual</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> 
@endsection