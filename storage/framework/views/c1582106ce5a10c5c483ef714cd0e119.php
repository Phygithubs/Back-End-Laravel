

<?php $__env->startSection('site-title'); ?>
Add Category
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-main-title'); ?>
Category
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="/submit-category" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label for="formFile" class="form-label">Name</label>
                                    <input class="form-control border-1 border-dark" type="text" name="name" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <a href="/list-category" class="btn btn-danger">Cancel</a>
                                <input type="submit" class="btn btn-primary" value="Add Category">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        <?php if($errors->any()): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                toastr.error("<?php echo e($err); ?>");
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel\laravel-Shopping\resources\views/category/create.blade.php ENDPATH**/ ?>