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
                          <li class="active">Edit Pegawai</li>
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
            <form action="/updatepegawai/{{ $data_pegawai->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
              <label for="username" class=" form-control-label">Username</label>
              <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ $data_pegawai->user->username }}">
              @error('username')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="password" class=" form-control-label">Password</label>
              <input type="password" id="password" name="password" class="form-control" style="font-style: italic" placeholder="biarkan kosong jika tidak ingin mengubah password">
            </div>
            <div class="form-group">
              <label for="email" class=" form-control-label">Email</label>
              <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $data_pegawai->user->email }}">
              @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
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
              <input type="text" id="nama_pegawai" name="nama_pegawai" class="form-control @error('nama_pegawai') is-invalid @enderror" value="{{ $data_pegawai->nama_pegawai }}">
              @error('nama_pegawai')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="nip" class=" form-control-label">NIP</label>
              <input type="text" id="nip" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ $data_pegawai->nip }}">
              @error('nip')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="pangkat" class=" form-control-label">Pangkat</label>
              <input type="text" id="pangkat" name="pangkat" class="form-control @error('pangkat') is-invalid @enderror" value="{{ $data_pegawai->pangkat }}">
              @error('pangkat')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="jabatan" class=" form-control-label">Jabatan</label>
              <select name="jabatan" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror">
                <option value="petugas" {{ $data_pegawai->jabatan === 'petugas' ? 'selected' : '' }}>
                  Petugas Barang Bukti</option>
                <option value="bendahara" {{ $data_pegawai->jabatan === 'bendahara' ? 'selected' : '' }}>
                  Bendahara Penerimaan</option>
                <option value="kasi" {{ $data_pegawai->jabatan === 'kasi' ? 'selected' : '' }}>
                  Kepala Seksi Pengelolaan Barang Bukti dan Barang Rampasan</option>
              </select>
              @error('jabatan')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="foto_pegawai" class=" form-control-label">Foto</label>
              <input type="file" id="foto_pegawai" name="foto_pegawai" class="form-control @error('foto_pegawai') is-invalid @enderror" accept="image/*" value="{{ $data_pegawai->foto_pegawai }}">
              @error('foto_pegawai')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
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
</div>
@endsection