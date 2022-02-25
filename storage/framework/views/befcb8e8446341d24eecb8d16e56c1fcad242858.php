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
      <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet">
      <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <!-- Java Script -->
      <?php echo toastr_css(); ?>
   </head>
   <body>
      <div class="split left">
      </div>
      <?php echo $__env->yieldContent('content'); ?>
      <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
      <script type="text/javascript" src="<?php echo e(asset('assets/js/jquery-ui.min.js')); ?>" crossorigin="anonymous"></script>
      <script src="<?php echo e(asset('assets/js/admin.js')); ?>"></script>
      <?php echo toastr_js(); ?>
      <?php echo app('toastr')->render(); ?>
      <?php echo $__env->yieldContent('script'); ?>
   </body>
</html><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/layouts/admin_master_before_login.blade.php ENDPATH**/ ?>