

<?php $__env->startSection('title'); ?>
Agents - View
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
            <h2 class="content-title">Agents - View</h2>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create agents')): ?>
        <div class="mb-4">
            <a href="<?php echo e(route('agent.create')); ?>" class="btn btn-dark">Create Agent</a>
        </div>
        <?php endif; ?>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row my-3 ">
                        <div class="col-md-6 d-flex justify-content-start">
                            <form action="<?php echo e(route('agent.index')); ?>" method="GET" class="w-50 d-flex">
                                <input type="search" class="form-control" name="search" placeholder="Search Here..">
                                <button class="btn btn-dark mx-2" type="submit">Search</button>
                            </form>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete agents')): ?>
                            <button class="btn btn-danger mx-2" type="button" onclick="select()"><i class="icon material-icons md-delete"></i></button>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('download reports')): ?>
                            <a href="<?php echo e(route('download_agent_report')); ?>" class="btn btn-secondary"><i
                                class="icon material-icons md-get_app"></i></a>
                                <?php endif; ?>
                        </div>
                    </div>
                    <form id="form" action="<?php echo e(route('agent.index')); ?>" method="GET">
                        <?php echo csrf_field(); ?>
                        <div class="table-responsive">
                    <table class="table   table-striped text-center">
                        <thead>
                            <tr>
                                <?php if(auth()->user()->hasPermissionTo('delete agents')): ?>
                                <th>Select</th>
                                <?php elseif(auth()->user()->hasRole('admin')): ?>
                                <th>Select</th>
                                <?php endif; ?>
                               
                                <th>Name</th>
                                <th>Branch</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th> Address</th>
                                <?php if(auth()->user()->hasPermissionTo('edit agents') || auth()->user()->hasPermissionTo('show agents')): ?>
                                <th>Actions</th>
                                <?php elseif(auth()->user()->hasPermissionTo('delete agents') || auth()->user()->hasRole('admin')): ?>
                                <th>Actions</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                       
                       
                        <tbody>
                            <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              
                            <tr>
                                <?php if(auth()->user()->hasPermissionTo('delete agents')): ?>
                                <td>
                                 <input type="checkbox" name="selected[]" id="select" value="<?php echo e($agent->id); ?>">
                                </form>
                                </td>
                                <?php elseif(auth()->user()->hasRole('admin')): ?>
                                <td>
                                 <input type="checkbox" name="selected[]" id="select" value="<?php echo e($agent->id); ?>">
                                </form>
                                </td>
                                <?php endif; ?>
                               
                                <td><?php echo e($agent->name); ?></td>
                                <td><?php echo e($agent->branch); ?></td>
                                <td><?php echo e($agent->email); ?></td>
                                <td><?php echo e($agent->phone); ?></td>
                                <td><?php echo e($agent->address); ?></td>
                                <td>
                                    <div class="row justify-content-center">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show agents')): ?>
                                        <div class="col-md-2 mx-2 my-2">
                                            <a href="<?php echo e(route('agent.show',$agent)); ?>" class="btn btn-sm btn-info"><i class="icon material-icons md-visibility"></i></a>
                                        </div>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit agents')): ?>
                                        <div class="col-md-2 my-2">
                                            <a href="<?php echo e(route('agent.edit',$agent)); ?>" class="btn btn-sm btn-dark"><i class="icon material-icons md-edit"></i></a>
                                        </div>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete agents')): ?>
                                        <div class="col-md-2 mx-2  my-2">
                                            <form action="<?php echo e(route('agent.destroy',$agent)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" onclick="return confirm('Are You Sure You Want to Delete This Agent? ')" class="btn btn-sm btn-danger"><i class="icon material-icons md-delete"></i></button>
                                            </form>
                                        </div>   
                                        <?php endif; ?>     
                                    </div>
                               </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php if($agents->isEmpty()): ?>
                    <div class="alert alert-warning">No Agent Found withn Your Search [<?php echo e($search); ?>]</div>
                    <?php endif; ?>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <?php echo e($agents->links()); ?>

    </div>





</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        function select(){
            const checkbox = document.querySelectorAll('input[name="selected[]"]:checked');
            if(checkbox.length < 1){
                alert('Please select Agent First');
            }else{
                confirmed = confirm('Are You sure you want to Delete this Agent?');
                if(confirmed){
                    document.getElementById('form').submit();
                }
            }
     
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ABDULLAH WORK\ABDULLAH ( ME)\All Projects And Portfolio\Laravel Portfolio Projects\Laravel-Courier-Management (Advanced)\resources\views/agents/index.blade.php ENDPATH**/ ?>