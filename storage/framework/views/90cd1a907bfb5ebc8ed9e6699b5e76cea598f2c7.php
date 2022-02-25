<?php $__env->startSection('content'); ?>
<h1>Edit CMS</h1>

<form method="post" action="<?php echo e(url('admin/cms/edit/'.$static['id'])); ?>" autocomplete="off">
    <?php echo csrf_field(); ?>
    <div class="datablk mtop">
        <div class="datainner">	
            <div class="fly">
                <ul class="frmlist twolist">
                    <li> <span>Used In Application</span> 
                        <select class="form-control" disabled>
                            <option value="1" <?php echo e((old('type', $static['type']) == 1) ? 'selected' : ''); ?>>About Us</option>
                            <option value="4" <?php echo e((old('type', $static['type']) == 4) ? 'selected' : ''); ?>>Terms & Conditions</option>
                        </select>
                        <input type="hidden" name="type" value="<?php echo e(old('type', $static['type'])); ?>">
                    </li>
                    <li> <span>Title</span> <input type="text" class="form-control" name="title" value="<?php echo e(old('title', $static['title'])); ?>" placeholder="Enter Title"></li>

                </ul>
            </div>
            <div class="frmsheadnew">Description</div>
            <div class="textblk">
                <textarea class="form-control" cols="5" name="description"><?php echo e(old('description', $static['description'])); ?></textarea>
            </div>
        </div>
    </div>
    <div class="mfooter fbleft">
        <a href="<?php echo e(url('admin/cms')); ?>" class="btn" data-dismiss="modal">Cancel</a>
        <button type="submit" class="btn mbtn">Save</button>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_master_after_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/cms/edit.blade.php ENDPATH**/ ?>