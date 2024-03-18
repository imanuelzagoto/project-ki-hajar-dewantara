<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ config('app.name') }} | Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('/partas/img/surattt.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('/partas/css/kiha.css') }}">
    <link rel="stylesheet" href="{{ asset('/partas/css/fonts.min.css') }}">
    <script src="{{ asset('/partas/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['partas/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link rel="stylesheet" href="{{ asset('/partas/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/partas/css/atlantis.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/partas/css/demo.css') }}">
    <!-- Datatables -->
    <link rel="stylesheet" href="{{ asset('/partas/css/datatables.min.css') }}">
    @include('includes.js')
</head>

<body style="background-color: #F1F4FA">
    <div class="wrapper">
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
