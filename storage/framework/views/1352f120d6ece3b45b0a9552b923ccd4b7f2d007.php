<?php $__env->startSection('content'); ?>
<h1>View User</h1>

<div class="datablk mtop">
	<ul class="userinfon">
		<li class="setw1">Name <span><?php echo e($user['name']); ?></span></li>
		<li>Email Id<span><?php echo e($user['email']); ?></span></li>
		<li class="setw3">Mobile Number<span><?php echo e($user['mobile']); ?></span></li>
		<li class="setw4">
			Address
			<span class="mofy">
				<div class="mainb">
				<div class="inmainb">Country: <strong><?php echo e((!empty($address)) ? $address['country_name'] : ''); ?></strong></div>
				<div class="inmainb">City: <strong><?php echo e((!empty($address)) ? $address['city'] : ''); ?></strong></div>
				<div class="inmainb">Street: <strong><?php echo e((!empty($address)) ? $address['street_no'] : ''); ?></strong></div>
				<div class="inmainb">House Number: <strong><?php echo e((!empty($address)) ? $address['building_no'] : ''); ?></strong></div>
				</div>
			</span>
		</li>
	</ul>

	<div class="backblk">
		<ul class="userinfo">
			<li>Gender <span><?php echo e($user['gender']); ?></span></li>
			<li>Date of Birth <span><?php echo e($user['dob']); ?></span></li>
		</ul>
	</div>
</div>

<div style="margin-top: 30px;">
	<a href="<?php echo e(url('admin/users')); ?>" class="btn btn-secondary">Back</a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_master_after_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/user/view.blade.php ENDPATH**/ ?>