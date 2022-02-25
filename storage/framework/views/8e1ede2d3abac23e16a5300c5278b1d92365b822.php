<?php $__env->startSection('content'); ?>

  <div>
      <form action="<?php echo e(url('admin/homepage/edit/'.$data['id'])); ?> " enctype="multipart/form-data" method="post">
     <?php echo csrf_field(); ?>
      <label for="id">id</label>
  <input readonly value="<?php echo e($data->id); ?> "></br>
     <label for="image">Image</label>
  <img src="<?php echo e(asset('uploads/banners/'.$data->banner_image)); ?>"   style="height:100px; width:80px; "></br>
  <label for="change-image"> Change image</label>
  <input type="file" name="image" id="image" >
  <button type="submit"> submit</button>
  

  </form>
  
  </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_master_after_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/homepage/edit.blade.php ENDPATH**/ ?>