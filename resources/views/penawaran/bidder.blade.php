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
                        <li><a href="/penawaran/{{ $jadwal->id }}">Penawaran</a></li>
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
      @if(session('message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
          {{ session('message') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <strong class="card-title mb-0">Penawaran pada {{ $barang->nama_barang }}</strong>
        </div>
        <div class="card-body">
          <div class="row">
            @if($penawarTertinggi)
              <div class="col-md-4">
                @if($penawarTertinggi->status == 'menang')
                  <h3 style="font-weight: bold; margin-bottom:10px">Pemenang Lelang</h3>
                  <h5>Nama Pembeli:</h5>
                  <p>{{ $penawarTertinggi->pembeli->nama_pembeli }}</p>
                  <h5>Harga Penawaran:</h5>
                  <p>Rp. {{ number_format($penawarTertinggi->harga_bid, 0, ',', '.') }}</p>
                  <h5>Tanggal Penawaran:</h5>
                  <p>{{ \Carbon\Carbon::parse($penawarTertinggi->created_at)->format('d M Y \J\a\m\ H:i') }} WITA</p>

                  @if($transaksi)
                    @if($transaksi->status != 'verified')
                      <h5>Batas Waktu Pembayaran:</h5>
                      <p><strong id="countdown" class="text-danger"></strong></p>
                      <p id="end_date" dataEndDate="{{ $countdownWinner }}"></p>
                      <div id="end_event" style="display: none">
                          <p class="text-danger">Kadaluarsa</p>
                      </div>

                      <div class="d-flex">
                        <form action="/penawaran/{{ $penawarTertinggi->id }}" method="post">
                          @csrf
                          @method('PUT')
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#wanprestasi{{ $penawarTertinggi->id }}"><i class="fa fa-times-circle"></i>&nbsp;Wanprestasi</button>

                          <!-- The Modal -->
                          <div class="modal" id="wanprestasi{{ $penawarTertinggi->id }}">
                            <div class="modal-dialog modal-dialog-centered mt-2">
                              <div class="modal-content">
        
                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Konfirmasi Penawaran</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                  <p>Apakah anda yakin pemenang lelang wanprestasi?</p>
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
                        &nbsp;&nbsp;
                        <div id="hide_whatsapp">
                          <a href="https://wa.me/62{{ $penawarTertinggi->pembeli->no_telepon }}?text=Selamat!%0A%0AAnda%20berhasil%20memenangkan%20lelang%20pada%20website%20Sistem%20Informasi%20Penjualan%20Langsung%20Barang%20Rampasan%20Negara%20Kejaksaan%20Negeri%20Denpasar%20dengan%20item%20barang%3A%20%0A%0A{{ $penawarTertinggi->barang_rampasan->nama_barang }}%0A%0ASegera%20lakukan%20pembayaran%20dengan%20klik%20link%20berikut%20https%3A%2F%2Fsipbaran.com%2F%0AKami%20tunggu%20dalam%201x24%20jam.%20Jika%20tidak%20melakukan%20pembayaran%2C%20maka%20kami%20anggap%20Anda%20Wanprestasi.%0A%0ATerima%20kasih" class="btn btn-success" data-toggle="tooltip" data-original-title="Chat Pembeli"><i class="menu-icon fa fa-whatsapp"></i>&nbsp;Hubungi</a>
                        </div>
                      </div>
                    @endif
                  @else
                    <h5>Batas Waktu Pembayaran:</h5>
                    <p><strong id="countdown" class="text-danger"></strong></p>
                    <p id="end_date" dataEndDate="{{ $countdownWinner }}"></p>
                    <div id="end_event" style="display: none">
                        <p class="text-danger">Kadaluarsa</p>
                    </div>

                    <div class="d-flex">
                      <form action="/penawaran/{{ $penawarTertinggi->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#wanprestasi{{ $penawarTertinggi->id }}"><i class="fa fa-times-circle"></i>&nbsp;Wanprestasi</button>

                        <!-- The Modal -->
                        <div class="modal" id="wanprestasi{{ $penawarTertinggi->id }}">
                          <div class="modal-dialog modal-dialog-centered mt-2">
                            <div class="modal-content">
      
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Konfirmasi Penawaran</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>

                              <!-- Modal Body -->
                              <div class="modal-body">
                                <p>Apakah anda yakin pemenang lelang wanprestasi?</p>
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
                      &nbsp;&nbsp;
                      <div id="hide_whatsapp">
                        <a href="https://wa.me/62{{ $penawarTertinggi->pembeli->no_telepon }}?text=Selamat!%0A%0AAnda%20berhasil%20memenangkan%20lelang%20pada%20website%20Sistem%20Informasi%20Penjualan%20Langsung%20Barang%20Rampasan%20Negara%20Kejaksaan%20Negeri%20Denpasar%20dengan%20item%20barang%3A%20%0A%0A{{ $penawarTertinggi->barang_rampasan->nama_barang }}%0A%0ASegera%20lakukan%20pembayaran%20dengan%20klik%20link%20berikut%20https%3A%2F%2Fsipbaran.com%2F%0AKami%20tunggu%20dalam%201x24%20jam.%20Jika%20tidak%20melakukan%20pembayaran%2C%20maka%20kami%20anggap%20Anda%20Wanprestasi.%0A%0ATerima%20kasih" class="btn btn-success" data-toggle="tooltip" data-original-title="Chat Pembeli"><i class="menu-icon fa fa-whatsapp"></i>&nbsp;Hubungi</a>
                      </div>
                    </div>
                  @endif
                  
                  
                @else
                  <h3 style="font-weight: bold; margin-bottom:10px">Penawar Lelang tertinggi</h3>
                  <h5>Nama Pembeli:</h5>
                  <p>{{ $penawarTertinggi->pembeli->nama_pembeli }}</p>
                  <h5>Harga Penawaran:</h5>
                  <p>Rp. {{ number_format($penawarTertinggi->harga_bid, 0, ',', '.') }}</p>
                  <h5>Tanggal Penawaran:</h5>
                  <p>{{ \Carbon\Carbon::parse($penawarTertinggi->created_at)->format('d M Y \J\a\m\ H:i') }} WITA</p>
                  
                  <form action="/penawaran/{{ $jadwal->id }}/{{ $barang->id }}/{{ $penawarTertinggi->id }}" method="post">
                  @csrf
                  @method('PUT')
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square"></i>&nbsp;Konfirmasi</button>
                  </form>
                @endif
            
              </div>
            @else
              <div class="col-md-4">
                <h3 style="font-weight: bold; margin-bottom:10px">Tidak ada pemenang lelang</h3> 
                <h5>Penawaran yang masuk wanprestasi</h5>
              </div> 
            @endif

            
            <div class="col-md-8">
              <h3 style="font-weight: bold; margin-bottom:10px">Daftar Peserta Lelang</h3>
              <table id="tabel" class="table table-bordered datatable">
                <thead>
                  <tr>
                    <th style="vertical-align: middle;">No.</th>
                    <th style="vertical-align: middle;">Nama Pembeli</th>
                    <th style="vertical-align: middle;">Harga Penawaran</th>
                    <th style="vertical-align: middle;">Tanggal Penawaran</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_penawaran as $index => $penawaran)
                    <tr class="{{ $penawaran->status == 'menang' ? 'table-active' : ($penawaran->status == 'wanprestasi' ? 'table-danger' : '') }}">
                      <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                      <td style="vertical-align: middle;">{{ $penawaran->pembeli->nama_pembeli }}</td>
                      <td style="vertical-align: middle;">Rp. {{ number_format($penawaran->harga_bid, 0, ',', '.') }}</td>
                      <td style="vertical-align: middle;">
                          {{ \Carbon\Carbon::parse($penawaran->created_at)->format('d M Y \J\a\m\ H:i') }} WITA
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          
        </div>
      </div>

      @if($transaksi)
        @if($transaksi->status == 'verified')
          <div class="alert alert-success">
            <i class="fa fa-info-circle" aria-hidden="true"></i> Pembayaran Terkonfirmasi
          </div>
        @endif
      @endif

      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <strong class="card-title mb-0">Pembayaran</strong>
        </div>
        <div class="card-body">
          <h4 style="font-weight: bold; margin-bottom:10px">Pembayaran Pemenang Lelang</h4>
          <table id="tabel" class="table table-bordered datatable">
            <thead>
              <tr>
                <th style="vertical-align: middle;">Nama Pembeli</th>
                <th style="vertical-align: middle;">Total Pembayaran</th>
                <th style="vertical-align: middle;">Status</th>
                <th style="vertical-align: middle;">Waktu Pembayaran</th>
                <th style="vertical-align: middle;">Bukti Pembayaran</th>
                @if($transaksi)
                  @if($transaksi->status != 'verified')
                    <th style="vertical-align: middle;">Aksi</th>
                  @endif
                @endif
              </tr>
            </thead>
            <tbody>
              @if (!isset($transaksi))
                <tr>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                </tr>
              @else
                <tr>
                  <td style="vertical-align: middle;">{{ $transaksi->pembeli->nama_pembeli }}</td>
                  <td style="vertical-align: middle;">Rp. {{ number_format($transaksi->penawaran->harga_bid, 0, ',', '.') }}</td>
                  <td style="vertical-align: middle">
                    @if($transaksi->status == 'review')
                      <span class="badge badge-secondary">Menunggu Konfirmasi</span>
                    @elseif ($transaksi->status == 'data_salah')
                      <span class="badge badge-danger">Transaksi Salah</span>
                    @else 
                      <span class="badge badge-success">Sukses</span>
                    @endif
                  </td>
                  <td style="vertical-align: middle">{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y \J\a\m\ H:i') }}</td>
                  <td><button class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#bukti">Lihat Bukti</button></td>
                  
                  <div class="modal" id="bukti">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Bukti Pembayaran</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <img class="img-fluid" src="{{ $transaksi->foto_bukti }}" alt="Foto Pembeli" style="object-fit: contain; width: 100%; height: 100%;">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  @if($transaksi->status != 'verified')
                    <form action="/pembayaran/verified/{{ $transaksi->id }}" method="post">
                      @csrf
                      @method('PUT')
                      <td class="text-center align-middle"><button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" data-original-title="Konfirmasi"><i class="fa fa-check"></i></button>
                    </form>
                    <form class="d-inline" action="/pembayaran/salah/{{ $transaksi->id }}" method="post">
                      @csrf
                      @method('PUT')
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#data_salah"><i class="menu-icon fa fa-times"></i>
                      </button>
                      <div class="modal" id="data_salah">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Pembayaran Salah</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <p>Apakah anda yakin pembayarannya salah?</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" name="submit" class="btn btn-danger btn-sm">Confirm</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  @endif
                </tr>
              @endif
            </tbody>
          </table>
          @if(isset($transaksi))
            @if($transaksi->status == 'data_salah')
              <a href="https://wa.me/62{{ $penawarTertinggi->pembeli->no_telepon }}?text=Maaf!%0ADengan%20hormat%2C%20kami%20memberitahukan%20bahwa%20pembayaran%20lelang%20untuk%20barang%20dengan%20nama%20{{ $penawarTertinggi->barang_rampasan->nama_barang }}%20belum%20berhasil%20kami%20konfirmasi.%0A%0ASilahkan%20mengunggah%20ulang%20bukti%20transfer%20pembayaran%20lelang%20melalui%20link%20berikut%3A%20https%3A%2F%2Fsipbaran.com%0A%0AKami%20sangat%20mengharapkan%20Anda%20dapat%20segera%20mengunggah%20bukti%20transfer%20pembayaran%20lelang%20guna%20menghindari%20kemungkinan%20dianggap%20sebagai%20wanprestasi.%0A%0ATerima%20kasih%20atas%20perhatian%20dan%20kerjasamanya." class="btn btn-success" data-toggle="tooltip" data-original-title="Chat Pembeli"><i class="menu-icon fa fa-whatsapp"></i>&nbsp;Hubungi</a>
            @elseif($transaksi->status == 'verified')
              <a href="https://wa.me/62{{ $penawarTertinggi->pembeli->no_telepon }}?text=Selamat!%0APembayaran%20lelang%20pada%20{{ $penawarTertinggi->barang_rampasan->nama_barang }}%20sudah%20berhasil%20terkonfirmasi%0A%0ASilahkan%20tunjukkan%20bukti%20pembayaran%20ini%20kepada%20admin%20barang%20bukti%20dan%20barang%20lelang%20dapat%20diambil%20di%20Kantor%20Kejaksaan%20Negeri%20Denpasar.%0A%0ABukti%20pembayaran%20dapat%20diunduh%20pada%20link%20berikut%20ini%3A%20https%3A%2F%2Fsipbaran.com%0A%0ATerima%20kasih!" class="btn btn-success" data-toggle="tooltip" data-original-title="Chat Pembeli"><i class="menu-icon fa fa-whatsapp"></i>&nbsp;Hubungi</a>
            @else
              <button class="btn btn-success btn-md" disabled><i class="menu-icon fa fa-whatsapp"></i>&nbsp;Hubungi</button>
            @endif
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection