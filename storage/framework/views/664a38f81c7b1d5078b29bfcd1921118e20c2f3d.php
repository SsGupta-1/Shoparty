<?php $__env->startSection('content'); ?>
<h1>Add Brand</h1>

<form method="post" action="<?php echo e(url('admin/brand/add')); ?>" autocomplete="off">
    <?php echo csrf_field(); ?>
    <div class="datablk mtop">
        <div class="datainner"> 
            <ul class="frmlist">
                <li> <span>Brand Name</span> <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" placeholder="Enter Brand Name"></li>
                <li> <span>Arabic Name</span> <input type="text" class="form-control" name="ar_name" value="<?php echo e(old('ar_name')); ?>" placeholder="Enter Arabic Name"></li>
            </ul>
        </div>

    </div>

    <div class="mfooter fbleft">
        <a href="<?php echo e(url('admin/brands')); ?>" class="btn">Cancel</a>
        <button type="submit" class="btn mbtn">Save</button>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_master_after_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/brand/add.blade.php ENDPATH**/ ?>