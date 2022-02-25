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
        <link href="{{asset('assets/css/jquery.multiselect.css')}}" rel="stylesheet">
        

        <link href="{{asset('assets/css/style.css?id=5')}}" rel="stylesheet">
        <link href="{{asset('assets/css/style.css?id=2')}}" rel="stylesheet">
        <link href="{{asset('assets/css/style.css?id=8.2')}}" rel="stylesheet">
        <!-- Java Script -->

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        @toastr_css
    </head>

    <body>
        <header class="headerblk">
            <div class="container">
                <div class="fullblk">
                    <div class="logoleft">         
                        <a href="./" class="logo"><img src="{{asset('assets/img/logo.png')}}" alt=""></a>
                    </div>

                    <div class="contentright">
                        <ul class="topright">
                            <!-- <li>
                                <a href="#">
                                    <img src="{{asset('assets/img/notifications-none.svg')}}" alt="">
                                    <div class="neti">10</div>
                                </a>
                            </li> -->
                            <li class="setuser">
                                <a href="#">
                                    <img src="{{asset('assets/img/usernew.jpeg')}}" alt="">
                                </a>
                            </li>
                            <li><a href="#">George Mavroudis</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </header>
        <div class="maindiv">
            <div class="innerdiv">
                <div class="container">
                    <div class="flitericon">
                        <span id="leftmenu"><i class="icofont-navigation-menu"></i></span>
                    </div>
                    <div class="leftbar">
                        @include('admin.includes.sidebar')
                    </div>

                    <div class="rightblk">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <footer  class="footerbg">
            <div class="container">
                <div class="copytxt">©2021 by Shoparty</div>
            </div>
        </footer>

        <!-- jQuery library -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>

        <!-- Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

        <script type="text/javascript">            

            $(document).ready(function() {
                $('#fedata').DataTable( {
                    // "pagingType": "full_numbers"
                } );


                $( "#leftmenu" ).click(function() {
                    $(".leftbar").show();
                });
                $( ".clobt" ).click(function() {
                    $(".leftbar").hide();
                });

            });

        </script>

        <script type="text/javascript" src="{{ asset('assets/js/jquery-ui.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/js/admin.js') }}"></script>
        @toastr_js
        @toastr_render
        @yield('script')

    </body>
</html>