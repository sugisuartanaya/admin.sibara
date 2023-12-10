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
          <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Product Detail</strong>
            <a href="/barang-rampasan/create"><button class="btn btn-success ml-auto"><i class="fa fa-pencil" style="margin-right: 10px"></i>Edit</button></a>
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
                <br>
              </div>

              <div class="col-md-6">
                <h3>{{ $data_barang->nama_barang }}</h3>
                <h4>Harga Barang: Rp. 2.000.000</h4>
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
                    <tr>
                      <td scope="col">Izin Penjualan: </td>
                      <td scope="col">{{ $data_barang->nama_terdakwa }}</td>
                    </tr>           
                    <tr>
                      <td scope="col">Tgl Izin Penjualan: </td>
                      <td scope="col">{{ $data_barang->nama_terdakwa }}</td>
                    </tr>           
                  </tbody>
                </table>
              </div>

              <div class="col-12">
                {{-- <div class="custom-tab">
                  <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Update Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Update Password</a>
                    </li>
                  </ul>
                </div> --}}
                <div class="custom-tab">

                  <nav>
                      <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <a class="nav-item nav-link active" id="custom-nav-harga-tab" data-toggle="tab" href="#custom-nav-harga" role="tab" aria-controls="custom-nav-harga" aria-selected="true">Riwayat Harga</a>
                          <a class="nav-item nav-link" id="custom-nav-izin-tab" data-toggle="tab" href="#custom-nav-izin" role="tab" aria-controls="custom-nav-izin" aria-selected="false">Izin Penjualan</a>
                      </div>
                  </nav>
                  <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                      <div class="tab-pane fade show active" id="custom-nav-harga" role="tabpanel" aria-labelledby="custom-nav-harga-tab">
                          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias ad aspernatur recusandae aut eaque exercitationem vel, laboriosam asperiores cumque hic, sint dolor earum. Nam aspernatur esse, totam aliquam aperiam quas nisi sapiente, ad voluptatibus consectetur nulla perferendis veritatis error dolores labore praesentium fuga voluptatem. Voluptatum, vel rem sequi veniam placeat sunt repellat doloremque nihil modi facere nisi cum enim nulla.</p>
                      </div>
                      <div class="tab-pane fade" id="custom-nav-izin" role="tabpanel" aria-labelledby="custom-nav-izin-tab">
                          <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, irure terry richardson ex sd. Alip placeat salvia cillum iphone. Seitan alip s cardigan american apparel, butcher voluptate nisi .</p>
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