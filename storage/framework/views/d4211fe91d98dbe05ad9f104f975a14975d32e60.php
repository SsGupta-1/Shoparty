<?php $__env->startSection('content'); ?>
<h1>Add Policy</h1>

<form method="post" action="<?php echo e(url('admin/policy/add')); ?>" autocomplete="off">
    <?php echo csrf_field(); ?>
    <div class="datablk mtop">
        <div class="datainner">	
            <div class="fly">
                <ul class="frmlist twolist">
                    <li>
                        <span>Used In Application</span> 
                        <select class="form-control" name="type">
                            <option value="2" <?php echo e((old('type') == 2) ? 'selected' : ''); ?>>Return Policy</option>
                            <option value="3" <?php echo e((old('type') == 3) ? 'selected' : ''); ?>>Privacy Policy</option>
                        </select>
                    </li>
                    <li> 
                        <span>Title</span>
                        <input type="text" class="form-control" name="title" value="<?php echo e(old('title')); ?>" placeholder="Enter Title">
                    </li>
                </ul>
            </div>
            <div class="frmsheadnew">Description</div>
            <div class="textblk">
                <textarea class="form-control" cols="5" name="description"><?php echo e(old('description')); ?></textarea>
            </div>
        </div>
    </div>
    <div class="mfooter fbleft">
        <a href="<?php echo e(url('admin/policy')); ?>" class="btn" data-dismiss="modal">Cancel</a>
        <button type="submit" class="btn mbtn">Save</button>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_master_after_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/policy/add.blade.php ENDPATH**/ ?>