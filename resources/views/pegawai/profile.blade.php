@extends('dashboard.layouts.main')


@section('container')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-user" style="margin-right: 10px"></i>My Profile</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li class="active">Profile</li>
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
        
        @if(session('success'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @elseif(session('error'))
          <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

      @if($errors->has('password'))
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
          {{ $errors->first('password') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      </div>
      <div class="col-6">
        <div class="card">
          {{-- <div class="card-header d-flex justify-content-between align-items-center"">
            <strong class="card-title mb-0 text-center">{{ auth()->user()->pegawai->nama_pegawai }}</strong>
          </div> --}}
          <div class="card-body">
            <table class="table table-striped">
              <tbody>
                <tr>
                  <td>Nama</td>
                  <td></td>
                  <td>{{ auth()->user()->pegawai->nama_pegawai }}</td>
                </tr>
                <tr>
                  <td>Satker</td>
                  <td></td>
                  <td>Kejaksaan Negeri Denpasar</td>
                </tr>
                <tr>
                  <td>NIP</td>
                  <td></td>
                  <td>{{ auth()->user()->pegawai->nip }}</td>
                </tr>
                <tr>
                  <td>Jabatan</td>
                  <td></td>
                  <td>{{ auth()->user()->pegawai->jabatan }}</td>
                </tr>
                <tr>
                  <td>Pangkat</td>
                  <td></td>
                  <td>{{ auth()->user()->pegawai->pangkat }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>    

      <div class="col-6">
        <div class="card">
          <div class="card-body">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Update Profile</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Update Password</a>
              </li>
            </ul>

            <div class="tab-content pl-3 p-1" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <br>
                <form action="/pegawai/{{ auth()->user()->pegawai->nip }}" method="post">
                  @csrf
                  @method('PUT')
      
                  <div class="form-group">
                    <label for="nama_pegawai" class=" form-control-label">Nama Pegawai</label>
                    <input type="text" id="nama_pegawai" name="nama_pegawai" class="form-control @error('nama_pegawai') is-invalid @enderror" value="{{ auth()->user()->pegawai->nama_pegawai }}">
                    @error('nama_pegawai')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="nip" class=" form-control-label">NIP</label>
                    <input type="text" id="nip" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ auth()->user()->pegawai->nip }}">
                    @error('nip')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pangkat" class=" form-control-label">Pangkat</label>
                    <input type="text" id="pangkat" name="pangkat" class="form-control @error('pangkat') is-invalid @enderror" value="{{ auth()->user()->pegawai->pangkat }}">
                    @error('pangkat')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="jabatan" class=" form-control-label">Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ auth()->user()->pegawai->jabatan }}">
                    @error('jabatan')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="foto_pegawai" class=" form-control-label">Foto</label>
                    <input type="text" id="foto_pegawai" name="foto_pegawai" class="form-control" accept="image/*" value="{{ auth()->user()->pegawai->foto_pegawai }}">
                  </div>
                  <br>
                  <button class="btn btn-success" type="submit">Simpan</button>
                                      
                  </form>
              </div>

              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <br>
                <form action="/updateUser/{{ auth()->user()->id }}" method="post">
                  @csrf
                  @method('PUT')

                  <div class="form-group">
                    <label for="current_password" class=" form-control-label">Current Password</label>
                    <input type="password" name="current_password" class="form-control" placeholder="masukkan password saat ini" required>
                  </div>

                  <div class="form-group">
                    <label for="password" class=" form-control-label">New Password</label>
                    <input type="password" name="password" class="form-control" placeholder="masukkan password baru" required>
                  </div>

                  <div class="form-group">
                    <label for="password_confirmation" class=" form-control-label">Confirm New Password Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="konfirmasi password baru" required>
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
</div>    

@endsection