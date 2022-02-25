<?php $__env->startSection('content'); ?>
  <h1>Edit Offer</h1>


  <form action="<?php echo e(url('admin/offer/edit',$offer_id)); ?>" method="post" >
        <?php echo csrf_field(); ?>
     <div class="datablk mtop">
        <div class="datainner">	
                    
          <div class="">
              <ul class="frmlist">
                <li class="setmulti"> <span>Select Products</span> 
                   <select name="product[]" multiple="" id="langOpt" class="form-control ">
                        <?php $__currentLoopData = $productlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$prolist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($key); ?>" <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php echo e($itemProduct->product_id == $key ? 'selected' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>>
                            <?php echo e($prolist); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>			 
                </li>
                <li> <span>Offer Code</span> 
                  <div class="prel">
                      <input type="text" class="form-control" name="offer_code" value="<?php echo e($itemProduct->offer_code); ?>" placeholder="Enter Offer Code">
                  </div>
                </li>
                 <li> <span>Offer Discount %</span> 
                  <div class="prel">
                       <input type="text" class="form-control" name="offer_discount" value="<?php echo e($itemProduct->discount_percent); ?>" placeholder="Enter Offer Discount %">						
                  </div>
                </li>
                  <li> <span>Offer Discount Amount</span> 
                    <div class="prel">
                         <input type="text" class="form-control" name="discount_amount" value="<?php echo e($itemProduct->discount_amount); ?>" placeholder="Enter Offer Amount">
                     </div>
                </li>
              </ul>
          </div>
        
       </div>

    </div>

        <div class="mfooter fbleft">
          <a href="<?php echo e(url('admin/offer')); ?>"> <button type="button" class="btn" data-dismiss="modal">Cancel</button></a>
          <button type="submit" class="btn mbtn">Save</button>
        </div>
   </form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
        <script src="<?php echo e(asset('assets/js/jquery.multiselect.js')); ?>"></script>
    <script type="text/javascript">  
        $(document).ready(function() {
        $('#langOpt').multiselect({
            columns: 1,
            placeholder: 'Select Category', 
            search: true,
            selectAll: true
        });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_master_after_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/offer/edit.blade.php ENDPATH**/ ?>