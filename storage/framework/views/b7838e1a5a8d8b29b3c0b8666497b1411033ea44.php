<?php $__env->startSection('content'); ?>
<div class="split right">
    <div class="divin">
        <div class="divinner">
            <div class="logoblk"><img src="<?php echo e(asset('assets/img/logo.png')); ?>" alt="Shoparty Logo"></div>
            <div class="bodyblk">
                <div class="poptxt">Forgot Password? 
                </div>
                <div class="popsubtxt">Please enter the verification code sent to <?php echo e(Session::get('session_email')); ?>


                </div>
                <form method="post" action="<?php echo e(url('admin/verify-otp')); ?>" autocomplete="off" id="verifyPasswordForm">
                    <?php echo csrf_field(); ?>
                    <div class="form-group d-flex otp text-center otpInput justify-content-center mb-4">
                        <input type="text" class="form-control" name="otp[]" maxlength="1">
                        <input type="text" class="form-control" name="otp[]" maxlength="1">
                        <input type="text" class="form-control" name="otp[]" maxlength="1">
                        <input type="text" class="form-control" name="otp[]" maxlength="1">
                        <input type="hidden" name="email" id="email" value="<?php echo e(Session::get('session_email')); ?>">
                    </div>
                    <div class="poptxtlink"><a href="<?php echo e(url('admin/resend-otp')); ?>">Resend OTP</a></div>
                    <a role="button" class="criblk" onclick="adminVerifyPasswordForm(this, event);"><img src="<?php echo e(asset('assets/img/right-circle.svg')); ?>" alt="Shoparty Logo"></a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_master_before_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/auth/forgototp.blade.php ENDPATH**/ ?>