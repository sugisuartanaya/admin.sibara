<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIBARA | {{ $title }}</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

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
            <li class="{{ ($title === "Pegawai") ? 'active' : '' }}">
              <a href="/pegawai"><i class="menu-icon fa fa-users"></i>Pegawai</a>
            </li>
            <li class="menu-item-has-children dropdown {{ ($title === "Pembeli") ? 'active' : '' }}">
              <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fa fa-users"></i>Pembeli</a>
              <ul class="sub-menu children dropdown-menu">
                <li><i class="menu-icon fa fa-address-card"></i><a href="forms-basic.html">Verifikasi Akun</a></li>
                <li><i class="menu-icon fa fa-th"></i><a href="forms-basic.html">Daftar Pembeli</a></li>
              </ul>
            </li>
            <li {{ ($title === "Jadwal") ? 'active' : '' }}>
              <a href=""><i class="menu-icon fa fa-calendar"></i>Jadwal</a>
            </li>
            <li {{ ($title === "Kategori") ? 'active' : '' }}>
              <a href=""><i class="menu-icon fa fa-tags"></i>Kategori</a>
            </li>
            <li {{ ($title === "Barang Rampasan") ? 'active' : '' }}>
              <a href=""><i class="menu-icon fa fa-cube"></i>Barang Rampasan</a>
            </li>
            <li {{ ($title === "Transaksi") ? 'active' : '' }}>
              <a href=""><i class="menu-icon fa fa-shopping-bag"></i>Transaksi</a>
            </li>
            <li {{ ($title === "Laporan Penjualan") ? 'active' : '' }}>
              <a href=""><i class="menu-icon fa fa-table"></i>Laporan Penjualan</a>
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
                    <strong class=" text-center">SIBARA</strong>
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
                    <img class="user-avatar rounded-circle" style="margin-right: 10px" src="{{ asset('images/admin.jpg') }}" alt="User Avatar">Hi, {{ auth()->user()->username }}
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

    <!-- Your Custom Script -->
    <script src="{{ asset('js/main.js') }}"></script>

  </body>
</html>