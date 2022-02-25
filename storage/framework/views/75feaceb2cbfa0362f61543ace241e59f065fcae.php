<?php $__env->startSection('content'); ?>
<div class="split right">
   <div class="divin">
      <div class="divinner">
         <div class="logoblk"><img src="<?php echo e(asset('assets/img/logo.png')); ?>" alt="Shoparty Logo"></div>
         <div class="bodyblk">
            <form method="post" action="<?php echo e(url('admin/login')); ?>" autocomplete="off" id="adminLoginForm">
               <?php echo csrf_field(); ?>
               <div class="poptxt">Sign In</div>
               <div class="popsimpletxt">Email</div>
               <div class="frmblk"><input type="text" class="form-control" name="email" placeholder="Email Id"></div>
               <div class="popsimpletxt">Password</div>
               <div class="frmblk">
                  <input type="password" class="form-control" name="password" placeholder="Password">
               </div>
               <div class="poptxtlink"><a href="<?php echo e(url('admin/forgot-password')); ?>">Forgot Password?</a></div>
               <a role="button" class="criblk" onclick="adminLoginForm(this, event);"><img src="<?php echo e(asset('assets/img/right-circle.svg')); ?>" alt="Shoparty Logo"></a>
            </form>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_master_before_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>