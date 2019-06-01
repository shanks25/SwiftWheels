<?php $__env->startSection('content'); ?>
<br><br><br>
<style>
.corporate {
  background-color: #660066;
}
</style>
<div class="corporate">

    <?php $login_user = asset('asset/img/login-user-bg.jpg'); ?>

    <div class="log-overlay"></div>
    <div class="full-page-bg-inner">
        <div class="row no-margin">
            <div class="col-md-6 log-left">

                <h2>Create your account and get moving in minutes</h2>
                <p>Welcome to <?php echo e(Setting::get('site_title','Tranxit')); ?>, the easiest way to get around at the tap of
                a button.</p>
            </div>

            <div class="col-md-6 log-right">
                <div class="login-box-outer">
                    <div class="login-box row no-margin">
                        <div class="col-md-12">
                            <a class="log-blk-btn" href="<?php echo e(url('login')); ?>">ALREADY HAVE AN ACCOUNT?</a>
                            <h3>Create a New Account</h3>
                            <?php if($errors->any()): ?>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <h4 class="alert alert-danger">  <?php echo e($error); ?></h4>  
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <form role="form" method="POST" action="<?php echo e(route('register')); ?>">

                            <?php echo e(csrf_field()); ?>


                            <div id="second_step">

                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="First Name"
                                    name="first_name" value="<?php echo e(old('first_name')); ?>">

                                    <?php if($errors->has('first_name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('first_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Last Name"
                                    name="last_name"
                                    value="<?php echo e(old('last_name')); ?>">

                                    <?php if($errors->has('last_name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('last_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-12">
                                    <input type="email" class="form-control" name="email"
                                    placeholder="Email Address" value="<?php echo e(old('email')); ?>">

                                    <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="phone_number"
                                    placeholder="phone_number Address" value="<?php echo e(session()->get('id')['phone_number']); ?>" readonly>

                                    <input type="hidden" class="form-control" name="country_code"
                                    placeholder="phone_number Address" value="+91">

                                    <?php if($errors->has('phone_number')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('phone_number')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-12">
                                  <label class="radio-inline"><input type="radio" name="gender" value="MALE" style="width:13px; height:13px;">Male</label>
                                  <label class="radio-inline"><input type="radio" name="gender" value="FEMALE" style="width:13px; height:13px;">Female</label>
                                  <?php if($errors->has('gender')): ?>
                                  <span class="help-block">
                                    <strong><?php echo e($errors->first('gender')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password"
                                placeholder="Password">

                                <?php if($errors->has('password')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-12">
                                <input type="password" placeholder="Re-type Password" class="form-control"
                                name="password_confirmation">

                                <?php if($errors->has('password_confirmation')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-12">
                                <button class="log-teal-btn" type="submit">REGISTER</button>
                            </div>

                        </div>

                    </form>

                    <div class="col-md-12">
                        <p class="helper">Or <a href="<?php echo e(route('login')); ?>">Sign in</a> with your user account.
                        </p>
                    </div>

                </div>


                <div class="log-copy"><p
                    class="no-margin"><?php echo e(Setting::get('site_copyright', '&copy; '.date('Y').' Appoets')); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('user.layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>