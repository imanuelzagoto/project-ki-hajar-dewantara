<div class="main-dashboard">
    <nav aria-label="breadcrumb">
        <div class="breadcrumb mt-3 d-flex justify-content-between">
            <div class="d-lg-none">
                <button class=" navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
            </div>
            <div class="d-none d-lg-block d-sm-none breadcrumb-item ml-4">
                <span class="span-pages mr-2 fs-f5">Pages</span>
                <span class="mr-2 slash">/</span>
                <span class="breadcum-title">
                    @yield('bredcrum')
                </span>
                <span class="breadcum-title">
                    @yield('spk')
                </span>
                <span class="breadcum-title">
                    @yield('PD')
                </span>
            </div>
            <button class="btn btn-white btn-sm mt--2 rounded" type="button" style="float: left; margin-right:3px;">
                <a class="button-logout" onclick="$('#logout-form').submit()" style="color: #718096;">
                    Logout
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </button>

            {{-- <div class="dropdown">
                <button class="btn btn-white btn-sm bg-white dropdown-toggle mt--2" type="button" id="userDropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i style="font-size:1.1rem; color:cadetblue;" class="fa fa-user mr-2"
                        style="color: #718096"></i>{{ auth()->user()->full_name }}
                </button>

                <div class="dropdown-menu" aria-labelledby="userDropdown">
                    <li>
                        <a class="dropdown-item" href="#" onclick="$('#logout-form').submit()"><i
                                class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                </div>
            </div> --}}
        </div>
    </nav>
    <h2 class="text-dashboard font-weight-bold display-6">
        @yield('title')
    </h2>
</div>
<!-- End Navbar -->
<form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
    @csrf
</form>
