@extends('dashboard.layouts.main')


@section('container')
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-cube" style="margin-right: 10px"></i>Edit</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li><a href="/barang-rampasan">Barang Rampasan</a></li>
                          <li class="active">Edit Barang</li>
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
            <strong>Edit Barang Rampasan</strong>
          </div>
          <div class="card-body card-block">
            <form action="/barang-rampasan/{{ $data_barang->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

              <div class="form-group">
                <label for="no_putusan" class=" form-control-label">No Putusan Pengadilan</label>
                <input type="text" id="no_putusan" name="no_putusan" class="form-control @error('no_putusan') is-invalid @enderror" value="{{ $data_barang->no_putusan }}">
                @error('no_putusan')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="tgl_putusan" class=" form-control-label">Tanggal Putusan Pengadilan</label>
                <input type="text" id="tanggal" name="tgl_putusan" class="form-control datetimepicker-input @error('tgl_putusan') is-invalid @enderror" value="{{ $data_barang->tgl_putusan }}" data-target="#tanggal" data-toggle="datetimepicker">
                @error('tgl_putusan')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="nama_terdakwa" class=" form-control-label">Nama Terdakwa</label>
                <input type="text" id="nama_terdakwa" name="nama_terdakwa" class="form-control @error('nama_terdakwa') is-invalid @enderror" value="{{ $data_barang->nama_terdakwa }}">
                @error('nama_terdakwa')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              
              <div class="form-group">
                <label for="nama_barang" class=" form-control-label">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" value="{{ $data_barang->nama_barang }}">
                @error('nama_barang')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="kategori_id" class=" form-control-label">Kategori</label>
                <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                  @foreach ($data_kategori as $kategori)
                    <option value="{{ $kategori->id }}" {{ $kategori->id == $data_barang->kategori_id ? 'selected' : '' }}>
                      {{ $kategori->nama_kategori }}
                    </option>
                  @endforeach
                </select>
                @error('kategori_id')
                  <div class="invalid-feedback" role="alert">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="deskripsi" class=" form-control-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="9" class="form-control @error('deskripsi') is-invalid @enderror">
                  {{ $data_barang->deskripsi }}
                </textarea>
                @error('deskripsi')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="foto_thumbnail" class=" form-control-label">Foto Thumbnail</label>
                <input type="file" id="foto_thumbnail" name="foto_thumbnail" class="form-control @error('foto_thumbnail') is-invalid @enderror" accept="image/*">
                @error('foto_thumbnail')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group" id="tambahanFotoBarang">
                <label for="foto_barang" class=" form-control-label">Foto Barang</label>
                <input type="file" id="foto_barang" name="foto_barang[]" class="form-control foto_barang @error('foto_barang') is-invalid @enderror" multiple accept="image/*">
                <br>
                @error('foto_barang')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              
              <br>
              
              <button class="btn btn-success" type="submit">Proses</button>
                                
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection