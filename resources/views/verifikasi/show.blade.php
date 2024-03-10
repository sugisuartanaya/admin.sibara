@extends('dashboard.layouts.main')


@section('container')
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                    <h1><i class="menu-icon fa fa-users" style="margin-right: 10px"></i>Verifikasi Akun Pembeli</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="/dashboard">Dashboard</a></li>
                          <li><a href="/pembeli">Pembeli</a></li>
                          <li class="active">Detail</li>
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
              {{ session('success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @elseif(session('updated'))
            <div class="sufee-alert alert with-close alert-info alert-dismissible fade show">
              {{ session('updated') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          <div class="card-header d-flex justify-content-between align-items-center"">
            <strong class="card-title mb-0">Informasi Akun Pembeli</strong>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <td >Username</td>
                      <td >: {{ $pembeli->user->username }}</td>
                    </tr>
                    <tr>
                      <td >Email</td>
                      <td >: {{ $pembeli->user->email }}</td>
                    </tr>
                    <tr>
                      <td >Nama</td>
                      <td >: {{ $pembeli->nama_pembeli }}</td>
                    </tr>
                    <tr>
                      <td >Pekerjaan</td>
                      <td >: {{ $pembeli->pekerjaan }}</td>
                    </tr>
                    <tr>
                      <td >No Telepon</td>
                      <td >: +62{{ $pembeli->no_telepon }} 
                        <button class="btn btn-sm btn-success btn-outline-success" data-toggle="modal" data-target="#telepon">
                        <i class="menu-icon fa fa-pencil"></i> </button>
                       
                        {{-- Modal Edit Telepon  --}}
                        <div class="modal fade" id="telepon" tabindex="-1">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Ubah No Telepon</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="/pembeli/verifikasi-notelp/{{ $pembeli->id }}" method="post">
                                  @csrf
                                  @method('PUT')
                                  <label class="form-label">Masukkan No. Telepon yang baru</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">+62</span>
                                    </div>
                                    <input type="number" name="no_telepon" class="form-control" value="{{ $pembeli->no_telepon }}">
                                  </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                      </td>
                    </tr>
                    <tr>
                      <td >Alamat</td>
                      <td >: {{ $pembeli->alamat }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-6">
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <td >Foto KTP</td>
                      <td >Foto Selfie dengan KTP</td>
                    </tr>
                    <tr>
                      <td>
                        <a href="#" data-toggle="modal" data-target="#modalFotoKTP"><img class="d-block" src="{{$pembeli->foto_ktp}}" style="width: 300px; height: 200px"></a>
                      </td>
                      <td>
                        <a href="#" data-toggle="modal" data-target="#modalFotoPembeli"><img class="d-block" src="{{$pembeli->foto_pembeli}}" style="width: 300px; height: 200px"></a>
                      </td>
                    </tr>

                    <!-- Modal Foto KTP -->
                    <div class="modal fade" id="modalFotoKTP" tabindex="-1" role="dialog" aria-labelledby="modalFotoKTPLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="modalFotoKTPLabel">Foto KTP</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <img class="img-fluid" src="{{ $pembeli->foto_ktp }}" alt="Foto KTP" style="object-fit: contain; width: 100%; height: 100%;">
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Modal Foto Pembeli -->
                    <div class="modal fade" id="modalFotoPembeli" tabindex="-1" role="dialog" aria-labelledby="modalFotoPembeliLabel"   aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="modalFotoPembeliLabel">Foto Selfie dengan KTP</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <img class="img-fluid" src="{{ $pembeli->foto_pembeli }}" alt="Foto Pembeli" style="object-fit: contain; width: 100%; height: 100%;">
                          </div>
                        </div>
                      </div>
                    </div>

                  </tbody>
                </table>   
              </div>         
            </div>

          </div>
        </div>

        @if($last_verify->status == "verified")
          <div class="alert alert-success" role="alert">
            <strong class="text-success"><i class="fa fa-check"></i>&nbsp;Akun terverifikasi</strong>
          </div>
        @else
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center"">
              <strong class="card-title mb-0">Verifikasi Akun</strong>
            </div>
            <div class="card-body">
              <h4>Apakah terdapat kesalahan data?</h4>
              <br>
              <button id="kesalahan" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalKesalahan">
                <i class="menu-icon fa fa-times"></i>&nbsp;Ya, terjadi kesalahan data</button>
              <button id="approve" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalApprove">
                <i class="menu-icon fa fa-check-square-o"></i>&nbsp;Tidak, data sudah benar</button>

                <!-- Modal Kesalahan-->
                <div class="modal fade" id="modalKesalahan" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">

                      <div class="modal-header">
                        <h5 class="modal-title" id="modalKesalahanLabel">Form Kesalahan Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                        <form action="/pembeli/verifikasi/{{ $last_verify->id }}" method="post" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
            
                          <input type="text" style="display:none;" id="role" name="status" class="form-control" value="data_salah">
                          <input type="text" style="display:none;" id="role" name="pembeli_id" class="form-control" value="{{ $pembeli->id }}">
            
                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label class=" form-control-label">Jenis Kesalahan Data</label>
                            </div>
                            <div class="col col-md-9">
                              <div class="form-check">
                                <div class="checkbox">
                                  <label for="checkbox1" class="form-check-label ">
                                    <input type="checkbox" id="checkbox1" name="jenis_kesalahan[]" value="nama_pembeli" class="form-check-input">Nama Pembeli (Nama tidak sesuai dengan KTP)
                                  </label>
                                </div>
                                <div class="checkbox">
                                  <label for="checkbox2" class="form-check-label ">
                                    <input type="checkbox" id="checkbox2" name="jenis_kesalahan[]" value="pekerjaan" class="form-check-input"> Pekerjaan (Pekerjaan tidak sesuai dengan KTP)
                                  </label>
                                </div>
                                <div class="checkbox">
                                  <label for="checkbox3" class="form-check-label ">
                                    <input type="checkbox" id="checkbox3" name="jenis_kesalahan[]" value="foto" class="form-check-input"> Foto (Foto tidak jelas atau salah upload)
                                  </label>
                                </div>
                              </div>
                            </div>
            
                            <div class="col col-md-3">
                              <br>
                              <label class=" form-control-label">Deskripsi Kesalahan</label>
                            </div>
                            <div class="col col-md-9">
                              <br>
                              <textarea name="komentar" id="textarea-input" rows="4" placeholder="Kesalahan..." class="form-control @error('komentar') is-invalid @enderror">{{ old('komentar') }}</textarea>
                              @error('komentar')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                              @enderror
                            </div>
                          </div>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan Verifikasi</button>
                      </div>
                    </form>

                    </div>
                  </div>
                </div>

                <!-- Modal Approve-->
                <div class="modal fade" id="modalApprove" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                      <div class="modal-header">
                        <h5 class="modal-title mr-auto" id="modalApprove">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                        <form action="/pembeli/verified/{{ $last_verify->id }}" method="post" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          Apakah anda yakin data sudah benar?
                          <input type="text" style="display:none;" id="role" name="status" class="form-control" value="verified">
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan Verifikasi</button>
                      </div>
                        </form>
                    </div>
                  </div>
                </div>
              
            </div>
            
          </div>
        @endif

        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center"">
            <strong class="card-title mb-0">Riwayat Verifikasi</strong>
            @if ($last_verify->status == "verified") 
              <a href="https://wa.me/62{{ $pembeli->no_telepon }}?text=Pemberitahuan%3A%20Akun%20Anda%20telah%20berhasil%20diverifikasi.%20%0A%0AAnda%20sekarang%20dapat%20masuk%20ke%20dalam%20Sistem%20Informasi%20Penjualan%20Langsung%20Barang%20Rampasan%20Negara%20Kejaksaan%20Negeri%20Denpasar%20menggunakan%20username%20dan%20password%20yang%20telah%20dibuat%20sebelumnya.%0A%0ANikmati%20semua%20fitur%20dan%20layanan%20yang%20tersedia.%20%0A%0ATerima%20kasih.%0A" class="btn btn-success btn-sm" data-toggle="tooltip" data-original-title="Chat Pembeli"><i class="menu-icon fa fa-whatsapp"></i>&nbsp;Info WhatsApp</a>
            @elseif ($last_verify->status == "data_salah")
              <a href="https://wa.me/62{{ $pembeli->no_telepon }}?text=Terdapat%20kesalahan%20dalam%20memasukkan%20data%20ketika%20mendaftar%20akun%20pada%20website%20Penjualan%20Langsung%20Barang%20Rampasan%20Negara%20Kejaksaan%20Negeri%20Denpasar.%0A%0ASilahkan%20klik%20link%20berikut%20untuk%20dapat%20memperbaiki%20data%0Ahttps%3A%2F%2Fsipbaran.com%2Fupdate-data%2F{{ $pembeli->user->username }}%0A%0APesan%20kesalahan%20adalah%3A%20%0A{{ $waKomentar }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-original-title="Chat Pembeli"><i class="menu-icon fa fa-whatsapp"></i>&nbsp;Chat WhatsApp</a>
            @else
              <button class="btn btn-success" disabled>
                <i class="menu-icon fa fa-whatsapp"></i>&nbsp;Chat WhatsApp
              </button>
            @endif
            
          </div>

          <div class="card-body">
            <table id="tabel" class="table table-striped table-bordered datatable">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Jenis Kesalahan</th>
                  <th scope="col">Deskripsi Kesalahan</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($verifikasi as $index => $verif)
                  @if ($verif->status === 'data_salah')
                    <tr>
                      <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                      <td style="vertical-align: middle;">
                        <ul style="padding-left: 20px;">
                          @if(strpos($verif->jenis_kesalahan, "nama_pembeli") !== false)
                            <li>Nama Pembeli tidak sesuai dengan KTP</li>
                          @endif
                  
                          @if(strpos($verif->jenis_kesalahan, "pekerjaan") !== false)
                            <li>Pekerjaan tidak sesuai dengan KTP</li>
                          @endif
                  
                          @if(strpos($verif->jenis_kesalahan, "foto") !== false)
                            <li>Foto tidak terlihat jelas atau salah upload</li>
                          @endif
                        </ul>
                      </td>
                      <td style="vertical-align: middle;">{{ $verif->komentar }}</td>
                    </tr>
                  @endif
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