

<?php $__env->startSection('title'); ?>
Shipments - View
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<section class="content-main">
    <div class="content-header justify-content-end">

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create shipments')): ?>
        <div>
            <a href="<?php echo e(route('shipment.create')); ?>" class="btn btn-dark">Create Shipment</a>
        </div>
        <?php endif; ?>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view riders')): ?>
                    <div class="row my-2">
                        <div class="col-md-12">
                            <h2>Riders</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <?php $count = 0; ?>
                                <table class="table table-striped text-center">
                                    <thead>
                                        <tr>
                                            <?php if(auth()->user()->hasPermissionTo('print')): ?>
                                            <th>Select Rider</th>
                                            <?php elseif(auth()->user()->hasRole('admin')): ?>
                                            <th>Select Rider</th>
                                            <?php endif; ?>
                                            <th>Rider ID</th>
                                            <th>Rider Name</th>
                                            <th>Rider Phone</th>
                                            <th>Rider Cnic</th>
                                            <th>Rider Bike_No</th>
                                            <th>Rider Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <form id="rider-form" action="<?php echo e(route('shipment.index')); ?>" method="GET">
                                            <?php echo csrf_field(); ?>
                                            <?php $__currentLoopData = $riders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <?php $count++; ?>
                                                <?php if(auth()->user()->hasPermissionTo('print') ||
                                                auth()->user()->hasRole('admin')): ?>
                                                <td>
                                                    <input type="radio" value="<?php echo e($rider->id); ?>" name="rider"
                                                        id="rider">
                                                </td>
                                                <?php endif; ?>
                                                <td><?php echo e($count); ?></td>
                                                <td><?php echo e($rider->name); ?></td>
                                                <td><?php echo e($rider->phone); ?></td>
                                                <td><?php echo e($rider->rider_cnic); ?></td>
                                                <td><?php echo e($rider->bike_no); ?></td>
                                                <td><?php echo e($rider->address); ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </form>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div>
                        <h2 class="content-title my-5">Shipments - View</h2>
                    </div>
                    <div class="row my-5">
                        <div class="col-md-12">
                            <form action="<?php echo e(route('shipment.index')); ?>" method="GET" class="d-flex w-75 m-auto">
                                <?php echo csrf_field(); ?>

                                <input type="search" class="form-control " placeholder="Tracking Number"
                                    name="search_tracking_number">

                                <?php if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('agent')): ?>
                                <select name="agents" id="agents" class="form-select mx-3">
                                    <option value="" hidden>Choose Agent</option>
                                    <option value="">All</option>
                                    <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($agent->name); ?>"><?php echo e($agent->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php endif; ?>

                                <select name="status" id="status" class="form-select mx-2">
                                    <option value="" hidden>Choose Status</option>
                                    <?php $__currentLoopData = $statuss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($status->status_name); ?>"><?php echo e($status->status_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                                <button type="submit" class="btn btn-dark">Filter</button>
                            </form>
                        </div>
                    </div>
                    <?php if($shipments->isEmpty()): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                                No shipments found
                            </div>
                        </div>
                    </div>

                    <?php else: ?>
                    <form id="form" action="<?php echo e(route('shipment.index')); ?>" method="GET">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-end">
                                <input type="hidden" name="action" id="form-action" value="">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print')): ?>
                                <button type="button" onclick="submit_form('print')" class="btn btn-success mx-1"><i
                                        class="icon material-icons md-print"></i></button>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete shipments')): ?>
                                <button type="button" onclick="submit_form('delete') " class="btn btn-danger mx-2"><i
                                        class="icon material-icons md-delete"></i></button>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('download reports')): ?>
                                <a href="<?php echo e(route('download_shipment')); ?>" class="btn btn-secondary"><i
                                        class="icon material-icons md-get_app"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="shipmentTable" class="table table-bordered  table-striped text-center">
                                <thead>
                                    <tr>
                                        <?php if(auth()->user()->hasPermissionTo('delete agents') ||
                                        auth()->user()->hasPermissionTo('print')): ?>
                                        <th>Select</th>
                                        <?php elseif(auth()->user()->hasRole('admin')): ?>
                                        <th>Select</th>
                                        <?php endif; ?>

                                        <th>Order Tracking</th>
                                        <th>Agent</th>
                                        <th>Sender Name</th>
                                        <th>Receiver Name</th>
                                        <th>Order Number</th>
                                        <th>Shipping Date</th>
                                        <?php if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('agent')): ?>
                                        <th>Status</th>
                                        <?php endif; ?>
                                        <th>Shipment_Status</th>
                                        <?php if(auth()->user()->hasRole('user')): ?>
                                        <th>Amount</th>
                                        <?php endif; ?>
                                        <?php if(auth()->user()->hasPermissionTo('edit shipments') ||
                                        auth()->user()->hasPermissionTo('show shipments')): ?>
                                        <th>Actions</th>
                                        <?php elseif(auth()->user()->hasPermissionTo('delete shipments') ||
                                        auth()->user()->hasRole('admin')): ?>
                                        <th>Actions</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $shipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if(auth()->user()->hasPermissionTo('delete agents') ||
                                        auth()->user()->hasPermissionTo('print')): ?>
                                        <td>
                                            <input type="checkbox" name="selected[]" value="<?php echo e($shipment->id); ?>">
                                        </td>
                                        <?php elseif(auth()->user()->hasRole('admin')): ?>
                                        <td>
                                            <input type="checkbox" name="selected[]" value="<?php echo e($shipment->id); ?>">
                                        </td>
                    </form>
                    <?php endif; ?>
                    <td><?php echo e($shipment->tracking_number); ?></td>
                    <td><?php echo e($shipment->agent_name); ?></td>
                    <td><?php echo e($shipment->sender_name); ?></td>
                    <td><?php echo e($shipment->receiver_name); ?></td>
                    <td><?php echo e($shipment->order_number); ?></td>
                    <td><?php echo e($shipment->shipping_date); ?></td>
                    <?php if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('agent')): ?>
                    <?php if($shipment->status === 'Approved'): ?>
                    <td><p class="bg-success p-1 rounded text-light "><?php echo e($shipment->status); ?></p>
                        <?php elseif($shipment->status === 'Pending'): ?>
                    <td><p class="bg-danger p-1 rounded text-light "><?php echo e($shipment->status); ?></p>
                        <?php endif; ?>
                        <?php endif; ?>

                        <?php if($shipment->status_shipment === 'Pending'): ?>
                    <td><p class="bg-danger p-1 text-light rounded "><?php echo e($shipment->status_shipment); ?></p>
                    </td>
                    <?php elseif($shipment->status_shipment === 'Approved'): ?>
                    <td><p class="bg-success p-1 rounded text-light"><?php echo e($shipment->status_shipment); ?></p>
                    </td>

                    <?php elseif($shipment->status_shipment === 'On the way'): ?>
                    <td><p class="bg-primary p-1 rounded text-light"><?php echo e($shipment->status_shipment); ?></p>
                    </td>

                    <?php elseif($shipment->status_shipment === 'Delivered'): ?>
                    <td><p class="bg-warning p-1 rounded text-dark"><?php echo e($shipment->status_shipment); ?></p>
                    </td>
                    <?php else: ?>
                    <td><p class="bg-secondary p-1 rounded text-light"><?php echo e($shipment->status_shipment); ?></p>
                    </td>
                    <?php endif; ?>
                    <?php if(auth()->user()->hasRole('user')): ?>
                    <td>Rs:<?php echo e($shipment->amount); ?></td>
                    <?php endif; ?>
                    <td>
                        <div class="row justify-content-center">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show shipments')): ?>
                            <div class="col-md-2  mx-2 my-2">
                                <a href="<?php echo e(route('shipment.show', $shipment)); ?>" class="btn btn-sm btn-info"><i
                                        class="icon material-icons md-visibility"></i></a>
                            </div>
                            <?php endif; ?>

                            <?php if($shipment->status === 'Approved' || auth()->user()->hasRole('admin')): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit shipments')): ?>
                            <div class="col-md-2  my-2">
                                <a href="<?php echo e(route('shipment.edit',$shipment)); ?>" class="btn btn-sm btn-dark"><i
                                        class="icon material-icons md-edit"></i></a>
                            </div>
                            <?php endif; ?>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete shipments')): ?>
                            <div class="col-md-2  mx-2 my-2">
                                <form action="<?php echo e(route('shipment.destroy',$shipment)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are You Sure You Want to Delete This Shipment?')"><i
                                            class="icon material-icons md-delete"></i></button>
                                </form>
                            </div>
                            <?php endif; ?>
                        </div>
                    </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
    <div class="row">
        <?php echo e($shipments->links()); ?>

    </div>





