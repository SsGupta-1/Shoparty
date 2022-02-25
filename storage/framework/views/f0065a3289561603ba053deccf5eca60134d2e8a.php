<?php $__env->startSection('content'); ?>
<div class="brandblk toppading">
    <div class="brandleft">
        <h1>CMS Management</h1>
    </div>
</div>

<div class="datablk">
    <table>
        <tr>
            <th class="sn">S.N.</th>

            <th>Used In Application</th>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
        </tr>

        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="sn"><?php echo e($key+1); ?></td>
                <td><?php echo e(Config::get('constants.static.'.$row['type'])); ?></td>
                <td><?php echo e($row['title']); ?></td>
                <td><?php echo e($row['description']); ?></td>

                <td class="act">
                    <span><a href="<?php echo e(url('admin/cms/edit/'.$row['id'])); ?>"><img src="<?php echo e(asset('assets/img/icon-material-edit.png')); ?>" alt="Edit"></a></span>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </table>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_master_after_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/cms/index.blade.php ENDPATH**/ ?>