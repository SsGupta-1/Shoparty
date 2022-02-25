<?php $__env->startSection('content'); ?>
<h1>Manage User</h1>
<div class="brandblk">
    <div class="brandleft">
        <ul class="blist">
            <li><a href="#"><img src="<?php echo e(asset('assets/img/filter.svg')); ?>" alt="Reports"> Sorting</a></li>
            <li><a href="#"><img src="<?php echo e(asset('assets/img/import.svg')); ?>" alt="Reports"> Import</a></li>
            <li><a href="#"><img src="<?php echo e(asset('assets/img/download.svg')); ?>" alt="Reports"> Download</a></li>
        </ul>
    </div>
    <div class="brandright">
        <ul class="brlist">
            <li><a href="<?php echo e(url('admin/user/add')); ?>"> Add User</a></li>
        </ul>
    </div>
</div>

<div class="demo-html datablk">
    <table id="fedata" class="display" style="width:100%">
        <thead>
            <tr>
                <th class="sn">S.N.</th>
                <th class="name">Name</th>
                <th class="email">Email Id</th>
                <th class="mobile">Mobile Number</th>
                <th class="address">Address</th>
                <th class="gender">Gender</th>
                <th class="dob">Date of Birth</th>
                <th class="useraction">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="sn"><?php echo e($key+1); ?></td>
                    <td><?php echo e($row['name']); ?></td>
                    <td><?php echo e($row['email']); ?></td>
                    <td><?php echo e($row['mobile']); ?></td>
                    <td><?php echo e($row['address']); ?></td>
                    <td><?php echo e($row['gender']); ?></td>
                    <td><?php echo e($row['dob']); ?></td>
                    <td class="act">
                        <span><a href="<?php echo e(url('admin/user/edit/'.$row['id'])); ?>"><img src="<?php echo e(asset('assets/img/icon-material-edit.png')); ?>" alt="Edit"></a></span>
                        <span><a href="<?php echo e(url('admin/user/delete/'.$row['id'])); ?>"><img src="<?php echo e(asset('assets/img/icon-material-delete.png')); ?>" alt="Delete"></a></span>
                        <span><a href="<?php echo e(url('admin/user/view/'.$row['id'])); ?>"><img src="<?php echo e(asset('assets/img/icon-feather-eye.png')); ?>" alt="View"></a></span>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_master_after_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/user/index.blade.php ENDPATH**/ ?>