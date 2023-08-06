<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue">
        <a href="/" class="logo mt-2">
            <span style="display:flex;">
                <img src="{{ asset('img/fru-white.png') }}" width="50" alt="navbar brand" class="navbar-brand">
                <h1 class="text-light ml-1" style="margin:auto;">fru.id</h2>
            </span>
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse"
            aria-expanded="false" aria-label="Toggle navigation">
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
                            @if(Auth::guard('admin')->check())
                                <img src="{{ asset('img/admin.png') }}" style="background-color:white;" alt="..." class="avatar-img rounded-circle">
                            @else
                                <img src="{{ asset('img/user.png') }}" alt="..." class="avatar-img rounded-circle">
                            @endif
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <form action="{{url('/auth/logout')}}" method="post">
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
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                @if(Auth::guard('admin')->check())
                    <img src="{{ asset('img/admin.png') }}" alt="..." class="avatar-img rounded-circle">
                @else
                    <img src="{{ asset('img/user.png') }}" alt="..." class="avatar-img rounded-circle">
                @endif
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{Auth::user()->name}}
                            <span class="user-level">{{Auth::user()->role->nama}}</span>
                        </span>
                    </a>

                </div>
            </div>
            <ul class="nav nav-primary">
            @if(Auth::guard('admin')->check())
                <li class="nav-item ">
                    <a href="{{route('admin.dashboard.index')}}" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        <p>User</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{route('admin.pengajuan.index')}}" aria-expanded="false">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Pengajuan</p>
                    </a>
                </li>
            @else
                {{-- <li class="nav-item ">
                    <a href="{{route('user.dashboard.index')}}" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li> --}}
                <li class="nav-item ">
                    <a href="{{route('user.order.index')}}" aria-expanded="false">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Order</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{route('user.product.index')}}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-boxes"></i>
                        <p>Product</p>
                    </a>
                </li>
            @endif
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
