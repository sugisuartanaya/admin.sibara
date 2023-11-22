@extends('dashboard.layouts.main')


@section('container')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-users" style="margin-right: 10px"></i>Daftar Pegawai</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li class="active">Pegawai</li>
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

            @if(session('success'))
              <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @elseif(session('updated'))
              <div class="sufee-alert alert with-close alert-info alert-dismissible fade show">
                {{ session('updated') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

              <div class="card-header d-flex justify-content-between align-items-center"">
                  <strong class="card-title mb-0">PEGAWAI TERDAFTAR</strong>
                  <a href="/pegawai/create"><button class="btn btn-success ml-auto"><i class="fa fa-plus" style="margin-right: 10px"></i>Tambah</button></a>
              </div>
              <div class="card-body">
                <table id="tabel" class="table table-striped datatable">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Nama Lengkap</th>
                      <th scope="col">Status</th>
                      <th scope="col">NIP</th>
                      <th scope="col">Pangkat</th>
                      <th scope="col">Jabatan</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data_pegawai as $index => $pegawai)
                      <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pegawai->nama_pegawai }}</td>
                        <td>
                          @if($pegawai->is_admin == 1)
                            <span class="badge badge-success">Admin</span>
                          @elseif($pegawai->is_admin == 0)
                            <span class="badge badge-info">Pegawai</span>
                          @endif
                        </td>
                        <td>{{ $pegawai->nip }}</td>
                        <td>{{ $pegawai->pangkat }}</td>
                        <td>{{ $pegawai->jabatan }}</td>
                        <td>
                          <a href="/editpegawai/{{ $pegawai->nip }}/edit" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="menu-icon fa fa-pencil"></i></a>
                          <a href="" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Delete"><i class="menu-icon fa fa-trash-o"></i></a>
                        </td>
                      </tr>
                    @endforeach                   
                  </tbody>
                </table>
              </div>
              
          </div>
      </div>
    </div>
  </div>
</div> 



@endsection