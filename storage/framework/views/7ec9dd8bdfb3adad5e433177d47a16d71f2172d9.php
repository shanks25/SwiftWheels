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
                            <h3>Enter your Received Otp Here</h3>
                            <?php if(session()->has('message')): ?>
<p class="alert alert-success"><?php echo e(session('message')); ?> </p>
<?php endif; ?>
                            <?php if($errors->any()): ?>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <h4 class="alert alert-danger">  <?php echo e($error); ?></h4>  
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            <?php endif; ?>
                        </div>
                        

                        <form role="form" method="POST" action="<?php echo e(url('/verifyOtp')); ?>">

                            <input type="hidden" id="otp_check_id" value="<?php echo e(session()->get('id')['id']); ?>" name="check_id">

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

                        <form role="form" method="get" action="<?php echo e(url('/resenduserotp')); ?>">
                            <?php echo e(csrf_field()); ?>

                  <div class="col-md-12" style="padding-bottom: 10px;" id="mobile_verfication_div">
                                <input type="submit" class="small" style="color: " 
                                value="Resend Otp"/>
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


    <?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        $('.checkbox-inline').on('change', function () {
            $('.checkbox-inline').not(this).prop('checked', false);
        });
    </script>
    
    <script>
                // phone form submission handler
                function smsLogin() {
                    var phoneNumber = document.getElementById("phone_number").value;
                    var phoneNumberBack = document.getElementById("phone_number_back").value;

                    $('#mobile_verfication').html("<p class='helper'> Please Wait... </p>");
                    $('#phone_number').attr('readonly', true);

                    var buttonVal = $('#mobile_verfication').val();

                    if (buttonVal === 'Verify Otp') {

                        verifyOtp(phoneNumberBack)

                    } else {

                        $('#phone_number_back').val(phoneNumber);


                        $.post("<?php echo e(route('send_otp')); ?>", {mobile: phoneNumber}, function (data) {
                            $('#otp_check_id').val(data.id);
                            if (data.id === '') {
                                $('#verification_status').html("<p class='helper'> * Authentication Failed </p>");
                                $('#mobile_verfication').html("Resend Otp");
                                $('#phone_number').attr('readonly', true);
                            } else {
                                $('#verification_status').html("<p class='helper'>* OTP Sent.</p>");
                                $('#phone_number').text("value", "");
                                $('#phone_number').attr('placeholder', "Enter Otp Number");
                                $('#phone_number').attr('readonly', false);
                                $('#mobile_verfication').val("");
                            }
                        });
                    }

                    // AccountKit.login(
                    //     'PHONE',
                    //     {countryCode: countryCode, phoneNumber: phoneNumber}, // will use default values if not specified
                    //     loginCallback
                    // );
                }

                function verifyOtp(phone) {

                    var phoneNumber = $('#phone_number').val();
                    var check_id = $('#otp_check_id').val();

                    $.post("<?php echo e(route('check_otp')); ?>", {
                        mobile: phone,
                        check_id: check_id,
                        otp: phoneNumber
                    }, function (data) {
                        $('#otp_check_id').val(data.id);
                        if (data.success === '') {
                            $('#verification_status').html("<p class='helper'>* OTP Not Match.</p>");
                            $('#phone_number').text("value", phone);
                            $('#phone_number').attr("readonly", false);
                            $('#phone_number').attr('placeholder', "Enter Otp");
                            $('#mobile_verfication').val("Verify Otp");
                        } else {
                            $('#verification_status').html("<p class='helper'> * Phone Number Verified </p>");
                            $('#mobile_verfication_div').html("");
                            $('#phone_number').attr('placeholder', phone);
                            $('#phone_number').val(phone);
                            $('#phone_number').attr('readonly', true);
                            $('#second_step').fadeIn(400);
                        }
                    });

                }

            </script>

            <?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>