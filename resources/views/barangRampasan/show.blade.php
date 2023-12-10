@extends('dashboard.layouts.main')


@section('container')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-cube" style="margin-right: 10px"></i>Barang Rampasan Negara</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li><a href="/barang-rampasan">Barang Rampasan</a></li>
                          <li class="active">Product Detail</li>
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
            <strong>Product Detail</strong>
            {{-- <a href="/barang-rampasan/{{ $data_barang->nama_barang }}/edit"><button class="btn btn-success ml-auto"><i class="fa fa-pencil" style="margin-right: 10px"></i>Edit</button></a> --}}
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div id="produkCarousel" class="carousel slide" data-ride="carousel">
                  <div class="magnifying-glass"></div>
                  <div class="carousel-inner">
                      @foreach($foto_barang as $index => $foto)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img class="d-block w-100" src="{{ asset($foto) }}" alt="Foto {{ $index + 1 }}">
                        </div>
                      @endforeach
                  </div>
                  {{-- <a class="carousel-control-prev" href="#produkCarousel" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#produkCarousel" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                  </a> --}}
                </div>
                <div class="image-preview" id="thumbnailCarousel">
                  @foreach ($foto_barang as $index => $foto)
                    <img src="{{ asset($foto) }}" class="thumbnail" data-target="#produkCarousel" data-slide-to="{{ $index }}" alt="Thumbnail {{ $index + 1 }}">
                  @endforeach
                </div>
                <br><br>
              </div>

              <div class="col-md-6">
                <h3>{{ $data_barang->nama_barang}}</h3>
                @if ($data_barang->harga_wajar->count() > 0 )
                  @if ($expired)
                    <h3 style="text-decoration: line-through;">
                      Rp. {{ number_format($data_barang->harga_wajar->last()->harga, 0, ',', '.') }}
                    </h3>
                    <p>Harga Expired, tambahkan harga wajar terbaru</p>
                  @else
                    <h3>Rp. {{ number_format($data_barang->harga_wajar->last()->harga, 0, ',', '.') }}</h3>
                  @endif
                @else
                  <h4>Belum ada penilaian harga wajar</h4>
                @endif
                <span class="badge badge-success">{{ $data_barang->kategori->nama_kategori }}</span>
                <hr>
                <h4>Deskripsi</h4>
                <p>{{ $data_barang->deskripsi }}</p>
                <hr>
                <strong>Informasi Umum Barang Rampasan Negara</strong>
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <td >Nama Terdakwa: </td>
                      <td >{{ $data_barang->nama_terdakwa }}</td>
                    </tr>
                    <tr>
                      <td scope="col">No Putusan Pengadilan: </td>
                      <td scope="col">{{ $data_barang->no_putusan }}</td>
                    </tr>
                    <tr>
                      <td scope="col">Tgl Putusan Pengadilan: </td>
                      <td scope="col">{{ $data_barang->tgl_putusan }}</td>
                    </tr>
                    @if ($data_barang->izin)
                      <tr>
                        <td scope="col">Izin Penjualan: </td>
                        <td scope="col">{{ $data_barang->izin->no_sk }}</td>
                      </tr>           
                      <tr>
                        <td scope="col">Tgl Izin Penjualan: </td>
                        <td scope="col">{{ $data_barang->izin->tgl_sk }}</td>
                      </tr> 
                    @else
                      <tr>
                        <td scope="col">Izin Penjualan: </td>
                        <td scope="col">
                          <span class="badge badge-warning">Belum memiliki izin</span>
                        </td>
                      </tr> 
                    @endif
                  </tbody>
                </table>
              </div>

              <div class="col-12">
                <div class="custom-tab">

                  <nav>
                      <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <a class="nav-item nav-link active" id="custom-nav-harga-tab" data-toggle="tab" href="#custom-nav-harga" role="tab" aria-controls="custom-nav-harga" aria-selected="true">Riwayat Harga</a>
                          <a class="nav-item nav-link" id="custom-nav-izin-tab" data-toggle="tab" href="#custom-nav-izin" role="tab" aria-controls="custom-nav-izin" aria-selected="false">Izin Penjualan</a>
                      </div>
                  </nav>
                  <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                      <div class="tab-pane fade show active" id="custom-nav-harga" role="tabpanel" aria-labelledby="custom-nav-harga-tab">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th scope="col">No. </th>
                              <th scope="col">Harga Wajar</th>
                              <th scope="col">No. Laporan Penilaian</th>
                              <th scope="col">Tgl. Laporan Penilaian</th>
                              <th scope="col">Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if ($data_barang->harga_wajar->count() > 0)
                              @foreach ($data_barang->harga_wajar as $index => $harga)
                              <tr>
                                <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                                <td style="vertical-align: middle;">Rp. {{ number_format($harga->harga, 0, ',', '.') }}</td>
                                <td style="vertical-align: middle;">{{ $harga->no_laporan_penilaian }}</td>
                                <td style="vertical-align: middle;">{{ $harga->tgl_laporan_penilaian }}</td>
                                <td style="vertical-align: middle;">
                                  <a href="/harga-wajar/create/{{ $data_barang->id }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-original-title="Tambah"><i class="menu-icon fa fa-plus"></i></a>
                                  <a href="/harga-wajar/{{ $harga->no_laporan_penilaian }}/edit" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="menu-icon fa fa-pencil"></i></a>
                                  <form class="d-inline" action="/deleteHarga/{{ $harga->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteHarga{{ $harga->no_laporan_penilaian }}"><i class="menu-icon fa fa-trash-o"></i>
                                    </button>
        
                                    <!-- The Modal -->
                                      <div class="modal" id="deleteHarga{{ $harga->no_laporan_penilaian }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
        
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Hapus Harga Wajar</h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
        
                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                  <p>Apakah anda yakin akan menghapus {{ $harga->no_laporan_penilaian }}?</p>
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

                            @else
                              <tr>
                                <td style="vertical-align: middle;">-</td>
                                <td style="vertical-align: middle;">-</td>
                                <td style="vertical-align: middle;">-</td>
                                <td style="vertical-align: middle;">-</td>
                                <td style="vertical-align: middle;"><a href="/harga-wajar/create/{{ $data_barang->id }}"><button class="btn btn-success ml-auto"><i class="fa fa-plus" style="margin-right: 10px"></i>Tambah Penilaian</button></a></td>
                              </tr>
                            @endif

                          </tbody>
                        </table>
                      </div>
                      <div class="tab-pane fade" id="custom-nav-izin" role="tabpanel" aria-labelledby="custom-nav-izin-tab">

                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th scope="col">No. Surat Keterangan Izin Penjualan</th>
                              <th scope="col">Tgl Surat Keterangan Izin Penjualan</th>
                              <th scope="col">Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              @if ($data_barang->izin)
                                <td style="vertical-align: middle;">{{ $data_barang->izin->no_sk }}</td>
                                <td style="vertical-align: middle;">{{ $data_barang->izin->tgl_sk }}</td>
                                <td style="vertical-align: middle;">
                                  <a href="/izin/{{ $data_barang->izin->no_sk }}/edit" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="menu-icon fa fa-pencil"></i></a>
                                  <form class="d-inline" action="/deleteIzin/{{ $data_barang->izin->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteBarang{{ $data_barang->izin->no_sk }}"><i class="menu-icon fa fa-trash-o"></i>
                                    </button>
        
                                    <!-- The Modal -->
                                      <div class="modal" id="deleteBarang{{ $data_barang->izin->no_sk }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
        
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Hapus Izin Penjualan</h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
        
                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                  <p>Apakah anda yakin akan menghapus {{ $data_barang->izin->no_sk }}?</p>
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
                              @else
                                <td style="vertical-align: middle;">Belum memiliki izin</td>
                                <td style="vertical-align: middle;">Belum memiliki izin</td>
                                <td><a href="/izin/create/{{ $data_barang->id }}"><button class="btn btn-success ml-auto"><i class="fa fa-plus" style="margin-right: 10px"></i>Tambah Izin</button></a></td>
                              @endif
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection