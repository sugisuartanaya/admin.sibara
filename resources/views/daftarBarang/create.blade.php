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
                          <li><a href="/daftar-barang/{{ $jadwal->id }}">Detail Jadwal</a></li>
                          <li class="active">Tambah Barang</li>
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
              {{ session('error') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          
          <div class="card-header">
            <strong>Tambah Barang Rampasan</strong>
          </div>
          <div class="card-body card-block">
            <form action="/jadwal/detail/create" method="post" enctype="multipart/form-data">
            @csrf

              <input type="hidden" name="id_jadwal" value={{ $jadwal->id }}>

              <div class="form-group">
                <label for="no_putusan" class=" form-control-label">Barang Rampasan Negara</label>
                <select name="id_barang[]" data-placeholder="Pilih barang" multiple class="standardSelect" tabindex="2" class="form-control @error('id_barang') is-invalid @enderror">
                  <option value="0" label="default"></option>

                  {{-- membuat kondisi label kategori --}}
                  @php $kategori_awal = null @endphp
                  @php $kategori_label = [] @endphp

                  @foreach ($data_barang as $barang)
                    @if (!in_array($barang->kategori->nama_kategori, $kategori_label))
                      @php
                        $kategori_label[] = $barang->kategori->nama_kategori;
                        $kategori_awal = $barang->kategori->nama_kategori;
                      @endphp
                      <optgroup label="{{ $kategori_awal }}">
                        @foreach ($data_barang as $barang_inner)
                          @if ($barang_inner->kategori->nama_kategori === $kategori_awal)
                            <option value="{{ $barang_inner->id }}">{{ $barang_inner->nama_barang }} | No. Putusan {{ $barang_inner->no_putusan }}</option>
                          @endif
                        @endforeach
                      </optgroup>
                    @endif
                  @endforeach
                </select>

                @error('id_barang')
                  <div class="invalid-feedback" role="alert">
                    {{ $message }}
                  </div>
                @enderror

              </div>

              <button class="btn btn-success" type="submit">Proses</button>
                                
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection