<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('partaz/images/surattt.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('partaz/images/surattt.png') }}" type="image/x-icon">
    <title>{{ config('app.name') }} | Log in</title>
    <link rel="stylesheet" href="{{ asset('partaz/css/piclogin.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('partaz/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('partaz/css/icofont.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('partaz/css/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('partaz/css/flag-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('partaz/css/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('partaz/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('partaz/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('partaz/css/color-1.css') }}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ asset('partaz/css/responsive.css') }}">
</head>

<body>
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>
    <section>
        @yield('login')
    </section>
    @include('includes.js')
</body>

</html>
