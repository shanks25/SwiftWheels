<?php $__env->startSection('content'); ?>
<div class="pro-dashboard-head">
        <div class="container">
            <a href="<?php echo e(url('provider/earnings')); ?>" class="pro-head-link active">Payment Statements</a>
             <a href="<?php echo e(url('provider/upcoming')); ?>" class="pro-head-link">Upcoming</a>
   <!--         <a href="new-provider-patner-invoices.html" class="pro-head-link">Payment Invoices</a>
            <a href="new-provider-banking.html" class="pro-head-link">Banking</a> -->
        </div>
    </div>

    <div class="pro-dashboard-content">
        <!-- Earning head -->
        <div class="earning-head">
            <div class="container">
                <div class="earning-element">
                    <p class="earning-txt">TOTAL EARNINGS</p>
                    <p class="earning-price" id="set_fully_sum">00.00</p>
                </div>
                <div class="earning-element row no-margin">

                 <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4">
                        <div class="earning-box">
                            <p class="dashboard-count"><?php echo e($today); ?></p>
                            <p class="dashboard-txt">TRIPS COMPLETED TODAY</p>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4">
                        <div class="earning-box">
                            <p class="dashboard-count"><?php echo e(Setting::get('daily_target',0)); ?></p>
                            <p class="dashboard-txt">DAILY TRIP TARGET </p>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4">
                        <div class="earning-box">
                            <p class="dashboard-count"><?php echo e($provider[0]->accepted->count()); ?></p>
                            <p class="dashboard-txt">FULLY COMPLETED TRIPS</p>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4">
                        <div class="earning-box">
                            <p class="dashboard-count">
                            <?php if($provider[0]->accepted->count() != 0): ?>
                                <?php echo e($provider[0]->accepted->count()/$provider[0]->accepted->count()*100); ?>%
                            <?php else: ?>
                            	0%
                            <?php endif; ?>
                            </p>
                            <p class="dashboard-txt">ACCEPTANCE RATE</p>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4">
                        <div class="earning-box">
                            <p class="dashboard-count">
                                <?php echo e($provider[0]->cancelled->count()); ?>

                            </p>
                            <p class="dashboard-txt">DRIVER CANCELLATIONS</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- End of earning head -->

        <!-- Earning Content -->
        <div class="earning-content gray-bg">
            <div class="container">

                <!-- Earning section -->
                <div class="earning-section pad20 row no-margin">
                    <div class="earning-section-head">
                        <h3 class="earning-section-tit">Weekly Earnings</h3>
                    </div>

                    <!-- Earning acc-wrapper -->
                    <div class="col-lg-7 col-md-8 col-sm-10 col-xs-12 no-padding"">
                        <div class="earn-acc-wrapper">
                            <div class="earning-acc pad20">
                                <!-- Earning acc head -->
                                <div class="row no-margin">
                                    <div class="pull-left trip-left">
                                        <h3 data-toggle="collapse" data-target="#demo1" class="accordion-toggle collapsed acc-tit">
                                            <span class="arrow-icon fa fa-chevron-right"></span>Trip Earnings
                                        </h3>
                                    </div>
                                </div>
                                <!-- End of eaning acc head -->
                                <!-- Earning acc body -->
                                <div class="accordian-body earning-acc-body collapse row" id="demo1">
                                    <table class="table table-condensed table-responsive" style="border-collapse:collapse;">
                                        <tbody>
                                        <?php $sum_weekly = 0; ?>
                                        <?php $__currentLoopData = $weekly; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <tr>
                                                <td>
                                                <?php if($day->created_at): ?>
                                                    <?php echo e(date('Y-m-d',strtotime($day->created_at))); ?> - <?php echo e($day->created_at->diffForHumans()); ?>

                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                                </td>
                                                <td class="text-right">
                                                <?php if($day->payment != ""): ?>
                                                <?php echo e(currency($day->payment->provider_pay)); ?>

                                                <?php else: ?>
                                                <?php echo e(currency(0.00)); ?>

                                                <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- End of earning acc-body -->
                            </div>
                            <div class="earning-acc pad20 border-top">
                                <div class="row no-margin">
                                    <div class="pull-left trip-left">
                                        <h3 class="acc-tit estimate-tit">
                                            Estimated Payout
                                        </h3>
                                    </div>

                                    <div class="pull-right trip-right">
                                        <p class="earning-cost no-margin"><?php echo e(currency($weekly_sum)); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of earning acc-wrapper -->
                </div>
                <!-- End of earning section -->

                <!-- Earning section -->
                <div class="earning-section earn-main-sec pad20">
                    <!-- Earning section head -->
                    <div class="earning-section-head row no-margin">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 no-left-padding">
                            <h3 class="earning-section-tit">Daily Earnings</h3>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <div class="daily-earn-right text-right">
                                <div class="status-block display-inline row no-margin">
                                    <form class="form-inline status-form">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select type="password" class="form-control mx-sm-3">
                                                <option>All Trips</option>
                                                <option>Completed</option>
                                                <option>Pending</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <!-- View tab -->

                                <!-- End of view tab -->
                            </div>
                        </div>
                    </div>
                    <!-- End of earning section head -->

                    <!-- Earning-section content -->
                    <div class="tab-content list-content">
                        <div class="list-view pad30 ">

                            <table class="earning-table table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Pickup Time</th>
                                        <th>Booking Id</th>
                                        <th>Vehicle</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>Distance(KM)</th>
                                        <th>Invoice Amount</th>
                                        <th>Cash Collected</th>
                                        <th>Total Earnings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $fully_sum = 0; ?>
                                <?php $__currentLoopData = $fully; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $each): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <tr>
                                        <td><?php echo e(date('Y D, M d - H:i A',strtotime($each->created_at))); ?></td>
                                        <td><?php echo e($each->booking_id); ?></td>
                                        <td>
                                        	<?php if($each->service_type): ?>
                                        		<?php echo e($each->service_type->name); ?>

                                        	<?php endif; ?>
                                        </td>
                                        <td>
                                        	<?php if($each->finished_at != null && $each->started_at != null): ?> 
                                                <?php 
                                                $StartTime = \Carbon\Carbon::parse($each->started_at);
                                                $EndTime = \Carbon\Carbon::parse($each->finished_at);
                                                echo $StartTime->diffInHours($EndTime). " Hours";
                                                echo " ".$StartTime->diffInMinutes($EndTime). " Minutes";
                                                ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($each->status); ?></td>
                                        <td><?php echo e($each->distance); ?>Kms</td>
                                        <td> 
                                            <?php if($day->payment != ""): ?>
                                            <?php echo e(currency($day->payment->total)); ?>

                                            <?php else: ?>
                                            <?php echo e(currency(0.00)); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                        	<?php if($each->payment != ""): ?>
                                        		<?php $each_sum = 0;
                                        		$each_sum = $each->payment->provider_pay;
                                        		$fully_sum += $each_sum;
                                        		?>
                                        		<?php echo e(currency($each_sum)); ?>

                                        	<?php endif; ?>
                                        </td>
                                        <td><?php echo e(currency($fully_sum)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                <!-- End of earning section -->
            </div>
        </div>
        <!-- Endd of earning content -->
    </div>                
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
	document.getElementById('set_fully_sum').textContent = "<?php echo e(currency($fully_sum)); ?>";
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('provider.layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>