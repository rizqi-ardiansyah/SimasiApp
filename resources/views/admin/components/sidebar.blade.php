<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{url('/assets/template/img/logoMangsiBundar.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">MANGSI</span>
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
                        <a href="#" class="d-block">
                            @if(auth('karyawan')->check())
                            {{ auth('karyawan')->user()->firstname }} {{ auth('karyawan')->user()->lastname }}
                            @elseif(auth('web')->check())
                            {{ auth('web')->user()->firstname }} {{ auth('web')->user()->lastname }}
                            @elseif(auth('medis')->check())
                            {{ auth('medis')->user()->firstname }} {{ auth('medis')->user()->lastname }}
                            @elseif(auth('psikolog')->check())
                            {{ auth('psikolog')->user()->firstname }} {{ auth('psikolog')->user()->lastname }}
                            @endif
                        </a>
                    </div>
                </div>
                <!-- Dahsboard -->
                <li class="nav-item">
                    <a href="{{url('/dashboard')}}" class="nav-link {{ request()->is('dashboard') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <!-- Bencana -->
                <li class="nav-item">
                    <a href="{{url('/bencana')}}" class="nav-link {{ request()->is('bencana') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-fire"></i>
                        <p>
                            Bencana
                        </p>
                    </a>
                </li>

                @auth('web')
                <li class="nav-item">
                    <a href="{{url('/cadang')}}" class="nav-link {{ request()->is('cadang') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-window-restore"></i>
                        <p>
                            Cadangkan
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('/laporan')}}" class="nav-link {{ request()->is('laporan') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Laporan
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-close">
                    <a href="{{url('/member')}}"
                        class="nav-link {{ request()->is('memberPusdalop') || request()->is('memberTRC') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Member
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/memberPusdalop')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pusdalop</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/memberTRC')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>TRC</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Relawan</p>
                            </a>
                            </li> -->
                    </ul>
                </li>
                </li>
                @endauth

                @if(Auth::guard('web')->check() || Auth::guard('karyawan')->check())
                <li class="nav-item">
                    <a href="{{url('/kepulangan')}}" class="nav-link {{ request()->is('kepulangan') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-solid fa-home"></i>
                        <!-- <i class="fas fa-home"></i> -->
                        <!-- <i class="fa-solid fa-house"></i> -->
                        <p>
                            Kepulangan
                        </p>
                    </a>
                </li>
                @endauth




        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>