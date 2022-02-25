<div class="clobt"><i class="icofont-close-circled"></i></div>

<ul class="listbar">
    <li class="<?php echo e((Request::segment(2) == 'dashboard') ? 'active' : ''); ?>"><a href="#"><img src="<?php echo e(asset('assets/img/report.svg')); ?>" alt="Reports"> Reports And Analytics</a></li>

    <li class="<?php echo e((Request::segment(2) == 'users' || Request::segment(2) == 'user') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/users')); ?>"><img src="<?php echo e(asset('assets/img/community-manager.svg')); ?>" alt="Manage User"> Manage User</a></li>

    <li class="<?php echo e((Request::segment(2) == 'product') ? 'active' : ''); ?>"><a href="#"><img src="<?php echo e(asset('assets/img/productmaster.svg')); ?>" alt="Product Master"> Product Master</a></li>

    <li class="<?php echo e((Request::segment(2) == 'home-page') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/homepage')); ?>"><img src="<?php echo e(asset('assets/img/homepage.svg')); ?>" alt="Home Page Management"> Home Page Management</a></li>

    <li class="<?php echo e((Request::segment(2) == 'service-category') ? 'active' : ''); ?>"><a href="#"><img src="<?php echo e(asset('assets/img/servicescategory.svg')); ?>" alt="Services">Services Category</a></li>

    <li class="<?php echo e((Request::segment(2) == 'admin') ? 'active' : ''); ?>"><a href="#"><img src="<?php echo e(asset('assets/img/notificationhandling.svg')); ?>" alt="Notification Handling"> Notification Handling</a></li>

    <li class="<?php echo e((Request::segment(2) == 'admin') ? 'active' : ''); ?>"><a href="#"><img src="<?php echo e(asset('assets/img/vouchers.svg')); ?>" alt="Vouchers">Vouchers</a></li>

    <li class="<?php echo e((Request::segment(2) == 'admin') ? 'active' : ''); ?>"><a href="#"><img src="<?php echo e(asset('assets/img/thememanagement.svg')); ?>" alt="Theme Management">Theme Management</a></li>

    <li class="<?php echo e((Request::segment(2) == 'stores' || Request::segment(2) == 'store') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/stores')); ?>"><img src="<?php echo e(asset('assets/img/storemanagement.svg')); ?>" alt="Store Management">Store Management</a></li>

    <li class="<?php echo e((Request::segment(2) == 'orders' || Request::segment(2) == 'order') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/orders')); ?>"><img src="<?php echo e(asset('assets/img/ordermanagement.svg')); ?>" alt="Order Management"> Order Management</a></li>

    <li class="<?php echo e((Request::segment(2) == 'admin') ? 'active' : ''); ?>"><a href="#"><img src="<?php echo e(asset('assets/img/seasonmanagement.svg')); ?>" alt="Season Management"> Season Management</a></li>

    <li class="<?php echo e((Request::segment(2) == 'brands' || Request::segment(2) == 'brand') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/brands')); ?>"><img src="<?php echo e(asset('assets/img/brandmanagement.svg')); ?>" alt="Brand Management"> Brand Management</a></li>

    <li class="<?php echo e((Request::segment(2) == 'cms') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/cms')); ?>"><img src="<?php echo e(asset('assets/img/managecms.svg')); ?>" alt="Manage CMS"> Manage CMS</a></li>

    <li class="<?php echo e((Request::segment(2) == 'policy') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/policy')); ?>"><img src="<?php echo e(asset('assets/img/managecms.svg')); ?>" alt="Manage CMS"> Manage Policy</a></li>

    <li class="<?php echo e((Request::segment(2) == 'offer') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/offer')); ?>"><img src="<?php echo e(asset('assets/img/noun-policy.svg')); ?>" alt="Offer Management"> Offer Management</a></li>


    <br>

    <li><a href="<?php echo e(url('admin/logout')); ?>"><img src="<?php echo e(asset('assets/img/logout.svg')); ?>" alt="Logout"> Logout</a></li>
</ul><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/includes/sidebar.blade.php ENDPATH**/ ?>