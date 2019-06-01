<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo e(Setting::get('site_title','Tranxit')); ?> - <?php echo $__env->yieldContent('title'); ?> - User Dashboard</title>
    <link rel="shortcut icon" type="image/png" href="<?php echo e(Setting::get('site_icon')); ?>"/>

    <link href="<?php echo e(asset('asset/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('asset/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('asset/css/slick.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('asset/css/slick-theme.css')); ?>"/>
    <link href="<?php echo e(asset('asset/css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('asset/css/bootstrap-timepicker.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('asset/css/dashboard-style.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body>

    <?php echo $__env->make('user.include.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="page-content dashboard-page">    
        <div class="container">
            
            <?php echo $__env->make('user.include.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->yieldContent('content'); ?>

        </div>
    </div>


    <?php echo $__env->make('user.include.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    <script src="<?php echo e(asset('asset/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/js/bootstrap.min.js')); ?>"></script>       
    <script type="text/javascript" src="<?php echo e(asset('asset/js/jquery.mousewheel.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('asset/js/jquery-migrate-1.2.1.min.js')); ?>"></script> 
    <script type="text/javascript" src="<?php echo e(asset('asset/js/slick.min.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/js/bootstrap-timepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/js/dashboard-scripts.js')); ?>"></script>
    <?php if(Setting::get('demo_mode', 0) == 1): ?>
        <!-- Start of LiveChat (www.livechatinc.com) code -->
        <script type="text/javascript">
            window.__lc = window.__lc || {};
            window.__lc.license = 8256261;
            (function() {
                var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
                lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
            })();
        </script>
        <!-- End of LiveChat code -->
    <?php endif; ?>

    <?php echo $__env->yieldContent('scripts'); ?>
    
</body>
</html>