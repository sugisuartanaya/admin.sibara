@extends('dashboard.layouts.main')


@section('container')
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-tags" style="margin-right: 10px"></i>Edit</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li><a href="/kategori">Kategori</a></li>
                          <li class="active">Edit Kategori</li>
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
            <strong>Edit Kategori</strong>
          </div>
          <div class="card-body card-block">
            <form action="/kategori/{{ $data_kategori->id }}" method="post">
            @csrf
            @method('PUT')

              <div class="form-group">
                <label for="nama_kategori" class=" form-control-label">Nama Kategori</label>
                <input type="text" id="nama_kategori" name="nama_kategori" value="{{ $data_kategori->nama_kategori }}" class="form-control @error('nama_kategori') is-invalid @enderror">
                @error('nama_kategori')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              
              <button class="btn btn-success" type="submit">Simpan</button>
                                
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection