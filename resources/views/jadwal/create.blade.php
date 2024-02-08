@extends('dashboard.layouts.main')

@section('container')
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-calendar" style="margin-right: 10px"></i>Create</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li><a href="/jadwal">Jadwal</a></li>
                          <li class="active">Tambah Jadwal</li>
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
            <strong>Tambah Jadwal</strong>
          </div>
          <div class="card-body card-block">
            <form action="{{ url('jadwal') }}" method="post">
            @csrf

              <div class="form-group">
                <label for="no_sprint" class=" form-control-label">No Surat Perintah</label>
                <input type="text" id="no_sprint" name="no_sprint" class="form-control @error('no_sprint') is-invalid @enderror" value="{{ old('no_sprint') }}">
                @error('no_sprint')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="tgl_sprint" class=" form-control-label">Tanggal Surat Perintah</label>
                <input type="text" id="tanggal" name="tgl_sprint" class="form-control datetimepicker-input @error('tgl_sprint') is-invalid @enderror" value="{{ old('tgl_sprint') }}" placeholder="Pilih Tanggal" data-target="#tanggal" data-toggle="datetimepicker">
                @error('tgl_sprint')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              
              <div class="form-group">
                <label for="type" class="form-control-label">Tipe Penawaran</label>
                <div class="form-check">
                  <input type="radio" id="radio1" name="type" value="open" class="form-check-input @error('type') is-invalid @enderror" {{ old('type') == 'open' ? 'checked' : '' }}>
                  <label for="radio1" class="form-check-label">Open Bidding</label>
                  <br>
                  <input type="radio" id="radio2" name="type" value="close" class="form-check-input @error('type') is-invalid @enderror" {{ old('type') == 'close' ? 'checked' : '' }}>
                  <label for="radio2" class="form-check-label">Close Bidding</label>
                  @error('type')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            
              
              <div class="form-group">
                <label for="start_date" class=" form-control-label">Dimulai pada</label>
                <input type="text" id="datetimepicker1" name="start_date" class="form-control datetimepicker-input @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}" placeholder="Pilih Tanggal dan Waktu" data-target="#datetimepicker1" data-toggle="datetimepicker">
                @error('start_date')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              
              <div class="form-group">
                <label for="end_date" class=" form-control-label">Berakhir pada</label>
                <input type="text" id="datetimepicker" name="end_date" class="form-control datetimepicker-input @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}" placeholder="Pilih Tanggal dan Waktu" data-target="#datetimepicker" data-toggle="datetimepicker">
                @error('end_date')
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