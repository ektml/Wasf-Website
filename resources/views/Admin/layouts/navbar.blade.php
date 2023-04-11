<header id="page-topbar">
<div class="navbar-header">
<div class="d-flex">
<!-- LOGO -->
<div class="navbar-brand-box">
    <a href="index.html" class="logo logo-dark">
        <span class="logo-sm">
            <img src="{{asset('assets/images/newlogo.png')}}" alt="" height="22">
        </span>
        <span class="logo-lg">
            <img src="{{asset('assets/images/newlogo.png')}}" alt="" height="20">
        </span>
    </a>

    <a href="index.html" class="logo logo-light">
        <span class="logo-sm">
            <img src="{{asset('assets/images/newlogo.png')}}" alt="" height="22">
        </span>
        <span class="logo-lg">
            <img src="{{asset('assets/images/newlogo.png')}}" alt="" height="20">
        </span>
    </a>
</div>

<button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
    <i class="fa fa-fw fa-bars"></i>
</button>

<!-- App Search-->
<form class="app-search d-none d-lg-block">
    <div class="position-relative">
    </div>
</form>
</div>

<div class="d-flex">

<div class="dropdown d-inline-block d-lg-none ms-2">
    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="uil-search"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
        aria-labelledby="page-header-search-dropdown">

        <form class="p-3">
            <div class="m-0">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="dropdown d-none d-lg-inline-block ms-1">
    <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
        <i class="uil-minus-path"></i>
    </button>
</div>

{{-- <div class="dropdown d-inline-block">
    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="uil-bell"></i>
        <span class="badge bg-danger rounded-pill">3</span>
    </button>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
        aria-labelledby="page-header-notifications-dropdown">
        <div class="p-3">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="m-0 font-size-16"> Notifications </h5>
                </div>
                <div class="col-auto">
                    <a href="#!" class="small"> Mark all as read</a>
                </div>
            </div>
        </div>
        <div data-simplebar style="max-height: 230px;">
            <a href="javascript:void(0);" class="text-reset notification-item">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar-xs">
                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                <i class="uil-shopping-basket"></i>
                            </span>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1">Your order is placed</h6>
                        <div class="font-size-12 text-muted">
                            <p class="mb-1">If several languages coalesce the grammar</p>
                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="javascript:void(0);" class="text-reset notification-item">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3">
                        <img src="Admin3/assets/images/users/avatar-3.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1">James Lemire</h6>
                        <div class="font-size-12 text-muted">
                            <p class="mb-1">It will seem like simplified English.</p>
                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hour ago</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="javascript:void(0);" class="text-reset notification-item">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar-xs">
                            <span class="avatar-title bg-success rounded-circle font-size-16">
                                <i class="uil-truck"></i>
                            </span>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1">Your item is shipped</h6>
                        <div class="font-size-12 text-muted">
                            <p class="mb-1">If several languages coalesce the grammar</p>
                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                        </div>
                    </div>
                </div>
            </a>

            <a href="javascript:void(0);" class="text-reset notification-item">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3">
                        <img src="Admin3/assets/images/users/avatar-4.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1">Salena Layfield</h6>
                        <div class="font-size-12 text-muted">
                            <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="p-2 border-top">
            <div class="d-grid">
                <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                    <i class="uil-arrow-circle-right me-1"></i> View More..
                </a>
            </div>
        </div>
    </div>
</div> --}}

<div class="dropdown d-inline-block">
    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img class="rounded-circle header-profile-user" src="{{asset('Admin3/assets/images/users/'.auth()->user()->profile_image)}}"
            alt="Header Avatar">
        <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">{{auth()->user()->name}}</span>
        <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end">
        <!-- item-->
        {{-- <a class="dropdown-item" href="#"><i class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span class="align-middle">View Profile</span></a>
        <a class="dropdown-item" href="#"><i class="uil uil-wallet font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">My Wallet</span></a>
        <a class="dropdown-item d-block" href="#"><i class="uil uil-cog font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Settings</span> <span class="badge bg-soft-success rounded-pill mt-1 ms-2">03</span></a>
        <a class="dropdown-item" href="#"><i class="uil uil-lock-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Lock screen</span></a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form> --}}
        {{-- <a class="dropdown-item  logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Sign out</span></a>
         --}}
         <form id="logout-form" action="{{ route('logout') }}" method="GET" >
            @csrf
            <button class="dropdown-item ">
                <i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Sign out</span></button>
        </form>
    </div>
</div>

<div class="dropdown d-inline-block">
    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
        <i class="uil-cog"></i>
    </button>
</div>

</div>
</div>
</header>
