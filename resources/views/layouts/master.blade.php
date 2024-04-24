<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ config('app.name') }} | Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    {{-- <link rel="icon" href="{{ asset('/partas/img/surattt.png') }}" type="image/x-icon" /> --}}
    <link rel="stylesheet" href="{{ asset('/partas/css/kiha.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link rel="stylesheet" href="{{ asset('/partas/css/fonts.min.css') }}"> --}}
    {{-- <script src="{{ asset('/partas/js/plugin/webfont/webfont.min.js') }}"></script> --}}
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
