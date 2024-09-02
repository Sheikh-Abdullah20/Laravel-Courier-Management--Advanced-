

<?php $__env->startSection('title'); ?>
Reports
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title">Reports</h2>
        </div>
    </div>
    <hr>
    <div class="row">
       <?php if($shipments->isNotEmpty() && !empty($date) || !empty($city)): ?>
        <div class="col-md-4">
        <form action="<?php echo e(route('report.index')); ?>" method="GET">
            <input type="hidden" value="<?php echo e($date); ?>" name="date">
            <input type="hidden" value="<?php echo e($city); ?>" name="city">
            <button type="submit" class="btn btn-dark" name="download">Download Report<i
                class="icon material-icons md-get_app"></i></button>
        </form>
        </div>

    <?php endif; ?>
    <div class="col-md-8 ">
        <form action="<?php echo e(route('report.index')); ?>" method="GET" class="d-flex justify-content-end mb-4">
        <input type="date" class="form-control w-25 mx-2" name="date">
            <select class="form-select w-25" name="city">
                <option value="" hidden>Select City</option>
                <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($agent->city); ?>"><?php echo e($agent->city); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        <button type="submit" class="btn btn-dark mx-2">Search</button>
    </form>

    </div>
   </div>

   <?php if(empty($date) && empty($city)): ?>
   <div class="row">
    <div class="col-md-12">
        <div class="alert alert-primary"> Search Shipments Report</div>
    </div>
   </div>
   <?php elseif($shipments->isEmpty()): ?>
   <div class="row">
    <div class="col-md-12">
        <div class="alert alert-primary">No Shipment Found <?php echo e($date ? ' Date: ' .  $date : ''); ?> <br> <?php echo e($city ? ' City : ' . $city : ''); ?> </div>
    </div>
   </div>
   
   <?php else: ?>
   <div class="row">
    <div class="col-md-12 d-flex justify-content-end ">
        <p>Total Shipments Found: <b><?php echo e($total_shipments); ?></b> </p>
    </div>
   </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-stripped text-center">
                        <thead>
                            <tr>
                            <th>Tracking Number</th>
                            <th>Agent Name</th>
                            <th>Agent Branch</th>
                            <th>Agent City</th>
                            <th>Shipping Date</th>
                            <th>Sender Name</th>
                            <th>Receiver Name</th>
                            <th>Approval Status</th>
                            <th>Shipment Status</th>
                            <th>Payment Method</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <?php $__currentLoopData = $shipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tbody>
                            <tr>
                                <td><?php echo e($shipment->tracking_number); ?></td>
                                <td><?php echo e($shipment->agent_name); ?></td>
                                <td><?php echo e($shipment->agent->branch); ?></td>
                                <td><?php echo e($shipment->agent->city); ?></td>
                                <td><?php echo e($shipment->shipping_date); ?></td>
                                <td><?php echo e($shipment->sender_name); ?></td>
                                <td><?php echo e($shipment->receiver_name); ?></td>
                                <td>
                                <?php if($shipment->status === 'Approved'): ?>
                                <p class="bg-success p-1 text-light rounded"><?php echo e($shipment->status); ?></p>
                                <?php elseif($shipment->status === 'Pending'): ?>
                                <p class="bg-danger p-1 text-light rounded"><?php echo e($shipment->status); ?></p>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($shipment->status_shipment === 'Pending'): ?>
                                <p class="bg-danger p-1 text-light rounded"><?php echo e($shipment->status_shipment); ?></p>
                                <?php elseif($shipment->status_shipment === 'Approved'): ?>
                                <p class="bg-success p-1 text-light rounded"><?php echo e($shipment->status_shipment); ?></p>
                                <?php elseif($shipment->status_shipment === 'On the way'): ?>
                                <p class="bg-primary p-1 text-light rounded"><?php echo e($shipment->status_shipment); ?></p>
                                <?php elseif($shipment->status_shipment === 'Delivered'): ?>
                                <p class="bg-warning p-1 text-light rounded"><?php echo e($shipment->status_shipment); ?></p>
                                <?php else: ?>
                                <p class="bg-secondary p-1 text-light rounded"><?php echo e($shipment->status_shipment); ?></p>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($shipment->payment_method); ?></td>
                            <td><?php echo e($shipment->amount); ?></td>
                            </tr>    
                        </tbody>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>
                </div>
            </div>
            <?php echo e($shipments->links()); ?>

        </div>
    </div>
    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ABDULLAH WORK\ABDULLAH ( ME)\All Projects And Portfolio\Laravel Portfolio Projects\Laravel-Courier-Management (Advanced)\resources\views/reports/index.blade.php ENDPATH**/ ?>