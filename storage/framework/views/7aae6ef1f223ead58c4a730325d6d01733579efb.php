<?php $__env->startSection('content'); ?>
    <div class="col-md-12">
        <a class="log-blk-btn" href="<?php echo e(url('/provider/login')); ?>">ALREADY REGISTERED?</a>
           <h3>Enter your Received Otp Here</h3>
             <?php if($errors->any()): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
    <h4 class="alert alert-danger">  <?php echo e($error); ?></h4>  
    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    <?php endif; ?>
    <?php if(session()->has('message')): ?>
<p class="alert alert-success"><?php echo e(session('message')); ?> </p>
<?php endif; ?>
    </div>

   
        <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('providerverifyOtp')); ?>">

                               <input type="hidden" id="otp_check_id" value="<?php echo e(session()->get('providerid')['id']); ?>" name="check_id">

                            <div id="first_step">

                                <div class="col-md-12">
                                    <input type="hidden" autofocus id="phone_number_back" class="form-control"
                                    name="phone_number_back"
                                    value="<?php echo e(old('phone_number')); ?>"/>
                                </div>

                                <div class="col-md-12">
                                    <input type="text" autofocus id="phone_number" class="form-control"
                                    placeholder="Enter Otp Number" name="otp"
                                    value="<?php echo e(old('phone_number')); ?>"/>
                                </div>

                                <div class="col-md-8">
                                    <?php if($errors->has('phone_number')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('phone_number')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-12" id="verification_status"></div>

                                <div class="col-md-12" style="padding-bottom: 10px;" id="mobile_verfication_div">
                                    <input type="submit" class="log-teal-btn small" id="mobile_verfication"
                                    onclick="smsLogin();"
                                    value="Verify Phone Number"/>
                                </div>

                            </div>
            <?php echo e(csrf_field()); ?>

 
        </form>
  <form role="form" method="get" action="<?php echo e(url('/resendproviderotp')); ?>">
                            <?php echo e(csrf_field()); ?>

                  <div class="col-md-12" style="padding-bottom: 10px;" id="mobile_verfication_div">
                                <input type="submit" class="small" style="color: " 
                                value="Resend Otp"/>
                            </div>
                        </form>
<?php $__env->stopSection(); ?>


 
<?php echo $__env->make('provider.layout.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>