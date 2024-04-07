<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>mikman </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets') }}/logo.ico">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/chartist/css/chartist.min.css">
    <link href="{{ asset('assets') }}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.2/css/perfect-scrollbar.min.css"
        rel="stylesheet">

</head>

<body>
    @include('sweetalert::alert')
    @include('layouts.loader')
    @include('layouts.header')
    @include('layouts.menu')
    <div class="content-body">
        <div class="container-fluid">
            @yield('body')
        </div>
    </div>
    @include('layouts.footer')
    </div>
    @include('layouts.script')
    @include('pppoe.toggle.server')
    @include('pppoe.toggle.profile')
    @include('pppoe.toggle.sys')


</body>

</html>
