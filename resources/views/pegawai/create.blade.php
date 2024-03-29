@extends('dashboard.layouts.main')

@section('container')
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-users" style="margin-right: 10px"></i>Create</h1>
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
            <strong>Tambah Pegawai</strong>
          </div>
          <div class="card-body card-block">
            <form action="/admin/tambahPegawai" method="post" enctype="multipart/form-data">
            @csrf

              <div class="form-group">
                <label for="username" class=" form-control-label">Username</label>
                <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
                @error('username')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="password" class=" form-control-label">Password</label>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
                @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              
              <div class="form-group">
                <label for="email" class=" form-control-label">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              
              <input type="text" style="display:none;" id="role" name="role" class="form-control" value="1">
              {{-- <input type="text" style="display:none;" id="is_admin" name="is_admin" class="form-control" value="false"> --}}
              {{-- <input type="text" style="display:none;" id="user_id" name="user_id" class="form-control"> --}}

              <div class="form-group">
                <label for="select" class=" form-control-label">Admin</label>
                <div class="form-check">
                  <div class="checkbox">
                      <label for="checkbox1" class="form-check-label ">
                        <input type="checkbox" id="checkbox1" name="is_admin">&nbsp; Hak Akses Administrator
                      </label>
                </div>
              </div>

              <br>
              
              <div class="form-group">
                <label for="nama_pegawai" class=" form-control-label">Nama Pegawai</label>
                <input type="text" id="nama_pegawai" name="nama_pegawai" class="form-control @error('nama_pegawai') is-invalid @enderror" value="{{ old('nama_pegawai') }}">
                @error('nama_pegawai')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="nip" class=" form-control-label">NIP</label>
                <input type="text" id="nip" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}">
                @error('nip')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="pangkat" class=" form-control-label">Pangkat</label>
                <input type="text" id="pangkat" name="pangkat" class="form-control @error('pangkat') is-invalid @enderror" value="{{ old('pangkat') }}">
                @error('pangkat')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="jabatan" class=" form-control-label">Jabatan</label>
                <select name="jabatan" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror">
                  <option value="0" class="form-control @error('jabatan') is-invalid @enderror">Pilih Jabatan</option>
                  <option value="petugas">Petugas Barang Bukti</option>
                  <option value="bendahara">Bendahara Penerimaan</option>
                  <option value="kasi">Kepala Seksi Pengelolaan Barang Bukti dan Barang Rampasan</option>
                </select>
                @error('jabatan')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="foto_pegawai" class=" form-control-label">Foto</label>
                <input type="file" id="foto_pegawai" name="foto_pegawai" class="form-control @error('foto_pegawai') is-invalid @enderror" accept="image/*">
                @error('foto_pegawai')
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
</div>
@endsection