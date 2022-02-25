<?php $__env->startSection('content'); ?>
    <div class="brandblk toppading">
        <div class="brandleft">
            <h1>Order Management</h1>
        </div>
    </div>

    <div class="demo-html datablk">
        <table id="fedata" class="display" style="width:100%">
            <thead>
                <tr>
                    <th class="ordersn">S.N.</th>
                    <th class="orderid">Order Number</th>
                    <th class="productname">Product Name</th>
                    <th class="ordertime">Order Date</th>
                    <th class="orderstatus">Order Status</th>
                    <th class="orderaction">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="sn"><?php echo e($key+1); ?></td>
                        <td ><?php echo e($row['order_number']); ?></td>
                        <td ><?php echo e($row['en_name']); ?></td>
                        <td ><?php echo e($row['created_at']); ?></td>

                        <td >
                            <select class="form-control searchicon sec2" onchange="updateStatus(this, event, '<?php echo e($row['status_url']); ?>');">
                                <option value="1" <?php echo e(($row['order_status'] == 1) ? 'selected' : ''); ?>>Order Placed</option>
                                <option value="2" <?php echo e(($row['order_status'] == 2) ? 'selected' : ''); ?>>Order Confirmed</option>
                                <option value="3" <?php echo e(($row['order_status'] == 3) ? 'selected' : ''); ?>>Out For Delivery</option>
                                <option value="4" <?php echo e(($row['order_status'] == 4) ? 'selected' : ''); ?>>Order Cancel</option>
                            </select>
                        </td>

                        <td class="orderaction">
                            <!-- <span><a href="<?php echo e(url('admin/order/download/'.$row['id'])); ?>"><img src="<?php echo e(asset('assets/img/downloadbtn.svg')); ?>" alt="Downlaod"></a></span> -->
                            <span><a href="<?php echo e(url('admin/order/view/'.$row['id'])); ?>"><img src="<?php echo e(asset('assets/img/icon-feather-eye.png')); ?>" alt="View"></a></span>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>

        </table>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_master_after_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/orders/index.blade.php ENDPATH**/ ?>