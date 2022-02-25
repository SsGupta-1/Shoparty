<?php $__env->startSection('content'); ?>
    <div class="brandblk toppading">
        <div class="brandleft">
            <h1>Offer Management</h1>
        </div>
        <div class="brandright topamr">
            <ul class="brlist">
                                
                <li><a href="<?php echo e(url('admin/offer/add')); ?>"> Add Offer</a></li>
            </ul>
        </div>
    </div> 
    <div class="demo-html datablk">
        <table id="fedata" class="display" style="width:100%">
            <thead>
                <tr> <th class="sn">S.N.</th>
                    <!-- <th class="vminimum">Products</th> -->
                    <th class="vdiscount">Offer Code</th>
                    <th class="vcoupons">Offer Discount Amount</th>
                    <th class="vstartdate">Offer Discount %</th>


                    <th class="vaction">Action</th>
                </tr>
            </thead>
            <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tbody>
                <tr> 
                     <td class="sn"><?php echo e($key+1); ?></td>
                     <!-- <?php $__currentLoopData = explode('/',$item->product); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e($itemProduct); ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
                    <!-- <td><?php echo e($item->en_name); ?></td> -->
                    <td><?php echo e($item->offer_code); ?></td>
                    <td><?php echo e($item->discount_amount); ?></td>
                    <td><?php echo e($item->discount_percent); ?>%</td>

                    <td class="act">
                    <!-- <span><a href="#"><img src="<?php echo e(asset('assets/img/icon-feather-eye.png')); ?>" alt="View"></a></span> -->
                    <span><a href="<?php echo e(url('admin/offer/delete',[$item->id])); ?>"><img src="<?php echo e(asset('assets/img/icon-material-delete.png')); ?>" alt="Delete"></a></span>
                    <span><a href="<?php echo e(url('admin/offer/edit',[$item->id])); ?>"><img src="<?php echo e(asset('assets/img/icon-material-edit.png')); ?>" alt="Edit"></a></span>
                    </td>
                </tr>
            
            </tbody>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_master_after_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/offer/index.blade.php ENDPATH**/ ?>