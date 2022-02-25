<?php $__env->startSection('content'); ?>
<div class="brandblk toppading">
    <div class="brandleft">
        <h1>Brand Management</h1>
    </div>
    <div class="brandright topamr">
        <ul class="brlist">
            <li><a href="<?php echo e(url('admin/brand/add')); ?>"> Add New Brand</a></li>
        </ul>
    </div>
</div>

<div class="demo-html datablk">
    <table id="fedata" class="display" style="width:100%">
        <thead>
            <tr>
                <th class="snbrand">S.N.</th>
                <th class="">Brand List</th>
                <th class="">Arabic Name</th>

                <th class="brandaction">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="snbrand"><?php echo e($key+1); ?></td>
                    <td class=""><?php echo e($row['name']); ?></td>
                    <td class=""><?php echo e($row['ar_name']); ?></td>

                    <td class="brandaction">
                        <select class="form-control searchicon" onchange="updateStatus(this, event, '<?php echo e($row['status_url']); ?>');">
                            <option value="1" <?php echo e(($row['status'] == 1) ? 'selected' : ''); ?>>Active</option>
                            <option value="0" <?php echo e(($row['status'] == 0) ? 'selected' : ''); ?>>Inactive</option>
                        </select>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>

    </table>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_master_after_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/brand/index.blade.php ENDPATH**/ ?>