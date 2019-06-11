<?php $__env->startSection('content'); ?>
    <div class="banner row no-margin" style="background-image: url('<?php echo e(asset('asset/img/banner-bg.jpg')); ?>');">
        <div class="banner-overlay"></div>
        <div class="container">
            <div class="col-md-8">
                <h2 class="banner-head"><span class="strong">Get there</span><br>Your day belongs to you</h2>
            </div>
            <div class="col-md-4">
                <div class="banner-form">
                    <div class="row no-margin fields">
                        <div class="left">
                            <img src="<?php echo e(asset('asset/img/ride-form-icon.png')); ?>">
                        </div>
                        <div class="right">
                            <a href="<?php echo e(url('register')); ?>">
                                <h3>Sign up to Ride</h3>
                                <h5>SIGN UP <i class="fa fa-chevron-right"></i></h5>
                            </a>
                        </div>
                    </div>
                    <div class="row no-margin fields">
                        <div class="left">
                            <img src="<?php echo e(asset('asset/img/ride-form-icon.png')); ?>">
                        </div>
                        <div class="right">
                            <a href="<?php echo e(url('/provider/register')); ?>">
                                <h3>Sign up to Drive</h3>
                                <h5>SIGN UP <i class="fa fa-chevron-right"></i></h5>
                            </a>
                        </div>
                    </div>  
                    <p class="note-or">Or <a href="<?php echo e(url('/provider/login')); ?>">sign in</a> with your rider account.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row white-section no-margin">
        <div class="container">
            <div class="col-md-6 img-block text-center">
                <img src="<?php echo e(asset('asset/img/tap.png')); ?>">
            </div>
            <div class="col-md-6 content-block">
                <h2>Easy And Flexible</h2>
                <div class="title-divider"></div>
                <p><?php echo e(Setting::get('site_title', 'Tranxit')); ?> is the smartest way to get around. One tap and a car
                    comes directly to you. Your driver knows exactly where to go. And you can pay with either cash or
                    card.</p>
                <a class="content-more" href="#">MORE REASONS TO RIDE <i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row gray-section no-margin">
        <div class="container">
            <div class="col-md-6 content-block">
                <h2>Affiliate Loyalty</h2>
                <div class="title-divider"></div>
                <p> We reward highly rated affiliates (drivers) 
with SSNIT and health incentives over a 
period of time.</p>
                <a class="content-more" href="#">MORE REASONS TO RIDE <i class="fa fa-chevron-right"></i></a>
            </div>
            <div class="col-md-6 img-block text-center">
                <img src="<?php echo e(asset('asset/img/anywhere.png')); ?>">
            </div>
        </div>
    </div>

    <div class="row white-section no-margin">
        <div class="container">
            <div class="col-md-6 img-block text-center">
                <img src="<?php echo e(asset('asset/img/low-cost.png')); ?>">
            </div>
            <div class="col-md-6 content-block">
                <h2>Cool On The Pocket</h2>
                <div class="title-divider"></div>
                <p> Unlimited discounted charges 
available for cashless payments, 
upfront bookings, loyal riders etc.

</p>
                <a class="content-more" href="#">MORE REASONS TO RIDE <i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row gray-section no-margin full-section">
        <div class="container">
            <div class="col-md-6 content-block">
                <h3>Behind the Wheel</h3>
                <h2>They’re people like you, going your way</h2>
                <div class="title-divider"></div>
                <p>What makes the <?php echo e(Setting::get('site_title', 'Tranxit')); ?> experience truly great are the people
                    behind the wheel. They are mothers and fathers. Students and teachers. Veterans. Neighbors. Friends.
                    Our partners drive their own cars—on their own schedule—in cities big and small. Which is why more
                    than one million people worldwide have signed up to drive.</p>
                <a class="content-more-btn" href="#">WHY DRIVE WITH <?php echo e(Setting::get('site_title', 'Tranxit')); ?> <i
                            class="fa fa-chevron-right"></i></a>
            </div>
            <div class="col-md-6 full-img text-center"
                 style="background-image: url(<?php echo e(asset('asset/img/behind-the-wheel.jpg')); ?>);">
                <!-- <img src="img/anywhere.png"> -->
            </div>
        </div>
    </div>

    <div class="row white-section no-margin">
        <div class="container">
            <div class="col-md-6 img-block text-center">
                <img src="<?php echo e(asset('asset/img/low-cost.png')); ?>">
            </div>
            <div class="col-md-6 content-block">
                <h2>Helping Cities For the good of all</h2>
                <div class="title-divider"></div>
                <p>A city with <?php echo e(Setting::get('site_title', 'Tranxit')); ?> has more economic opportunities for
                    residents, professional drivers, and better access to transportation for those without
                    it.</p>
                <a class="content-more" href="#">OUR LOCAL IMPACT <i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row gray-section no-margin">
        <div class="container">
            <div class="col-md-6 content-block">
                <h2>Safety Putting people first</h2>
                <div class="title-divider"></div>
                <p>Whether riding in the backseat or driving up front, every part of
                    the <?php echo e(Setting::get('site_title', 'Tranxit')); ?> experience has been designed around your safety and
                    security.</p>
                <a class="content-more" href="#">HOW WE KEEP YOU SAFE <i class="fa fa-chevron-right"></i></a>
            </div>
            <div class="col-md-6 img-block text-center">
                <img src="<?php echo e(asset('kaliporgi.jpg')); ?>">
            </div>
        </div>
    </div>

    <div class="row find-city no-margin">
        <div class="container">
            <h2><?php echo e(Setting::get('site_title','Tranxit')); ?> is in Ghana.</h2>
            <form>
                <div class="input-group find-form">
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-addon">
                    <button type="submit">
                        <i class="fa fa-arrow-right"></i>
                    </button>  
                </span>
                </div>
            </form>
        </div>
    </div>

    <div class="footer-city row no-margin"
         style="background-image: url(<?php echo e(asset('asset/img/footer-city.png')); ?>);"></div>
         <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5c3f0729ab5284048d0d3289/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>