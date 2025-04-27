

<?php $__env->startSection('site-title'); ?>
Home Page
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-main-title'); ?>
Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="content-wrapper d-flex flex-col justify-content-center align-items-center">
    <?php if(Session::has('success')): ?>
        <div class="alert alert-success pb-0" id="alert">
            <p class="text text-primary">
                <?php echo e(Session::get('success')); ?>

            </p>
        </div>
    <?php endif; ?>
    <h3>Welcome to my Dashboard.</h3>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel\laravel-Shopping\resources\views/dashboard/home.blade.php ENDPATH**/ ?>