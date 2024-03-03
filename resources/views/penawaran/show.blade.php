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
                          <li><a href="/transaksi">Transaksi</a></li>
                          <li class="active">Penawaran</li>
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
              <strong class="card-title mb-0">Daftar Barang Rampasan Pada Jadwal</strong>
          </div>
          <div class="card-body">
            <table id="tabel" class="table table-striped table-bordered datatable">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Nama Barang</th>
                  <th scope="col">Jumlah Penawaran</th>
                  <th scope="col">Harga Tertinggi</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($daftar_barang as $index => $barang)
                  <tr>
                    <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                    <td style="vertical-align: middle;">{{ $barang->nama_barang }}</td>
                    @if(isset($penawaran[$barang->id]))
                      <td style="vertical-align: middle;">{{ $penawaran[$barang->id]->count() }} Penawaran</td>
                      <td style="vertical-align: middle;">
                        Rp. {{ number_format($penawaran[$barang->id][0]->harga_bid, 0, ',', '.') }}
                      </td>
                      <td class="text-center align-middle">
                        <a href="/penawaran/{{ $jadwal->no_sprint }}/showbidder/{{ $barang->id }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-original-title="Cek Tawaran"><i class="menu-icon fa fa-eye"></i></a>
                      </td>
                    @else
                      <td style="vertical-align: middle;">-</td>
                      <td style="vertical-align: middle;">-</td>
                      <td class="text-center align-middle">-</td>
                    @endif
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