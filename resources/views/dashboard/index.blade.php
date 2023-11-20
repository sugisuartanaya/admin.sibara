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
            <p>Hi, {{ auth()->user()->pegawai->nama_pegawai }}</p> 
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
            <h5 class="text-center">Jadwal Penjualan Langsung</h5>
            <hr>
            <p>Saat ini tidak ada jadwal</p>
            <button class="btn btn-success">Buat jadwal</button>
            <br><br><br><br>
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
                  <div class="stat-text">Rp<span class="count">2000000</span></div>
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
                  <div class="stat-text"><span class="count">349</span></div>
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
                  <div class="stat-text"><span class="count">3435</span></div>
                  <div class="stat-heading">Barang Rampasan Negara</div>
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
                  <div class="stat-text"><span class="count">2986</span></div>
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
