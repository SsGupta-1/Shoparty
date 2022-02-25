<?php $__env->startSection('content'); ?>
    <div class="brandblk toppading">
        <div class="brandleft">
            <h1>Order Details</h1>
        </div>
        <div class="brandright topamr">
            <ul class="brlist">
                <li><a href="<?php echo e(url('admin/orders')); ?>" class="btn">Back</a></li>
            </ul>
        </div>
    </div>

    <div class="datablk orderma">

        <ul class="vieworder">
            <li>
                <div class="sts">User Details</div>
                <div class="sumblknew">
                    <div class="sumtxt">Name <span><?php echo e($user['name']); ?></span></div>
                    <div class="sumtxt">Email <span><?php echo e($user['email']); ?></span></div>
                    <div class="sumtxt">Address <span><?php echo e($user['building_no'].', '.$user['street_no'].', '.$user['city'].', '.$user['country_name']); ?></span></div>
                    <div class="sumtxt">Mobile Number <span><?php echo e($user['mobile']); ?></span></div>
                </div>
            </li>
            <li>
                <div class="sts">Delivery Details</div>
                <div class="sumblknew widthnew">
                    <div class="sumtxt">Name <span><?php echo e($detail[0]['first_name'].' '.$detail[0]['last_name']); ?></span></div>
                    <div class="sumtxt">Email <span><?php echo e($user['email']); ?></span></div>
                    <div class="sumtxt">Address <span><?php echo e($detail[0]['building_no'].', '.$detail[0]['street_no'].', '.$detail[0]['city'].', '.$detail[0]['country_name']); ?></span></div>
                    <div class="sumtxt">&nbsp;</div>
                </div>
            </li>
        </ul>


        <table>
            <tr>
                <th class="sn">S.N.</th>
                <th class="produlist">Product Name</th>
                <th class="qtylist">Quantity</th>
                <th class="sizelist">Size</th>
                <th class="colorlist">Color</th> 
                <th class="amtlist">Amount</th>
            </tr>

            <?php
                $summary = $tax = $coupon = $total = 0;
            ?>
            <?php $__currentLoopData = $detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="sn"><?php echo e($key+1); ?></td>
                    <td><?php echo e($row['en_name']); ?></td>
                    <td><?php echo e($row['quantity']); ?></td>
                    <td><?php echo e($row['product_size']); ?></td>
                    <td></td>
                    <td>$<?php echo e($row['total_amount']); ?></td>
                </tr>
                <?php
                    $summary = $summary + $row['total_amount'];
                    $total = $total + $row['total_amount'];
                ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>

        <div class="rightbl">
            <div class="sumblk">
                <div class="sumtxt">Summary <span>$<?php echo e($summary); ?></span></div>
                <div class="sumtxt">Tax <span>$<?php echo e($tax); ?></span></div>
                <div class="sumtxt">Coupon Amount <span>$<?php echo e($coupon); ?></span></div>
                <div class="sumtxt">Total Amount <span>$<?php echo e($total); ?></span></div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_master_after_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/orders/view.blade.php ENDPATH**/ ?>