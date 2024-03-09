<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIPBARAN | {{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{ asset('images/logo2.png') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" />

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chosen.min.css') }}">

</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
      <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="{{ ($title === "Dashboard") ? 'active' : '' }}">
                <a href="/dashboard"><i class="menu-icon fa fa-laptop"></i>Dashboard</a>
            </li>

            @if(Auth::check() && Auth::user()->pegawai->is_admin == 1)
              <li class="{{ ($title === "Pegawai") ? 'active' : '' }}">
                <a href="/pegawai"><i class="menu-icon fa fa-users"></i>Pegawai</a>
              </li>
            @else
            @endif
            
            <li class="{{ ($title === "Pembeli") ? 'active' : '' }}">
              <a href="/pembeli"><i class="menu-icon fa fa-users"></i>Pembeli</a>
            </li>
            <li class="{{ ($title === "Jadwal") ? 'active' : '' }}">
              <a href="/jadwal"><i class="menu-icon fa fa-calendar"></i>Jadwal</a>
            </li>
            <li class="{{ ($title === "Kategori") ? 'active' : '' }}">
              <a href="/kategori"><i class="menu-icon fa fa-tags"></i>Kategori</a>
            </li>
            <li class="{{ ($title === "Barang Rampasan") ? 'active' : '' }}">
              <a href="/barang-rampasan"><i class="menu-icon fa fa-cube"></i>Barang Rampasan</a>
            </li>
            <li class="{{ ($title === "Transaksi") ? 'active' : '' }}">
              <a href="/transaksi"><i class="menu-icon fa fa-shopping-cart"></i>Transaksi</a>
            </li>
            <li class="{{ ($title === "Laporan") ? 'active' : '' }}">
              <a href="/report"><i class="menu-icon fa fa-table"></i>Laporan Penjualan</a>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                  <a class="navbar-brand" href="/dashboard">
                    <strong class=" text-center">SIPBARAN</strong>
                  </a>
                  <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
              <div class="header-menu">
                <div class="header-left">
                  <div class="dropdown for-notification">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="count bg-danger">2</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="notification">
                        <p class="red">You have 2 Notification</p>
                        <a class="dropdown-item media" href="#">
                            <i class="fa fa-check"></i>
                            <p>2 Verifikasi akun</p>
                        </a>
                        <a class="dropdown-item media" href="#">
                            <i class="fa fa-info"></i>
                            <p>2 Verikifasi penawaran</p>
                        </a>
                    </div>
                </div>
                <div class="user-area dropdown float-right">
                  <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle" style="margin-right: 10px" src="{{ asset(auth()->user()->pegawai->foto_pegawai) }}" alt="User Avatar">Hi, {{ auth()->user()->pegawai->nama_pegawai }}
                  </a>
                  <ul class="user-menu dropdown-menu">
                    <li><a class="nav-link" href="/profile"><i class="fa fa-user"></i>My Profile</a></li>
                    <li><a class="nav-link" href="/logout"><i class="fa fa-sign-out"></i>Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>
        </header>
        <!-- /#header -->

        <!-- Content -->
        @yield('container')

           
        <!-- /.content -->
        
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2023 Kejari Denpasar
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by ssuartanaya</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <!-- DatePicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>


    <!-- Your Custom Script -->
    <script src="{{ asset('js/yscountdown.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/chosen.jquery.min.js') }}"></script>


  </body>
</html>