@extends('dashboard.layouts.main')


@section('container')
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-gavel" style="margin-right: 10px"></i>Detail Penawaran</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li><a href="/penawaran">Penawaran</a></li>
                          <li><a href="/penawaran/{{ $jadwal->id }}">{{ $jadwal->no_sprint }}</a></li>
                          <li class="active">Detail Penawaran</li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <strong class="card-title mb-0">Penawaran pada {{ $barang->nama_barang }}</strong>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <h3 style="font-weight: bold; margin-bottom:10px">Pemenang Lelang</h3>
              <h5>Nama Pembeli:</h5>
              <p>{{ $penawarTertinggi->pembeli->nama_pembeli }}</p>
              <h5>Harga Penawaran:</h5>
              <p>Rp. {{ number_format($penawarTertinggi->harga_bid, 0, ',', '.') }}</p>
              <h5>Tanggal Penawaran:</h5>
              <p>{{ \Carbon\Carbon::parse($penawarTertinggi->tanggal)->format('d M Y \J\a\m\ H:i') }} WITA</p>
              <br>
              <button class="btn btn-success"><i class="fa fa-check-square"></i>&nbsp;Konfirmasi</button>
              <button class="btn btn-danger"><i class="fa fa-times-circle"></i>&nbsp;Wanprestasi</button>
            </div>
            
            <div class="col-md-8">
              <h3 style="font-weight: bold; margin-bottom:10px">Daftar Peserta Lelang</h3>
              <table id="tabel" class="table table-bordered datatable">
                <thead>
                  <tr>
                    <th style="vertical-align: middle;">No.</th>
                    <th style="vertical-align: middle;">Nama Pembeli</th>
                    <th style="vertical-align: middle;">Harga Penawaran</th>
                    <th style="vertical-align: middle;">Tanggal Penawaran</th>
                    {{-- <th scope="col">Aksi</th> --}}
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_penawaran as $index => $penawaran)
                    <tr class="{{ $loop->first ? 'table-active' : '' }}">
                      <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                      <td style="vertical-align: middle;">{{ $penawaran->pembeli->nama_pembeli }}</td>
                      <td style="vertical-align: middle;">Rp. {{ number_format($penawaran->harga_bid, 0, ',', '.') }}</td>
                      <td style="vertical-align: middle;">
                        {{ \Carbon\Carbon::parse($penawaran->tanggal)->format('d M Y \J\a\m\ H:i') }} WITA
                      </td>
                      {{-- <td class="text-center align-middle">
                        @if($loop->first)
                          <a href="/penawaran/{{ $jadwal->id }}" class="btn btn-success btn-sm">
                            <i class="menu-icon fa fa-whatsapp"></i>&nbsp;Chat Pembeli</a>
                        @endif
                      </td> --}}
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
</div>
@endsection