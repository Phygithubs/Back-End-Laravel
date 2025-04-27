
<?php $__env->startSection('content'); ?>

    <?php $__env->startSection('site-title'); ?>
        Admin | Add Post
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('page-main-title'); ?>
        Add Logo
    <?php $__env->stopSection(); ?>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="/submit/update-logo/" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card">
                        <input type="hidden" value="<?php echo e($data[0]->id); ?>" name="id">
                        <h2>Old Logo</h2>
                        <img src="<?php echo e(asset('image/' . $data[0]->thumbnail)); ?>" alt="Avatar" style="width: 100px">
                        <input type="text" value="<?php echo e($data[0] ->thumbnail); ?>" name="oldthumbnail">
                    </div>
                    <div class="card">
                        <?php if(Session::has('success')): ?>
                            <div class="alert alert-success" id="alert"><?php echo e(Session::get('success')); ?></div>
                        <?php endif; ?>

                        <?php if($errors -> any()): ?>
                          <div class="alert alert-danger" id="alert">
                            <ul>
                                <li><?php echo e($errors); ?></li>
                            </ul>
                          </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label for="formFile" class="form-label text-danger">Recommend image size 30x30 pixels.</label>
                                    <input class="form-control" type="file" name="newthumbnail" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Add Post" name="submitUpdateLogo">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel\laravel-Shopping\resources\views/logo/update-logo.blade.php ENDPATH**/ ?>