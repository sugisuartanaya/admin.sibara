@extends('dashboard.layouts.main')


@section('container')
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-users" style="margin-right: 10px"></i>Daftar Akun Pembeli</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li class="active">Pembeli</li>
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
                  <strong class="card-title mb-0">Informasi Akun Pembeli</strong>
              </div>
              <div class="card-body">
                <table id="tabel" class="table table-striped table-bordered datatable">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Nama Pembeli</th>
                      <th scope="col">Pekerjaan</th>
                      <th scope="col">No Telepon</th>
                      <th scope="col">Alamat</th>
                      <th scope="col">Status</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($daftarPembeli as $index => $pembeli)
                      <tr>
                        <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                        <td style="vertical-align: middle;">{{ $pembeli->nama_pembeli }}</td>
                        <td style="vertical-align: middle;">{{ $pembeli->pekerjaan }}</td>
                        <td style="vertical-align: middle;">+62{{ $pembeli->no_telepon }}</td>
                        <td style="vertical-align: middle;">{{ $pembeli->alamat }}</td>
                        <td style="vertical-align: middle;">
                          @php
                              $latestVerification = $pembeli->verifikasi()->orderBy('id', 'desc')->first();
                          @endphp

                          @if($latestVerification->status === 'verified')
                            <span class="badge badge-success"> Akun verified</span>
                          @elseif($latestVerification->status === 'data_salah')
                            <span class="badge badge-warning">Data masih salah</span>
                          @elseif($latestVerification->status === 'revisi')
                            <span class="badge badge-info">Data sudah diperbarui</span>
                          @else
                            <span class="badge badge-danger">Belum di verifikasi</span>
                          @endif
                        </td>
                        <td style="vertical-align: middle;">
                          @if($latestVerification->status === 'verified')
                            <a href="/pembeli/verifikasi/{{ $pembeli->id }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-original-title="Lihat Akun"><i class="menu-icon fa fa-eye"></i></a>
                          @else
                            <a href="/pembeli/verifikasi/{{ $pembeli->id }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Verifikasi"><i class="menu-icon fa fa-check-square-o"></i></a>
                          @endif
                            <form class="d-inline" action="/deletepembeli/{{ $pembeli->id }}" method="post">
                              @csrf
                              @method('DELETE')
                              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletepembeli{{ $pembeli->id }}"><i class="menu-icon fa fa-trash-o"></i>
                              </button>

                              <!-- The Modal -->
                                <div class="modal" id="deletepembeli{{ $pembeli->id }}">
                                  <div class="modal-dialog">
                                      <div class="modal-content">

                                          <!-- Modal Header -->
                                          <div class="modal-header">
                                              <h4 class="modal-title">Hapus pembeli</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>

                                          <!-- Modal Body -->
                                          <div class="modal-body">
                                              <p>Apakah anda yakin akan menghapus akun {{ $pembeli->nama_pembeli }}?</p>
                                          </div>

                                          <!-- Modal Footer -->
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <button type="submit" name="submit" class="btn btn-danger btn-sm">Confirm
                                              </button>
                                          </div>

                                      </div>
                                  </div>
                              </div>

                            </form>
                          {{-- <a href="" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Delete"><i class="menu-icon fa fa-trash-o"></i></a> --}}
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