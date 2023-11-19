@extends('dashboard.layouts.main')


@section('container')

<div class="row">
  <div class="col-lg-3 col-md-6">
    <div class="card">
      <div class="card-body">
        <div class="stat-widget-five">
          <div class="stat-icon dib flat-color-1">
            <i class="pe-7s-cash"></i>
          </div>
          <div class="stat-content">
            <div class="text-left dib">
              <div class="stat-text">Rp<span class="count">2.000.000</span></div>
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

@endsection
