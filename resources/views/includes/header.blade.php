{{-- <div class="main-dashboard">
    <nav aria-label="breadcrumb">
        <div class="breadcrumb mt-2 d-flex justify-content-between">
            <div class="d-lg-none">
                <button class=" navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
            </div>
            <div class="d-none d-lg-block d-sm-none breadcrumb-item ml-4">
                <span class="span_home mr-2 fs-f5">
                    @yield('pages_home')
                </span>

                <span class="slash-home mr-2">
                    @yield('slash_Home')
                </span>

                <span class="breadcum-title">
                    @yield('bredcrum')
                </span>
                <span class="span-mp mr-2 fs-f5">
                    @yield('pagesMP')
                </span>

                <span class="slashMP mr-2">
                    @yield('slasMP')
                </span>

                <span class="breadcum-mp">
                    @yield('master_projek')
                </span>
            </div>
            <button class="btn btn-sm mt--2 rounded tooltip-container" type="button"
                style="float: left; margin-right:3px; background-color:#F1F4FA;">
                <a class="button-logout" onclick="$('#logout-form').submit()" style="color: #718096;">
                    Logout
                    <i class="fas fa-sign-out-alt"></i>
                </a>
                <span class="tooltip-text">Logout</span>
            </button>
        </div>
    </nav>
    <div class="col-md-12">
        <h2 class="text-dashboard font-weight-bold display-6">
            @yield('title')
        </h2>

    </div>
</div>
<form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
    @csrf
</form> --}}