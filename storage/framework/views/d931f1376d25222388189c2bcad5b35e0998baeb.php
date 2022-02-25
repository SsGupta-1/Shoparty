<?php $__env->startSection('content'); ?>
<div class="split right">
	<div class="divin">
		<div class="divinner">
			<div class="logoblk"><img src="<?php echo e(asset('assets/img/logo.png')); ?>" alt="Shoparty Logo"></div>
			<div class="bodyblk">
				<form method="post" action="<?php echo e(url('admin/change-password')); ?>" autocomplete="off" id="resetPasswordForm">
                    <?php echo csrf_field(); ?>
					<div class="poptxt">Create New Password?</div>
					<div class="popsimpletxt">New password</div>    	
					<div class="frmblk"><input type="password" class="form-control" name="new_password"></div>
					<div class="popsimpletxt">Confirm Password</div>
					<div class="frmblk"><input type="password" class="form-control" name="confirm_password"> 
					</div>
					<div class="poptxtlink">&nbsp;</div>
					<input type="hidden" name="email" id="email" value="<?php echo e(Session::get('session_email')); ?>">
					<input type="hidden" name="user_id" id="user_id" value="<?php echo e(Session::get('user_id')); ?>">
					<a role="button" class="criblk" onclick="adminResetPasswordForm(this, event);"><img src="<?php echo e(asset('assets/img/right-circle.svg')); ?>" alt="Shoparty Logo"></a>
				</form>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_master_before_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/auth/resetpassword.blade.php ENDPATH**/ ?>