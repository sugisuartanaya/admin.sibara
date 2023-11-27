@extends('dashboard.layouts.main')


@section('container')
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-tags" style="margin-right: 10px"></i>Daftar Kategori</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li class="active"><a href="/kategori"></a>Kategori</li>
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
                  <strong class="card-title mb-0">List Kategori</strong>
                  <a href="/kategori/create"><button class="btn btn-success ml-auto"><i class="fa fa-plus" style="margin-right: 10px"></i>Tambah</button></a>
              </div>
              <div class="card-body">
                <table id="tabel" class="table table-striped table-bordered datatable">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Nama Kategori</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data_kategori as $index => $kategori)
                      <tr>
                        <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                        <td style="vertical-align: middle;">{{ $kategori->nama_kategori }}</td>
                        
                        <td style="vertical-align: middle;">
                          <a href="/kategori/{{ $kategori->nama_kategori }}/edit" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="menu-icon fa fa-pencil"></i></a>
                          <form class="d-inline" action="/kategori/{{ $kategori->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteKategori{{ $kategori->id }}"><i class="menu-icon fa fa-trash-o"></i>
                            </button>

                            <!-- The Modal -->
                              <div class="modal" id="deleteKategori{{ $kategori->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Hapus Kategori</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="modal-body">
                                            <p>Apakah anda yakin akan menghapus {{ $kategori->nama_kategori }}?</p>
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