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
                @if ($data_barang->foto_thumbnail)
                  <a href="#"><img style="width: 450px; height: 450px;"
                  src="{{ asset($data_barang->foto_thumbnail) }}" alt="{{ $data_barang->nama_barang }}"></a>
                @else
                  <p>Tidak Ada Foto</p>
                @endif
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection