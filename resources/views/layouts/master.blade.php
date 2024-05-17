<?php
$userData = Session::get('user');
$userrole = $userData['modules']['name']; // Ambil peran pengguna dari data pengguna

// dd($userRole);
// Periksa apakah peran pengguna adalah "Super Admin"
$isSuperAdmin = $userrole === 'Super Admin';
$isUser = $userrole === 'user biasa';
$isDriver = $userrole === 'Driver';
$isGA = $userrole === 'General Affair';
$isHR = $userrole === 'Hr';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="{{ asset('sets/images/siops.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('sets/images/siops.svg') }}" type="image/x-icon">
    <title>{{ config('app.name') }} | @yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" href="{{ asset('/partas/css/kiha.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    {{-- <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['{{ asset() }}partas/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script> --}}


    <link rel="stylesheet" href="{{ asset('/partas/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/partas/css/atlantis.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/partas/css/demo.css') }}">
    <!-- Datatables -->
    <link rel="stylesheet" href="{{ asset('/partas/css/datatables.min.css') }}">
    @include('includes.js')
</head>

{{-- class="master_root custom-scroll-bar" --}}

<body style="background-color: #F1F4FA">

    <div class="">
        @include('includes.sidebar')
        <!--header -->

        <!-- end header -->
        <!-- Sidebar -->
        <!-- End Sidebar -->
        <div class="main-panel">
            {{-- @include('includes.header') --}}
            <div class="content">
                @yield('content')
            </div>
            <!--footer -->
            {{-- @include('includes.footer') --}}
            <!-- end footer -->
        </div>
    </div>
    @include('includes.js')
    @stack('scripts')
</body>

</html>
