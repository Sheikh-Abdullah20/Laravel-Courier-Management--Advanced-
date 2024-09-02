

<?php $__env->startSection('title'); ?>
<?php echo e(Auth::user()->roles->pluck('name')->implode('')); ?> - Home
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
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Dashboard</h2>
            <p>Whole data about your business here</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <?php if(auth()->user()->hasRole('admin')): ?>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext align-content-center">
                    <span class="icon icon-sm rounded-circle bg-warning d-flex"><i class="text-secondary material-icons md-store" style="font-size: 2rem"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Agents</h6>
                        <span><?php echo e($agents->count()); ?></span>
                       
                    </div>
                </article>
            </div>
        </div>
        <?php endif; ?>
       
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-success"><i class="text-dark material-icons md-local_shipping"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Shipments</h6>
                        <span><?php echo e($shipments->count()); ?></span>
                       
                    </div>
                </article>
            </div>
        </div>
     
        <?php if(auth()->user()->hasRole('admin')): ?>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-secondary"><i class="text-light material-icons md-person"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Users</h6>
                        <span><?php echo e($users->count()); ?></span>
                    </div>
                </article>
            </div>
        </div>
        <?php endif; ?>

        <?php if(auth()->user()->hasRole('admin')): ?>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-dark"><i class="text-warning material-icons md-directions_bike"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Riders</h6>
                        <span><?php echo e($riders->count()); ?></span>
                    </div>
                </article>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <div class="row my-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table  text-center">
                                <thead>
                                    <tr>
                                        <th>Shipments Status</th>
                                        <th>Shipments Status Count</th>
                                    </tr>
                                </thead>
                                <?php $__currentLoopData = $statuss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php if($status->status_name === 'Pending'): ?>
                                    
                                          <div class="card w-50 m-auto d-flex align-items-center  ">
                                            <p class=" p-2 text-dark d-flex text-center"> <i class="material-icons icon md-hourglass_empty"></i> <?php echo e($status->status_name); ?></p>
                                          </div>
        
                                            <?php elseif($status->status_name === 'Approved'): ?>
                                            <div class="card w-50 m-auto d-flex align-items-center  ">
                                                <p class=" p-2 text-dark d-flex text-center"> <i class="material-icons icon md-thumb_up mx-2 "></i> <?php echo e($status->status_name); ?></p>
                                              </div>
                                              
                                              <?php elseif($status->status_name === 'On the way'): ?>
                                              <div class="card w-50 m-auto d-flex align-items-center  ">
                                                  <p class=" p-2 text-dark d-flex text-center"> <i class="material-icons icon md-local_shipping mx-2"></i> <?php echo e($status->status_name); ?></p>
                                                </div>
                                                
                                                <?php elseif($status->status_name === 'Delivered'): ?>
                                                <div class="card w-50 m-auto d-flex align-items-center  ">
                                                    <p class=" p-2 text-dark d-flex text-center"> <i class="material-icons icon md-check_circle mx-2"></i> <?php echo e($status->status_name); ?></p>
                                                  </div>
                                            <?php else: ?>
                                            <p class="bg-secondary w-50 m-auto p-2"> <?php echo e($status->status_name); ?></p>
                                            <?php endif; ?>
        
                                        </td>
                                        <td>
                                          <p class=" p-3 w-50 m-auto rounded card"> <?php echo e($statusCount[$status->status_name] ?? 0); ?></p>
                                        </td>
        
                                    </tr>
                                </tbody>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>
                        </div>
                    </div>
        
                  
               
        
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ABDULLAH WORK\ABDULLAH ( ME)\All Projects And Portfolio\Laravel Portfolio Projects\Laravel-Courier-Management (Advanced)\resources\views/index.blade.php ENDPATH**/ ?>