</section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script>
    function submit_form(action) {
               

                if(action === 'delete'){
                const checkbox =  document.querySelectorAll('input[name="selected[]"]:checked');
                if(checkbox.length < 1){
                    alert('Please Select Shipment First');
                }else{
                  confirmed = confirm('Are You Sure');
                  if(confirmed){
                    document.getElementById('form-action').value = action;
                    document.getElementById('form').submit();
                  }
                }
                 }else if(action === 'print'){                    
                    const checkbox = document.querySelectorAll('input[name="selected[]"]:checked');
                  if(checkbox.length < 1){
                    alert('Please Select Shipment First');
                  }else{
                    let rider = document.querySelector('input[name="rider"]:checked');
                    let selectedRider = null;
                    
                    if(rider){
                    selectedRider = rider.value;
                    console.log(selectedRider);
               
                        const riderInput = document.createElement('input');
                        riderInput.type = 'hidden';
                        riderInput.name = 'rider_id';
                        riderInput.value = selectedRider;
                        document.getElementById('form').appendChild(riderInput);
                        document.getElementById('form-action').value = action;
                        document.getElementById('form').submit();  
                    }
                    document.getElementById('form-action').value = action;
                    document.getElementById('form').submit();  
                    
                }
            }
              
                console.log(action);
            }   
            
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ABDULLAH WORK\ABDULLAH ( ME)\All Projects And Portfolio\Laravel Portfolio Projects\Laravel-Courier-Management (Advanced)\resources\views/shipments/index.blade.php ENDPATH**/ ?>