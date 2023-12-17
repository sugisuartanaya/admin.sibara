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
                          <li class="active">Pembeli</li>
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
                      <td >Nama Pembeli: </td>
                      <td >{{ $pembeli->nama_pembeli }}</td>
                    </tr>
                    <tr>
                      <td >Pekerjaan: </td>
                      <td >{{ $pembeli->pekerjaan }}</td>
                    </tr>
                    <tr>
                      <td >No Telepon: </td>
                      <td >{{ $pembeli->no_telepon }}</td>
                    </tr>
                    <tr>
                      <td >Alamat: </td>
                      <td >{{ $pembeli->alamat }}</td>
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
                        <a href="#" data-toggle="modal" data-target="#modalFotoKTP"><img class="d-block" src="http://sibara.test/{{$pembeli->foto_ktp}}" style="width: 300px; height: 200px"></a>
                      </td>
                      <td>
                        <a href="#" data-toggle="modal" data-target="#modalFotoPembeli"><img class="d-block" src="http://sibara.test/{{$pembeli->foto_pembeli}}" style="width: 300px; height: 200px"></a>
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
                            <img class="img-fluid" src="http://sibara.test/{{ $pembeli->foto_ktp }}" alt="Foto KTP" style="object-fit: contain; width: 100%; height: 100%;">
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
                            <img class="img-fluid" src="http://sibara.test/{{ $pembeli->foto_pembeli }}" alt="Foto Pembeli" style="object-fit: contain; width: 100%; height: 100%;">
                          </div>
                        </div>
                      </div>
                    </div>

                  </tbody>
                </table>   
              </div>
              
              <div class="col-md-6 offset-md-3 d-flex justify-content-center align-items-center mt-4">
                <div class="justify-content-center">
                  <h4 class="text-center"><strong>Apakah terdapat kesalahan data?</strong></h4>
                  <br>
                  <button id="kesalahan" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalKesalahan">
                    <i class="menu-icon fa fa-times"></i>&nbsp;Ya, terjadi kesalahan data</button>
                  <button id="approve" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalApprove">
                    <i class="menu-icon fa fa-check-square-o"></i>&nbsp;Tidak, data sudah benar</button>
                </div>

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

          </div>
        </div>

      </div> 
      
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center"">
            <strong class="card-title mb-0">Riwayat Verifikasi</strong>
          </div>

          <div class="card-body">
            <table id="tabel" class="table table-striped table-bordered datatable">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Jenis Kesalahan</th>
                  <th scope="col">Deskripsi Kesalahan</th>
                  <th scope="col">Aksi</th>
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
                      <td style="vertical-align: middle;">
                        <a href="https://wa.me/62{{ $pembeli->no_telepon }}?text=Terjadi%20kesalahan%20dalam%20input%20data%20pada%20website%20Penjualan%20Langsung%20Barang%20Rampasan%20Negara%20Kejaksaan%20negara.%0A%0ASilahkan%20masuk%20kembali%20ke%20dalam%20website%20dengan%20username%20dan%20password%20yang%20sudah%20dibuat%20sebelumnya%20untuk%20dapat%20memperbaiki%20data.%20%0A%0APesan%20kesalahan%20adalah%3A%20%0A{{ $waKomentar }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-original-title="Chat Pembeli"><i class="menu-icon fa fa-whatsapp"></i>&nbsp;Chat WhatsApp</a>
                      </td>
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