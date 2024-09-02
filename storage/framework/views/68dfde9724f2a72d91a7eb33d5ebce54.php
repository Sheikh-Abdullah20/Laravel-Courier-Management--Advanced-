

<?php $__env->startSection('title'); ?>
Riders - View
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
            <h2 class="content-title">Riders - View</h2>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create riders')): ?>
            <div>
                <a href="<?php echo e(route('rider.create')); ?>" class="btn btn-dark">Create Rider</a>
            </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-end">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete riders')): ?>
                                <button type="button" onclick="submit_form() " class="btn btn-danger mx-2"><i
                                        class="icon material-icons md-delete"></i></button>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('download reports')): ?>
                                <a href="<?php echo e(route('download_rider_report')); ?>" class="btn btn-secondary"><i
                                    class="icon material-icons md-get_app"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <form id="form" action="<?php echo e(route('rider.index')); ?>" method="GET">
                    <?php echo csrf_field(); ?>
                    <div class="table-responsive">
                    <table  class="table table-striped text-center">
                        <thead>
                            <tr>
                                <?php if(auth()->user()->hasPermissionTo('delete riders')): ?>
                                <th>Select</th>
                                <?php elseif(auth()->user()->hasRole('admin')): ?>
                                <th>Select</th>
                                <?php endif; ?>
                                <th>Rider ID</th>
                                <th>Rider Name</th>
                                <th>Rider Bike_no</th>
                                <th>Rider Phone</th>
                                <th>Rider Address</th>
                                <?php if(auth()->user()->hasPermissionTo('edit riders') || auth()->user()->hasPermissionTo('show riders')): ?>
                                    <th>Actions</th>
                                <?php elseif(auth()->user()->hasPermissionTo('edit riders')): ?>
                                    <th>Actions</th>
                                <?php elseif(auth()->user()->hasRole('admin')): ?>
                                    <th>Actions</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        
                        <?php $count = 0; ?>
                        <tbody>
                            <?php $__currentLoopData = $riders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $count++; ?>
                                <tr>
                                    <?php if(auth()->user()->hasPermissionTo('delete riders')): ?>
                                    <td>
                                        <input type="checkbox" name="selected[]" id="checkbox"
                                            value="<?php echo e($rider->id); ?>">
                                    </td>
                                    <?php elseif(auth()->user()->hasRole('admin')): ?>
                                    <td>
                                        <input type="checkbox" name="selected[]" id="checkbox"
                                            value="<?php echo e($rider->id); ?>">
                                    </td>
                                    <?php endif; ?>
                                    <td><?php echo e($count); ?></td>
                                    <td><?php echo e($rider->name); ?></td>
                                    <td><?php echo e($rider->bike_no); ?></td>
                                    <td><?php echo e($rider->phone); ?></td>
                                    <td><?php echo e($rider->address); ?></td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show riders')): ?>
                                                <div class="col-md-2 mx-2 my-2">
                                                    <a href="<?php echo e(route('rider.show', $rider)); ?>" class="btn btn-sm btn-info"><i
                                                            class="icon material-icons md-visibility"></i></a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit riders')): ?>
                                                <div class="col-md-2   my-2">
                                                    <a href="<?php echo e(route('rider.edit', $rider)); ?>"
                                                        class="btn btn-sm btn-dark"><i
                                                            class="icon material-icons md-edit"></i></a>
                                                </div>
                                            <?php endif; ?>
                                </form>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete riders')): ?>
                                    <div class="col-md-2 mx-2  my-2">
                                        <form action="<?php echo e(route('rider.destroy', $rider)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" onclick="return confirm('Are You Sure You Want to Delete this User?')"
                                                class="btn btn-sm btn-danger"><i class="icon material-icons md-delete"></i></button>
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
                        </div>
                    </div>
                    </div>
                    </div>

                    <div class="row">
                        <?php echo e($riders->links()); ?>

                    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
     function submit_form() {
                    const checkbox = document.querySelectorAll('input[name="selected[]"]:checked');
                    if (checkbox.length < 1) {
                        alert('Please Select Rider First');
                    } else {
                        confirmed = confirm('Are You Sure');
                        if (confirmed) {
                            document.getElementById('form').submit();
                        }

                    }
                }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ABDULLAH WORK\ABDULLAH ( ME)\All Projects And Portfolio\Laravel Portfolio Projects\Laravel-Courier-Management (Advanced)\resources\views/riders/index.blade.php ENDPATH**/ ?>