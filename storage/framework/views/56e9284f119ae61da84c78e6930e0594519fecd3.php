<?php $__env->startSection('content'); ?>
<div class="col-md-12">
    <a class="log-blk-btn" href="<?php echo e(url('/provider/register')); ?>">CREATE NEW ACCOUNT</a>
    <h3>Sign In</h3>
</div>

<div class="col-md-12">
    <form role="form" method="POST" action="<?php echo e(url('/provider/login')); ?>">
        <?php echo e(csrf_field()); ?>


        <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" placeholder="Email" autofocus>

        <?php if($errors->has('email')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('email')); ?></strong>
            </span>
        <?php endif; ?>

        <input id="password" type="password" class="form-control" name="password" placeholder="Password">

        <?php if($errors->has('password')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('password')); ?></strong>
            </span>
        <?php endif; ?>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember">Remember Me
            </label>
        </div>

        <br>

        <button type="submit" class="log-teal-btn">
            Login
        </button>

        <p class="helper"><a href="<?php echo e(url('/provider/password/reset')); ?>">Forgot Your Password?</a></p>   
    </form>
    <?php if(Setting::get('social_login', 0) == 1): ?>
    <div class="col-md-12">
        <a href="<?php echo e(url('provider/auth/facebook')); ?>"><button type="submit" class="log-teal-btn fb"><i class="fa fa-facebook"></i>LOGIN WITH FACEBOOK</button></a>
    </div>  
    <!-- <div class="col-md-12">
        <a href="<?php echo e(url('provider/auth/google')); ?>"><button type="submit" class="log-teal-btn gp"><i class="fa fa-google-plus"></i>LOGIN WITH GOOGLE+</button></a>
    </div> -->
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('provider.layout.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>