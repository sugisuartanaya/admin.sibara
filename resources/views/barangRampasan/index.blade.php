@extends('dashboard.layouts.main')


@section('container')
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa fa-cube" style="margin-right: 10px"></i>Daftar Barang Rampasan</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li class="active"><a href="/barang-rampasan"></a>Barang Rampasan</li>
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

              <div class="card-header d-flex justify-content-between align-items-center">
                  <strong class="card-title mb-0">List Barang Rampasan Negara</strong>
                  <a href="/barang-rampasan/create"><button class="btn btn-success ml-auto"><i class="fa fa-plus" style="margin-right: 10px"></i>Tambah</button></a>
              </div>
              <div class="card-body">
                <table id="tabel" class="table table-striped table-bordered datatable">
                  <thead>
                    <tr>
                      <th style="vertical-align: middle;">No.</th>
                      <th style="vertical-align: middle;">Thumbnail Barang</th>
                      <th style="vertical-align: middle;">Nama Barang</th>
                      <th style="vertical-align: middle;">Nama Terdakwa</th>
                      <th style="vertical-align: middle;">Kategori</th>
                      <th style="vertical-align: middle;">No Putusan Pengadilan</th>
                      <th style="vertical-align: middle;">Izin Penjualan</th>
                      <th style="vertical-align: middle;">Status</th>
                      <th style="vertical-align: middle;">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data_barang as $index => $barang)
                      <tr>
                        <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                        <td style="vertical-align: middle;">
                          @if ($barang->foto_thumbnail)
                            <a href="#"><img style="width: 200px; height: 150px;"
                            src="{{ asset($barang->foto_thumbnail) }}" alt="{{ $barang->nama_barang }}"></a>
                          @else
                            <p>Tidak Ada Foto</p>
                          @endif  
                        </td>
                        <td style="vertical-align: middle;">{{ $barang->nama_barang }}</td>
                        <td style="vertical-align: middle;">{{ $barang->nama_terdakwa }}</td>
                        <td style="vertical-align: middle;">{{ $barang->kategori->nama_kategori }}</td>
                        <td style="vertical-align: middle;">{{ $barang->no_putusan }}</td>
                        @if ($barang->izin)
                          <td style="vertical-align: middle;">{{ $barang->izin->no_sk }}</td>
                        @else
                          <td style="vertical-align: middle;">Belum Memiliki Izin</td>
                        @endif

                        <td style="vertical-align: middle;">
                          @if ($barang->status == '0')
                            Belum Terjual
                          @else
                            Sudah Terjual
                          @endif
                        </td>
                        <td style="vertical-align: middle;">
                          <a href="/barang-rampasan/{{ $barang->nama_barang }}/edit" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="menu-icon fa fa-pencil"></i></a>
                          <a href="/barang-rampasan/{{ $barang->id }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-original-title="Show"><i class="menu-icon fa fa-eye"></i></a>
                          <form class="d-inline" action="/barang-rampasan/{{ $barang->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteBarang{{ $barang->id }}"><i class="menu-icon fa fa-trash-o"></i>
                            </button>

                            <!-- The Modal -->
                              <div class="modal" id="deleteBarang{{ $barang->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                          <h4 class="modal-title">Hapus Barang Rampasan</h4>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="modal-body">
                                          <p>Apakah anda yakin akan menghapus {{ $barang->nama_barang }}?</p>
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