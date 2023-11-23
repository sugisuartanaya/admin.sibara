@extends('dashboard.layouts.main')

@section('container')
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-users" style="margin-right: 10px"></i>Edit</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li><a href="/pegawai">Pegawai</a></li>
                          <li class="active">Tambah Pegawai</li>
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
            <strong>Edit Pegawai</strong>
          </div>
          <div class="card-body card-block">           
            <form action="/updatepegawai/{{ $data_pegawai->nip }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
              <label for="username" class=" form-control-label">Username</label>
              <input type="text" id="username" name="username" class="form-control" value="{{ $data_pegawai->user->username }}" required>
            </div>
            <div class="form-group">
              <label for="password" class=" form-control-label">Password</label>
              <input type="password" id="password" name="password" class="form-control" style="font-style: italic" placeholder="biarkan kosong jika tidak ingin mengubah password">
            </div>
            
            <div class="form-group">
              <label for="select" class=" form-control-label">Admin</label>
              <div class="form-check">
                <div class="checkbox">
                    <label for="checkbox1" class="form-check-label ">
                      <input type="checkbox" id="checkbox1" name="is_admin" {{ $data_pegawai->is_admin ? 'checked' : '' }}>&nbsp; Hak Akses Administrator
                    </label>
              </div>
            </div>
            <br>
            
            <div class="form-group">
              <label for="nama_pegawai" class=" form-control-label">Nama Pegawai</label>
              <input type="text" id="nama_pegawai" name="nama_pegawai" class="form-control" value="{{ $data_pegawai->nama_pegawai }}" required>
            </div>
            <div class="form-group">
              <label for="nip" class=" form-control-label">NIP</label>
              <input type="text" id="nip" name="nip" class="form-control" value="{{ $data_pegawai->nip }}" required>
            </div>
            <div class="form-group">
              <label for="pangkat" class=" form-control-label">Pangkat</label>
              <input type="text" id="pangkat" name="pangkat" class="form-control" value="{{ $data_pegawai->pangkat }}" required>
            </div>
            <div class="form-group">
              <label for="jabatan" class=" form-control-label">Jabatan</label>
              <input type="text" id="jabatan" name="jabatan" class="form-control" value="{{ $data_pegawai->jabatan }}" required>
            </div>
            <div class="form-group">
              <label for="foto_pegawai" class=" form-control-label">Foto</label>
              <input type="text" id="foto_pegawai" name="foto_pegawai" class="form-control" accept="image/*" value="{{ $data_pegawai->foto_pegawai }}">
            </div>
            <br>
            <button class="btn btn-success" type="submit">Simpan</button>
                                
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection