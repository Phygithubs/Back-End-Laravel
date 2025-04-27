


<?php $__env->startSection('site-title'); ?>
Logout Page
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-main-title'); ?>
Logout
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-xl-12">
            <!-- File input -->
            <form action="/submit-logout" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="card">
                    <div class="card-body">
                        <p>Are you sure you want to logout?</p>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-danger" value="Logout">
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel\laravel-Shopping\resources\views/dashboard/logout.blade.php ENDPATH**/ ?>