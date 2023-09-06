<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Login - Mahathep</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
        <meta name="description" content="ArchitectUI HTML Bootstrap 5 Dashboard Template">
        <!-- Disable tap highlight on IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <link rel="stylesheet" href="{{ asset('distemplate/vendors/@fortawesome/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('distemplate/vendors/ionicons-npm/css/ionicons.css') }}">
        <link rel="stylesheet" href="{{ asset('distemplate/vendors/linearicons-master/dist/web-font/style.css') }}">
        <link rel="stylesheet" href="{{ asset('distemplate/vendors/pixeden-stroke-7-icon-master/pe-icon-7-stroke/dist/pe-icon-7-stroke.css') }}">
        <link href="{{ asset('distemplate/styles/css/base.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="app-container app-theme-white body-tabs-shadow">
            
            @yield('content')
           

        </div>
        <!-- plugin dependencies -->
        <script type="text/javascript" src="{{ asset('distemplate/vendors/jquery/dist/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('distemplate/vendors/slick-carousel/slick/slick.min.js') }}"></script>
        <!-- custome.js -->
        <script type="text/javascript" src="{{ asset('distemplate/js/carousel-slider.js') }}"></script>
    </body>
</html>
