<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
      <title>Shoparty | Admin</title>
      <meta name="description" content="Play CKC">
      <!-- Favicons -->
      <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
      <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
      <link rel="apple-touch-icon" sizes="57x57" href="{{asset('assets/img/apple-icon-57x57.png')}}">
      <link rel="apple-touch-icon" sizes="60x60" href="{{asset('assets/img/apple-icon-60x60.png')}}">
      <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/img/apple-icon-72x72.png')}}">
      <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon-76x76.png')}}">
      <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/img/apple-icon-114x114.png')}}">
      <link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/img/apple-icon-120x120.png')}}">
      <link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets/img/apple-icon-144x144.png')}}">
      <link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/img/apple-icon-152x152.png')}}">
      <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/apple-icon-180x180.png')}}">
      <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('assets/img/android-icon-192x192.png')}}">
      <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/img/favicon-32x32.png')}}">
      <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/favicon-96x96.png')}}">
      <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/img/favicon-16x16.png')}}">
      <link rel="manifest" href="{{asset('assets/img/manifest.json')}}">
      <meta name="msapplication-TileColor" content="#ffffff">
      <meta name="msapplication-TileImage" content="{{asset('assets/img/ms-icon-144x144.png')}}">
      <meta name="theme-color" content="#ffffff">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
      <!-- Vendor CSS Files -->
      <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{asset('assets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
      <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
      <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
      <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <!-- Java Script -->
      @toastr_css
   </head>
   <body>
      <div class="split left">
      </div>
      @yield('content')
      <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
      <script type="text/javascript" src="{{ asset('assets/js/jquery-ui.min.js') }}" crossorigin="anonymous"></script>
      <script src="{{ asset('assets/js/admin.js') }}"></script>
      @toastr_js
      @toastr_render
      @yield('script')
   </body>
</html>