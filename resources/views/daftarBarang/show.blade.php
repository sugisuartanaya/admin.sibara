@extends('dashboard.layouts.main')

@section('container')
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-calendar" style="margin-right: 10px"></i>Jadwal Penjualan Langsung</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li><a href="/jadwal">Jadwal</a></li>
                          <li class="active">Detail Jadwal</li>
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
          @endif
          <div class="card-header">
            <strong>Informasi Jadwal Penjualan Langsung</strong>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-5">
                <table class="table table-borderless table-sm table-compact">
                  <tbody>
                    <tr>
                      <td scope="col">Surat Perintah Penjualan langsung: </td>
                      <td scope="col">{{ $jadwal->no_sprint }}</td>
                    </tr>
                    <tr>
                      <td scope="col">Tgl. Surat Perintah Penjualan langsung: </td>
                      <td scope="col">{{ $jadwal->tgl_sprint->format('j F Y') }}</td>
                    </tr>
                    <tr>
                      <td scope="col">Tipe Penawaran: </td>
                      @if ($jadwal->type == 'open')
                        <td scope="col">Open Bidding</td>
                      @else
                        <td scope="col">Closed Bidding</td>
                      @endif
                    </tr>
                    <tr><td>
                      <strong>Dilaksanakan pada</strong>
                    </td></tr>
                    <tr>
                      <td scope="col">Tgl Dimulai: </td>
                      <td scope="col">{{ $jadwal->start_date->format('j F Y') }}</td>
                    </tr>
                    <tr>
                      <td scope="col">Tgl Berakhir: </td>
                      <td scope="col">{{ $jadwal->end_date->format('j F Y') }}</td>
                    </tr>
                    <tr>
                      <td scope="col">Waktu: </td>
                      <td scope="col">{{ $jadwal->start_date->format('H:i') }} - {{ $jadwal->end_date->format('H:i') }}</td>
                    </tr>
                </table>
                <br>
              </div>
              <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                  @if(!$filter)
                    <strong>Daftar Barang yang akan Dijual</strong>
                    <a href="/jadwal/detail/create/{{ $jadwal->id }}"><button class="btn btn-success btn-sm ml-auto"><i class="fa fa-plus" style="margin-right: 10px"></i>Tambah Barang</button></a>
                  @else
                    <strong>Daftar Barang pada penjualan langsung</strong>
                  @endif
                  
                </div>
                <br>
                <table id="tabel" class="table table-striped table-bordered datatable">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Nama Barang</th>
                      <th scope="col">Kategori</th>
                      <th scope="col">Izin Penjualan</th>
                      <th scope="col">Harga</th>
                      @if(!$filter)
                        <th scope="col">Aksi</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($daftar as $index => $barang)
                      <tr>
                        <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                        <td style="vertical-align: middle;">
                          @if($barang->status === 2)
                            <span class="badge badge-success">Terjual</span>{{ $barang->barang_rampasan->nama_barang }}
                          @else 
                            {{ $barang->barang_rampasan->nama_barang }}
                          @endif
                        </td>
                        <td style="vertical-align: middle;">{{ $barang->barang_rampasan->kategori->nama_kategori }}</td>
                        <td style="vertical-align: middle;">
                          @if ($barang->barang_rampasan->izin)
                            {{ $barang->barang_rampasan->izin->no_sk }}
                          @else
                            -
                          @endif
                        </td>
                        <td style="vertical-align: middle;">
                          @if ($barang->barang_rampasan->harga_wajar->isNotEmpty())
                            Rp. {{ number_format($barang->barang_rampasan->harga_wajar->last()->harga, 0, ',', '.') }}
                          @else
                            -
                          @endif
                        </td>
                        @if (!$filter)
                          <td style="vertical-align: middle; text-align: center;">
                            <form class="d-inline" action="/daftar-barang/{{ $barang->id }}" method="post">
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
                                              <h4 class="modal-title">Hapus barang</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>

                                          <!-- Modal Body -->
                                          <div class="modal-body">
                                              <p>Apakah anda yakin akan menghapus {{ $barang->barang_rampasan->nama_barang }}?</p>
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
                        @endif
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="col-md-4">
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection