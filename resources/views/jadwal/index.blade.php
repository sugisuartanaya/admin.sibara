@extends('dashboard.layouts.main')


@section('container')
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-calendar" style="margin-right: 10px"></i>Daftar Jadwal Penjualan Langsung</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li class="active"><a href="/jadwal"></a>Jadwal</li>
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
                  <strong class="card-title mb-0">List Jadwal</strong>
                  @if($filter->isEmpty())
                    <a href="/jadwal/create">
                      <button class="btn btn-success ml-auto">
                        <i class="fa fa-plus" style="margin-right: 10px"></i>Tambah
                      </button>
                    </a>
                  @endif
                 
              </div>
              <div class="card-body">
                <table id="tabel" class="table table-striped table-bordered datatable">
                  <thead>
                    <tr>
                      <th style="vertical-align: middle;">No.</th>
                      <th style="vertical-align: middle;">No Surat Perintah</th>
                      <th style="vertical-align: middle;">Tgl Surat Perintah</th>
                      <th style="vertical-align: middle;">Tanggal Dimulai</th>
                      <th style="vertical-align: middle;">Tanggal Berakhir</th>
                      <th style="vertical-align: middle;">Waktu</th>
                      <th style="vertical-align: middle;">Tipe Penawaran</th>
                      <th style="vertical-align: middle;">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data_jadwal as $index => $jadwal)
                      <tr>
                        <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                        <td style="vertical-align: middle; ">{{ $jadwal->no_sprint }}</td>
                        <td style="vertical-align: middle;">{{ \Carbon\Carbon::parse($jadwal->tgl_sprint)->translatedFormat('j F Y') }}</td>
                        <td style="vertical-align: middle; width: 10%;">
                          {{ \Carbon\Carbon::parse($jadwal->start_date)->translatedFormat('j F Y') }}
                        </td>
                        <td style="vertical-align: middle; width: 10%;">
                          {{ \Carbon\Carbon::parse($jadwal->end_date)->translatedFormat('j F Y') }}  
                        </td>
                        <td style="vertical-align: middle; width: 10%;">
                          {{ $jadwal->start_date->format('H:i') }} - {{ $jadwal->end_date->format('H:i') }} WITA
                        </td>
                        @if ($jadwal->type == 'open')
                          <td style="vertical-align: middle; width: 10%;">Open Bidding</td>
                        @else
                          <td style="vertical-align: middle; width: 10%;">Closed Bidding</td>
                        @endif
                        
                        <td style="vertical-align: middle;">
                          <a href="/jadwal/{{ $jadwal->id }}/edit" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="menu-icon fa fa-pencil"></i></a>
                          <a href="{{ 'jadwal/detail/'.$jadwal->id }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-original-title="Show"><i class="menu-icon fa fa-eye"></i></a>
                          <form class="d-inline" action="/jadwal/{{ $jadwal->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletejadwal{{ $jadwal->id }}"><i class="menu-icon fa fa-trash-o"></i>
                            </button>

                            <!-- The Modal -->
                              <div class="modal" id="deletejadwal{{ $jadwal->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Hapus jadwal</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="modal-body">
                                            <p>Apakah anda yakin akan menghapus {{ $jadwal->no_sprint }}?</p>
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