<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $__env->yieldContent('title'); ?></title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <link rel="shortcut icon" href="<?php echo e(asset('assets/imgs/guest-imgs/logo.png')); ?>" type="image/x-icon">
        <?php echo $__env->yieldContent('css'); ?>
        <link href="<?php echo e(asset('assets/css/main.css?v=6.0')); ?>" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <div class="screen-overlay"></div>
        <aside class="navbar-aside" id="offcanvas_aside">
            <div class="aside-top justify-content-between">
                <div>
                 <a href="<?php echo e(route('dashboard')); ?>"> <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $attributes = $__attributesOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $component = $__componentOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__componentOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?></a>
                </div>
                <div>
                    <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
                </div>
            </div>
            <nav>
                <ul class="menu-aside">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view dashboard')): ?>
                    <li class="menu-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                        <a class="menu-link" href="<?php echo e(route('dashboard')); ?>">
                            <i class="icon material-icons md-home"></i>
                            <span class="text">Dashboard</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view agents')): ?>
                    <li class="menu-item <?php echo e(request()->routeIs('agent.index') ? 'active' : ''); ?>">
                        <a class="menu-link" href="<?php echo e(route('agent.index')); ?>">
                            <i class="icon material-icons md-store"></i>
                            <span class="text">Agents</span>
                        </a>
                    </li>
                    <?php endif; ?>
                   
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view users')): ?>
                    <li class="menu-item <?php echo e(request()->routeIs('user.index') ? 'active' : ''); ?>">
                        <a class="menu-link" href="<?php echo e(route('user.index')); ?>">
                            <i class="icon material-icons md-person"></i>
                            <span class="text">Users</span>
                        </a>
                    </li>  
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view shipments')): ?>
                    <li class="menu-item <?php echo e(request()->routeIs('shipment.index') ? 'active' : ''); ?>">
                        <a class="menu-link" href="<?php echo e(route('shipment.index')); ?>">
                            <i class="icon material-icons md-local_shipping"></i>
                            <span class="text">Shipment</span>
                        </a>
                    </li>
                    <?php endif; ?>


                    <li class="menu-item <?php echo e(request()->routeIs('tracking.index') ? 'active' : ''); ?>">
                        <a class="menu-link" href="<?php echo e(route('tracking.index')); ?>">
                            <i class="icon material-icons md-location_searching"></i>
                            <span class="text">Shipment Tracking</span>
                        </a>
                    </li>  
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view riders')): ?>
                    <li class="menu-item <?php echo e(request()->routeIs('rider.index') ? 'active' : ''); ?>">
                        <a class="menu-link" href="<?php echo e(route('rider.index')); ?>">
                            <i class="icon material-icons md-directions_bike"></i>
                            <span class="text">Riders</span>
                        </a>
                    </li>  
                    <?php endif; ?>
                </ul>
                <hr>
                <ul class="menu-aside mt-4">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view reports')): ?>
                    <li class="menu-item <?php echo e(request()->routeIs('report.index') ? 'active' : ''); ?>">
                        <a class="menu-link" href="<?php echo e(route('report.index')); ?>">
                            <i class="icon material-icons md-bar_chart"></i>
                            <span class="text">Reports</span>
                        </a>
                    </li>  
                    <?php endif; ?>

                    <li class="menu-item has-submenu">
                        <a class="menu-link" href="#">
                            <i class="icon material-icons md-settings"></i>
                            <span class="text">Settings</span>
                        </a>
                        <div class="submenu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view permissions')): ?>
                            <a href="<?php echo e(route('permission.index')); ?>" class="d-flex">
                                <i class="icon material-icons md-lock"></i>
                                <span class="text">Permissions</span>
                            </a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view roles')): ?>
                            <a href="<?php echo e(route('role.index')); ?>" class="d-flex">  <i class="icon material-icons md-vpn_key"></i>
                                <span class="text">Roles</span>
                            </a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view status')): ?>
                            <a href="<?php echo e(route('status.index')); ?>" class="d-flex">
                                <i class="icon material-icons md-check_circle"></i>
                                <span class="text"> Status Creation </span>
                            </a>
                            <?php endif; ?>
                            
                            <a href="<?php echo e(route('profile.edit')); ?>" class="d-flex">
                                <i class="icon material-icons md-person"></i>
                                <span class="text"> Profile Settings </span>
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
        </aside>
        <main class="main-wrap">
            <header class="main-header navbar">
                <div class="col-nav">
                    <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"><i class="material-icons md-apps"></i></button>
                    <ul class="nav">                      
                        <li class="dropdown nav-item">
                            <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> <?php echo e(Auth::user()->name); ?>  ( <?php echo e(Auth::user()->roles->pluck('name')->implode('')); ?> ) </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                                <a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>"><i class="material-icons md-perm_identity"></i>Account Settings</a>
                               
                                <div class="dropdown-divider"></div>
                                <form action="<?php echo e(route('logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="dropdown-item text-danger"><i class="material-icons md-exit_to_app"></i>Logout</button>
                                </form>
                       
                            </div>
                        </li>
                    </ul>
                    <hr>
                   
                </div>
            </header>
          <?php echo $__env->yieldContent('content'); ?>
            <!-- content-main end// -->
        </main>
        <script src="<?php echo e(asset('assets/js/vendors/jquery-3.6.0.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/vendors/bootstrap.bundle.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/vendors/select2.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/vendors/perfect-scrollbar.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/vendors/jquery.fullscreen.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/vendors/chart.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/main.js?v=6.0')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/js/custom-chart.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/js/vendors/alert.js')); ?>"></script>
        <?php echo $__env->yieldContent('scripts'); ?>
    </body>
</html>
<?php /**PATH D:\ABDULLAH WORK\ABDULLAH ( ME)\All Projects And Portfolio\Laravel Portfolio Projects\Laravel-Courier-Management (Advanced)\resources\views/layouts/app.blade.php ENDPATH**/ ?>