<?php $__env->startSection('content'); ?>
<h1>Add Brand</h1>

<form method="post" action="<?php echo e(url('admin/store/add')); ?>" autocomplete="off">
    <?php echo csrf_field(); ?>
    <div class="datablk mtop">
        <div class="datainner"> 
            <ul class="frmlist">
                <li> <span>Store Name</span> <input type="text" class="form-control" name="en_store_name" value="<?php echo e(old('en_store_name')); ?>" placeholder="Enter Store Name"></li>
                <li> <span>Arabic Name</span> <input type="text" class="form-control" name="ar_store_name" value="<?php echo e(old('ar_store_name')); ?>" placeholder="Enter Arabic Name"></li>
            </ul>

            <ul class="frmlist">
                <li> <span>Address</span> <input type="text" class="form-control" name="en_store_address" value="<?php echo e(old('en_store_address')); ?>" placeholder="Enter Store Address"></li>
                <li> <span>Arabic Address</span> <input type="text" class="form-control" name="ar_store_address" value="<?php echo e(old('ar_store_address')); ?>" placeholder="Enter Arabic Address"></li>
            </ul>
        </div>

    </div>

    <div class="mfooter fbleft">
        <a href="<?php echo e(url('admin/stores')); ?>" class="btn">Cancel</a>
        <button type="submit" class="btn mbtn">Save</button>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_master_after_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/store/add.blade.php ENDPATH**/ ?>