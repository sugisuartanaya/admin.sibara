@extends('dashboard.layouts.main')


@section('container')
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-file" style="margin-right: 10px"></i>Edit</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li><a href="/barang-rampasan">Barang Rampasan</a></li>
                          <li class="active">Edit Harga Wajar</li>
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
            <strong>Edit Harga Wajar</strong>
          </div>
          <div class="card-body card-block">
            <form action="/harga-wajar/{{ $harga->id }}" method="post">
            @csrf
            @method('PUT')

              <div class="form-group">
                <label for="no_laporan_penilaian" class=" form-control-label">No Laporan Penilaian</label>
                <input type="text" id="no_laporan_penilaian" name="no_laporan_penilaian" class="form-control @error('no_laporan_penilaian') is-invalid @enderror" value="{{ $harga->no_laporan_penilaian }}">
                @error('no_laporan_penilaian')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="tgl_laporan_penilaian" class=" form-control-label">Tanggal Laporan Penilaian</label>
                <input type="text" id="tanggal" name="tgl_laporan_penilaian" class="form-control datetimepicker-input @error('tgl_laporan_penilaian') is-invalid @enderror" value="{{ $harga->tgl_laporan_penilaian }}" placeholder="Pilih Tanggal" data-target="#tanggal" data-toggle="datetimepicker">
                @error('tgl_laporan_penilaian')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="harga" class=" form-control-label">Harga Wajar</label>
                <input type="text" id="harga" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ $harga->harga }}">
                @error('harga')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <input type="hidden" name="id_barang" value={{ $harga->id_barang }}>
              
              <button class="btn btn-success" type="submit">Proses</button>
                                
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection