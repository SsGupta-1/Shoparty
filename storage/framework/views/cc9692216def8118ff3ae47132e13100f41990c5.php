<?php $__env->startSection('content'); ?>
<h1>Add User</h1>

<form method="post" action="<?php echo e(url('admin/user/add')); ?>" autocomplete="off">
    <?php echo csrf_field(); ?>
    <div class="datablk mtop">
        <div class="datainner"> 
            <ul class="frmlist">
                <li> <span>Full Name</span> <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" placeholder="Enter Full Name"></li>
                <li> <span>Email</span> <input type="text" class="form-control" name="email" value="<?php echo e(old('email')); ?>" placeholder="Enter Email"></li>
                <li> <span>Mobile</span> <input type="text" class="form-control" name="mobile" value="<?php echo e(old('mobile')); ?>" placeholder="Enter Mobile"></li>
            </ul>
            <div class="frmshead">Address</div>
            <ul class="frmlist set4">
                <li>
                    <span>Country</span>
                    <select class="form-control" name="country_id" title="Select Country">
                        <option value="">Select Country</option>
                        <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($row['id']); ?>" <?php echo e((old('country_id') == $row['id']) ? 'selected' : ''); ?>><?php echo e($row['country_name']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </li>
                <li> <span>City</span> <input type="text" class="form-control" name="city" value="<?php echo e(old('city')); ?>" placeholder="Enter City"></li>
                <li> <span>Street</span> <input type="text" class="form-control" name="street_no" value="<?php echo e(old('street_no')); ?>" placeholder="Enter Street"></li>
                <li> <span>H. No.</span> <input type="text" class="form-control" name="building_no" value="<?php echo e(old('building_no')); ?>" placeholder="Enter H. No"></li>
            </ul>

            <ul class="frmlist">
                <li>
                    <span>Gender</span>
                    <div class="switch-field">
                        <input type="radio" name="gender" id="radio-one" value="Male" <?php echo e((old('gender')) ? ((old('gender') == 'Male') ? 'checked' : '') : 'checked'); ?> />
                        <label for="radio-one">Male</label>

                        <input type="radio" name="gender" id="radio-two" value="Female" <?php echo e(((old('gender') == 'Female') ? 'checked' : '')); ?> />
                        <label for="radio-two">Female</label>

                        <input type="radio" name="gender" id="radio-three" value="Other" <?php echo e(((old('gender') == 'Other') ? 'checked' : '')); ?> />
                        <label for="radio-three">Other</label>
                    </div> 
                </li>
                <li><span>Date of Birth</span> <input type="date" class="form-control" name="dob" value="<?php echo e(old('dob')); ?>" placeholder="Enter Date"></li>
            </ul>
        </div>

    </div>

    <div class="mfooter fbleft">
        <a href="<?php echo e(url('admin/users')); ?>" class="btn">Cancel</a>
        <button type="submit" class="btn mbtn">Save</button>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_master_after_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/shoparty_backend/resources/views/admin/user/add.blade.php ENDPATH**/ ?>