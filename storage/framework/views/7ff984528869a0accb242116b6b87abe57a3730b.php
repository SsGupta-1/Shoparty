<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <title>Shoparty | Admin</title>
        <meta name="description" content="Play CKC">
        <!-- Favicons -->
        <link href="<?php echo e(asset('assets/img/favicon.png')); ?>" rel="icon">
        <link href="<?php echo e(asset('assets/img/apple-touch-icon.png')); ?>" rel="apple-touch-icon">
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo e(asset('assets/img/apple-icon-57x57.png')); ?>">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo e(asset('assets/img/apple-icon-60x60.png')); ?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo e(asset('assets/img/apple-icon-72x72.png')); ?>">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(asset('assets/img/apple-icon-76x76.png')); ?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo e(asset('assets/img/apple-icon-114x114.png')); ?>">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(asset('assets/img/apple-icon-120x120.png')); ?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo e(asset('assets/img/apple-icon-144x144.png')); ?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo e(asset('assets/img/apple-icon-152x152.png')); ?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('assets/img/apple-icon-180x180.png')); ?>">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo e(asset('assets/img/android-icon-192x192.png')); ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('assets/img/favicon-32x32.png')); ?>">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo e(asset('assets/img/favicon-96x96.png')); ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('assets/img/favicon-16x16.png')); ?>">
        <link rel="manifest" href="<?php echo e(asset('assets/img/manifest.json')); ?>">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo e(asset('assets/img/ms-icon-144x144.png')); ?>">
        <meta name="theme-color" content="#ffffff">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <!-- Vendor CSS Files -->
        <link href="<?php echo e(asset('assets/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('assets/vendor/icofont/icofont.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('assets/vendor/boxicons/css/boxicons.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('assets/css/jquery.multiselect.css')); ?>" rel="stylesheet">
        

        <link href="<?php echo e(asset('assets/css/style.css?id=5')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('assets/css/style.css?id=2')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('assets/css/style.css?id=8.2')); ?>" rel="stylesheet">
        <!-- Java Script -->

        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

        <?php echo toastr_css(); ?>
    </head>

    <body>
        <header class="headerblk">
            <div class="container">
                <div class="fullblk">
                    <div class="logoleft">         
                        <a href="./" class="logo"><img src="<?php echo e(asset('assets/img/logo.png')); ?>" alt=""></a>
                    </div>

                    <div class="contentright">
                        <ul class="topright">
                            <!-- <li>
                                <a href="#">
                                    <img src="<?php echo e(asset('assets/img/notifications-none.svg')); ?>" alt="">
                                    <div class="neti">10</div>
                                </a>
                            </li> -->
                            <li class="setuser">
                                <a href="#">
                                    <img src="<?php echo e(asset('assets/img/usernew.jpeg')); ?>" alt="">
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
                        <?php echo $__env->make('admin.includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <div class="rightblk">
                        <?php echo $__env->yieldContent('content'); ?>
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

        <script type="text/javascript" src="<?php echo e(asset('assets/js/jquery-ui.min.js')); ?>" crossorigin="anonymous"></script>
        <script src="<?php echo e(asset('assets/js/admin.js')); ?>"></script>
        <?php echo toastr_js(); ?>
        <?php echo app('toastr')->render(); ?>
        <?php echo $__env->yieldContent('script'); ?>

    </body>
</html><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/layouts/admin_master_after_login.blade.php ENDPATH**/ ?>