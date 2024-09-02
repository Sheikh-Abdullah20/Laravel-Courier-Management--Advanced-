<?php if(session()->has('success')): ?>
    <div class="alert alert-success" id="autoDissmiss">
        <?php echo e(session('success')); ?>

    </div>
<?php elseif(session()->has('delete')): ?>
<div class="alert alert-danger" id="autoDissmiss">
    <?php echo e(session('delete')); ?>

</div>

<?php elseif(session()->has('error')): ?>
<div class="alert alert-danger" id="autoDissmiss">
    <?php echo e(session('error')); ?>

</div>
<?php endif; ?><?php /**PATH D:\ABDULLAH WORK\ABDULLAH ( ME)\All Projects And Portfolio\Laravel Portfolio Projects\Laravel-Courier-Management (Advanced)\resources\views/components/alert.blade.php ENDPATH**/ ?>