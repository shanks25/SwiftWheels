<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link rel="shortcut icon" href="<?php echo e(Setting::get('site_favicon', asset('favicon.ico'))); ?>" type="image/x-icon">
    <link rel="icon" href="<?php echo e(Setting::get('site_favicon', asset('favicon.ico'))); ?>" type="image/x-icon">

    <title><?php echo $__env->yieldContent('title'); ?><?php echo e(Setting::get('site_title', 'Tranxit')); ?></title>
    <link rel="shortcut icon" type="image/png" href="<?php echo e(Setting::get('site_icon')); ?>"/>
    

    <!-- Styles -->
    <link href="<?php echo e(asset('asset/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('asset/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('asset/css/slick.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('asset/css/slick-theme.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('asset/css/rating.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('asset/css/dashboard-style.css')); ?>" rel="stylesheet" type="text/css">
    <?php echo $__env->yieldContent('styles'); ?>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    
    <div id="wrapper">
        <div class="overlay" id="overlayer" data-toggle="offcanvas"></div>
        <?php echo $__env->make('provider.layout.partials.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div id="page-content-wrapper">
            <?php echo $__env->make('provider.layout.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="page-content">
                <div class="pro-dashboard">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
                <?php echo $__env->make('provider.layout.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
    </div>

    <div id="modal-incoming"></div>

    <!-- Scripts -->
    <script type="text/javascript" src="<?php echo e(asset('asset/js/jquery.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('asset/js/bootstrap.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('asset/js/jquery.mousewheel.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('asset/js/jquery-migrate-1.2.1.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('asset/js/slick.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('asset/js/rating.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('asset/js/dashboard-scripts.js')); ?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.3.1/react.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.3.1/react-dom.js"></script>
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>

    <script type="text/babel" src="<?php echo e(asset('asset/js/incoming.js')); ?>"></script>
    <script type="text/javascript">
        // $.incoming({
        //     'url': '<?php echo e(route('provider.incoming')); ?>',
        //     'modal': '#modal-incoming'
        // });
    </script>

    <?php echo $__env->yieldContent('scripts'); ?>
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

</body>
</html>