<?php $__env->startSection('content'); ?>
<div class="split right">
	<div class="divin">
		<div class="divinner">
			<div class="logoblk"><img src="<?php echo e(asset('assets/img/logo.png')); ?>" alt="Shoparty Logo"></div>
			<div class="bodyblk">
			<div class="criblkthank"><img src="<?php echo e(asset('assets/img/right-circle.svg')); ?>" alt=""></div>	
			<div class="poptxtnew">Password Updated!</div>
			<div class="popnortxt">Your password have been changed successfully. Use your new password to login
			</div>
			<div class="poptxtlink"><a href="<?php echo e(url('admin')); ?>">Login</a></div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_master_before_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/auth/passwordupdated.blade.php ENDPATH**/ ?>