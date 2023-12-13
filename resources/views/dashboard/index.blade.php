@extends('dashboard.layouts.main')


@section('container')


<div class="content">
  <div class="animated fadeIn">
    <div class="row">

      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <img src="images/dashboard.jpg" alt="login">
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-body">
            <strong>Hi, {{ auth()->user()->pegawai->nama_pegawai }}</strong> 
            <hr>
            <p>Kejaksaan Negeri Denpasar</p>
            <hr>
            <p>{{ auth()->user()->pegawai->jabatan }}</p>
            <hr>
            <p>{{ auth()->user()->pegawai->pangkat }}</p>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-body">
            <strong class="text-center">Pelaksanaan Penjualan Langsung</strong>
            <hr>
            @if($jadwal->count() > 0)
              <table class="table table-borderless table-sm table-compact">
                <tbody>
                  {{-- @foreach($jadwal as $index => $jadwal_penjualan) --}}
                    <tr>
                      <td scope="col">Hari : </td>
                      <td scope="col">{{ $jadwal->start_date->format('l') }} - {{ $jadwal->end_date->format('l') }}</td>
                    </tr>
                    <tr>
                      <td scope="col">Tanggal : </td>
                      <td scope="col">{{ $jadwal->start_date->format('j F Y') }} - {{ $jadwal->end_date->format('j F Y') }}</td>
                    </tr>
                    <tr>
                      <td scope="col">Waktu Pelaksanaan : </td>
                      <td scope="col">{{ $jadwal->start_date->format('H:i') }} - {{ $jadwal->end_date->format('H:i') }} WITA</td>
                    </tr>
                    <tr>
                      <td scope="col">Tempat : </td>
                      <td scope="col">Kejaksaan Negeri Denpasar</td>
                    </tr>
                  {{-- @endforeach --}}
                </tbody>
              </table>
            @else
              <p>Saat ini tidak ada jadwal</p>
              <a href="/jadwal/create">
                <button class="btn btn-success">
                  <i class="fa fa-plus" style="margin-right: 10px"></i>Buat jadwal
                </button>
              </a>
            @endif
            <br><br>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="stat-widget-five">
              <div class="stat-icon dib flat-color-1">
                <i class="pe-7s-cash"></i>
              </div>
              <div class="stat-content">
                <div class="text-left dib">
                  <div class="stat-text"><span class="count">-</span></div>
                  <div class="stat-heading">Pendapatan Kas Negara</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="stat-widget-five">
              <div class="stat-icon dib flat-color-3">
                <i class="pe-7s-cart"></i>
              </div>
              <div class="stat-content">
                <div class="text-left dib">
                  <div class="stat-text"><span class="count">-</span></div>
                  <div class="stat-heading">Terjual</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="stat-widget-five">
              <div class="stat-icon dib flat-color-2">
                <i class="pe-7s-box2"></i>
              </div>
              <div class="stat-content">
                <div class="text-left dib">
                  <div class="stat-text">
                    @if($barang && !$barang->isEmpty())
                      <span class="count">{{ $barang->count() }}</span>
                    @endif
                  </div>
                  <div class="stat-heading">Barang Rampasan</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="stat-widget-five">
              <div class="stat-icon dib flat-color-4">
                <i class="pe-7s-users"></i>
              </div>
              <div class="stat-content">
                <div class="text-left dib">
                  <div class="stat-text"><span class="count">-</span></div>
                  <div class="stat-heading">Pembeli</div>
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
