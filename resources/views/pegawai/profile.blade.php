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
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center"">
            <strong class="card-title mb-0">{{ auth()->user()->pegawai->nama_pegawai }}</strong>
            {{-- <a href="/pegawai/create"><button class="btn btn-success ml-auto"><i class="fa fa-plus" style="margin-right: 10px"></i>Tambah</button></a> --}}
          </div>
          <div class="card-body">
            Nama: {{ auth()->user()->pegawai->nama_pegawai }}
          </div>
        </div>
      </div>    
    </div>    
  </div>    
</div>    

@endsection