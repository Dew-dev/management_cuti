<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue">
        <a href="{{ url('/') }}" class="logo mt-2">
            <span style="display:flex;">
                <img src="{{ asset('img/logo_new.png') }}" width="50" alt="navbar brand" class="navbar-brand">
                <h5 class="text-light ml-1" style="margin:auto;">Manajemen Cuti</h5>
            </span>
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
            data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            @if (Auth::guard('admin')->check() || Auth::guard('lead')->check())
                                <img src="{{ asset('img/admin.png') }}" style="background-color:white;" alt="..."
                                    class="avatar-img rounded-circle">
                            @else
                                <img src="{{ asset('img/user.png') }}" alt="..." class="avatar-img rounded-circle">
                            @endif
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        @if (Auth::guard('admin')->check() || Auth::guard('lead')->check())
                                            <img src="{{ asset('img/admin.png') }}" style="background-color:white;"
                                                alt="..." class="avatar-img rounded-circle">
                                        @else
                                            <img src="{{ asset('img/user.png') }}" alt="..."
                                                class="avatar-img rounded-circle">
                                        @endif
                                    </div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->nama }}</h4>
                                        <p class="text-muted"><b>{{ Auth::user()->role->nama }}</b></p>
                                    </div>
                                </div>
                            </li>
                            @if (!Auth::guard('admin')->check())
                                @if (Auth::guard('lead')->check())
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{route('lead.users.edit_profile',['id'=>Auth::user()->id])}}"> Edit Profile</a>
                                    </li>
                                    @else
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{route('user.users.edit_profile',['id'=>Auth::user()->id])}}"> Edit Profile</a>
                                    </li>
                                @endif
                            @endif
                            <li>
                                <div class="dropdown-divider"></div>
                                <form action="{{ url('/auth/logout') }}" method="post">
                                    @csrf
                                    <button class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                @if (Auth::guard('admin')->check())
                    <li class="nav-item ">
                        <a href="{{ route('admin.dashboard.index') }}" aria-expanded="false">
                            <i class="fas fa-chart-bar"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('admin.pengajuan.index') }}" aria-expanded="false">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Daftar Pengajuan Cuti</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('admin.users.index') }}" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            <p>User</p>
                        </a>
                    </li>
                @elseif(Auth::guard('lead')->check())
                    <li class="nav-item ">
                        <a href="{{ route('lead.dashboard.index') }}" aria-expanded="false">
                            <i class="fas fa-chart-bar"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('lead.pengajuan.index') }}" aria-expanded="false">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Daftar Pengajuan Cuti</p>
                        </a>
                    </li>
                @else
                    <li class="nav-item ">
                        <a href="{{ route('user.pengajuan.index') }}" aria-expanded="false">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Pengajuan Cuti</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
