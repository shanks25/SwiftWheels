<?php $__env->startSection('content'); ?>
    <div class="col-md-12">
        <a class="log-blk-btn" href="<?php echo e(url('/provider/login')); ?>">ALREADY REGISTERED?</a>
        <h3>Sign Up</h3>
                 <?php if($errors->any()): ?>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <h4 class="alert alert-danger">  <?php echo e($error); ?></h4>  
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                <?php endif; ?>
    </div>

    <div class="col-md-12">
        <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('providerregister')); ?>">

            <div id="first_step">
                <div class="col-md-4">
                    <input  type="number" placeholder="+223" id="country_code" name="country_code" value="+223" readonly="" />
                </div>

                <div class="col-md-8">
                    <input type="number" autofocus id="phone_number" class="form-control" placeholder="Enter Phone Number"
                           name="mobile" value="<?php echo e(old('phone_number')); ?>"/ required="">
                </div>

                <div class="col-md-8">
                    <?php if($errors->has('phone_number')): ?>
                        <span class="help-block">
                        <strong><?php echo e($errors->first('phone_number')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="col-md-12" style="padding-bottom: 10px;" id="mobile_verfication">
                    <input type="submit" class="log-teal-btn small"/>
                </div>
            </div>

            <?php echo e(csrf_field()); ?>


            <div id="second_step" style="display: none;">

                <input id="name" type="text" class="form-control" name="first_name" value="<?php echo e(old('first_name')); ?>"
                       placeholder="First Name" autofocus>

                <?php if($errors->has('first_name')): ?>
                    <span class="help-block">
                    <strong><?php echo e($errors->first('first_name')); ?></strong>
                </span>
                <?php endif; ?>

                <input id="name" type="text" class="form-control" name="last_name" value="<?php echo e(old('last_name')); ?>"
                       placeholder="Last Name">

                <?php if($errors->has('last_name')): ?>
                    <span class="help-block">
                    <strong><?php echo e($errors->first('last_name')); ?></strong>
                </span>
                <?php endif; ?>

                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>"
                       placeholder="E-Mail Address">

                <?php if($errors->has('email')): ?>
                    <span class="help-block">
                    <strong><?php echo e($errors->first('email')); ?></strong>
                </span>
                <?php endif; ?>

                <label class="radio-inline"><input type="radio" name="gender" value="MALE" checked>Male</label>
                <label class="radio-inline"><input type="radio" name="gender" value="FEMALE">Female</label>
                <?php if($errors->has('gender')): ?>
                    <span class="help-block">
                    <strong><?php echo e($errors->first('gender')); ?></strong>
                </span>
                <?php endif; ?>

                <input id="password" type="password" class="form-control" name="password" placeholder="Password">

                <?php if($errors->has('password')): ?>
                    <span class="help-block">
                    <strong><?php echo e($errors->first('password')); ?></strong>
                </span>
                <?php endif; ?>

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                       placeholder="Confirm Password">

                <?php if($errors->has('password_confirmation')): ?>
                    <span class="help-block">
                    <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                </span>
                <?php endif; ?>

                <select class="form-control" name="service_type" id="service_type">
                    <option value="">Select Service</option>
                    <?php $__currentLoopData = get_all_service_types(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </select>

                <?php if($errors->has('service_type')): ?>
                    <span class="help-block">
                    <strong><?php echo e($errors->first('service_type')); ?></strong>
                </span>
                <?php endif; ?>

                <input id="service-number" type="text" class="form-control" name="service_number"
                       value="<?php echo e(old('service_number')); ?>" placeholder="Car Number">

                <?php if($errors->has('service_number')): ?>
                    <span class="help-block">
                    <strong><?php echo e($errors->first('service_number')); ?></strong>
                </span>
                <?php endif; ?>

                <input id="service-model" type="text" class="form-control" name="service_model"
                       value="<?php echo e(old('service_model')); ?>" placeholder="Car Model">

                <?php if($errors->has('service_model')): ?>
                    <span class="help-block">
                    <strong><?php echo e($errors->first('service_model')); ?></strong>
                </span>
                <?php endif; ?>

                <button type="submit" class="log-teal-btn">
                    Register
                </button>

            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>


 
<?php echo $__env->make('provider.layout.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>