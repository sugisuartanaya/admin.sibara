@extends('dashboard.layouts.main')


@section('container')
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-file" style="margin-right: 10px"></i>Create</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li><a href="/barang-rampasan">Barang Rampasan</a></li>
                          <li class="active">Tambah Izin Penjualan</li>
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
            <strong>Tambah Izin Penjualan</strong>
          </div>
          <div class="card-body card-block">
            <form action="/izin/create/{{ $data_barang->id }}" method="post">
            @csrf

              <div class="form-group">
                <label for="no_sk" class=" form-control-label">No Surat Keterangan Izin Penjualan</label>
                <input type="text" id="no_sk" name="no_sk" class="form-control @error('no_sk') is-invalid @enderror" value="{{ old('no_sk') }}">
                @error('no_sk')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="tgl_sk" class=" form-control-label">Tanggal Surat Keterangan Izin Penjualan</label>
                <input type="text" id="tanggal" name="tgl_sk" class="form-control datetimepicker-input @error('tgl_sk') is-invalid @enderror" value="{{ old('tgl_sk') }}" placeholder="Pilih Tanggal" data-target="#tanggal" data-toggle="datetimepicker">
                @error('tgl_sk')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              
              <button class="btn btn-success" type="submit">Proses</button>
                                
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection