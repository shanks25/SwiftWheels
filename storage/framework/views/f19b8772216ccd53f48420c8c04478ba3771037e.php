<?php $__env->startSection('title', 'Dashboard '); ?>

<?php $__env->startSection('content'); ?>

<div class="col-md-9">
    <div class="dash-content">
        <div class="row no-margin">
            <div class="col-md-12">
                <h4 class="page-title"><?php echo app('translator')->get('user.ride.ride_now'); ?></h4>
            </div>
        </div>
        <?php echo $__env->make('common.notify', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="row no-margin">
            <div class="col-md-6">
                <form action="<?php echo e(url('confirm/ride')); ?>" method="GET" onkeypress="return disableEnterKey(event);">
                    <div class="input-group dash-form">
                        <input type="text" class="form-control" id="origin-input" name="s_address"  placeholder="Enter pickup location">
                    </div>

                    <div class="input-group dash-form">
                        <input type="text" class="form-control" id="destination-input" name="d_address"  placeholder="Enter drop location" >
                    </div>

                    <input type="hidden" name="s_latitude" id="origin_latitude">
                    <input type="hidden" name="s_longitude" id="origin_longitude">
                    <input type="hidden" name="d_latitude" id="destination_latitude">
                    <input type="hidden" name="d_longitude" id="destination_longitude">
                    <input type="hidden" name="current_longitude" id="long">
                    <input type="hidden" name="current_latitude" id="lat">

                    <div class="car-detail">

                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <div class="car-radio">
                            <input type="radio" 
                                name="service_type"
                                value="<?php echo e($service->id); ?>"
                                id="service_<?php echo e($service->id); ?>"
                                <?php if($loop->first): ?> checked="checked" <?php endif; ?>>
                            <label for="service_<?php echo e($service->id); ?>">
                                <div class="car-radio-inner">
                                    <div class="img"><img src="<?php echo e(image($service->image)); ?>"></div>
                                    <div class="name"><span><?php echo e($service->name); ?></span></div>
                                </div>
                            </label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>


                    </div>

                    <button type="submit"  class="full-primary-btn fare-btn"><?php echo app('translator')->get('user.ride.ride_now'); ?></button>

                </form>
            </div>

            <div class="col-md-6">
                <div class="map-responsive">
                    <div id="map" style="width: 100%; height: 450px;"></div>
                </div> 
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>    
<script type="text/javascript">
    var current_latitude = 13.0574400;
    var current_longitude = 80.2482605;
</script>

<script type="text/javascript">
    if( navigator.geolocation ) {
       navigator.geolocation.getCurrentPosition( success, fail );
    } else {
        console.log('Sorry, your browser does not support geolocation services');
        initMap();
    }

    function success(position)
    {
        document.getElementById('long').value = position.coords.longitude;
        document.getElementById('lat').value = position.coords.latitude

        if(position.coords.longitude != "" && position.coords.latitude != ""){
            current_longitude = position.coords.longitude;
            current_latitude = position.coords.latitude;
        }
        initMap();
    }

    function fail()
    {
        // Could not obtain location
        console.log('unable to get your location');
        initMap();
    }
</script> 

<script type="text/javascript" src="<?php echo e(asset('asset/js/map.js')); ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDkKetQwosod2SZ7ZGCpxuJdxY3kxo5Po&libraries=places&callback=initMap" async defer></script>

<script type="text/javascript">
    function disableEnterKey(e)
    {
        var key;
        if(window.e)
            key = window.e.keyCode; // IE
        else
            key = e.which; // Firefox

        if(key == 13)
            return e.preventDefault();
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>