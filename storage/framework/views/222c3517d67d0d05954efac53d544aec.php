

<?php $__env->startSection('site-title'); ?>
Create Products
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-main-title'); ?>
Products
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-xl-12">
            <!-- File input -->
            <form action="/add-product/" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="card">
                    <?php if(Session::has('message')): ?>
                        <p class="text-danger text-center"><?php echo e(Session::get('message')); ?></p>
                    <?php endif; ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label">Name</label>
                                <input class="form-control" type="text" name="name" />
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label">Quantity</label>
                                <input class="form-control" type="text" name="qty" />
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label">Regular Price</label>
                                <input class="form-control" type="number" name="regular_price" />
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label">Sale Price</label>
                                <input class="form-control" type="number" name="sale_price" />
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label">Available Size</label>
                                <select name="size" class="form-control">
                                    <option value="s">S</option>
                                    <option value="m">M</option>
                                    <option value="l">L</option>
                                    <option value="xl">XL</option>
                                </select>
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label">Available Color</label>
                                <select name="color" class="form-control">
                                    <option value="white">White</option>
                                    <option value="black">Black</option>
                                    <option value="blue">Blue</option>
                                </select>
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label">Category</label>
                                <select name="category" class="form-control">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label text-danger">Recommend image size ..x.. pixels.</label>
                                <input class="form-control" type="file" name="thumbnail" />
                            </div>
                            <div class="mb-3 col-12">
                                <label class="form-label text-danger">Description</label>
                                <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" value="Add Post">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel\laravel-Shopping\resources\views/product/add.blade.php ENDPATH**/ ?>