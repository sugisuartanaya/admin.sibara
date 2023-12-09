@extends('dashboard.layouts.main')


@section('container')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-cube" style="margin-right: 10px"></i>Detail Barang Rampasan</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li><a href="/barang-rampasan">Barang Rampasan</a></li>
                          <li class="active">Item</li>
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
          <div class="card-header">
            <strong>Edit Barang Rampasan</strong>
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
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection