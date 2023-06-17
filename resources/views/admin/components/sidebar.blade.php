<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{url('/assets/template/img/logoSimasi.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SIMASI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{url('/assets/template/img/user.webp')}}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{auth()->user()->firstname}} {{ auth()->user()->lastname }}</a>
                    </div>
                </div>
                <!-- Dahsboard -->
                <li class="nav-item">
                    <a href="{{url('/dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <!-- Bencana -->
                <li class="nav-item">
                    <a href="{{url('/bencana')}}" class="nav-link">
                        <i class="nav-icon fas fa-fire"></i>
                        <p>
                            Bencana
                        </p>
                    </a>
                </li>
                @role('pusdalop')
                <li class="nav-item">
                    <a href="{{url('/cadang')}}" class="nav-link">
                        <i class="nav-icon fas fa-window-restore"></i>
                        <p>
                            Cadang dan Pulihkan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/laporan')}}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Laporan
                        </p>
                    </a>
                </li>
                @endrole
                <li class="nav-item">
                    <a href="{{url('/member')}}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Admin
                        </p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <form id="form1" action="/logout" method="post">
                        @csrf
                        <a href="javascript:;" onclick="document.getElementById('form1').submit();" class="nav-link">
                            <i class="nav-icon fas fa-power-off"></i>
                            <p>Keluar</p>
                        </a>
                    </form>
                </li> -->


                <!-- <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>
                            Keluar
                        </p>
                    </a> -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>