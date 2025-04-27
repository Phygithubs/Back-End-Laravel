

<?php $__env->startSection('site-title'); ?>
    Edit Product
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-main-title'); ?>
    Products
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <form action="<?php echo e(url('/update-product/' . $product->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label">Name</label>
                                    <input class="form-control" type="text" name="name" value="<?php echo e($product->name); ?>" required/>
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Quantity</label>
                                    <input class="form-control" type="number" name="qty" value="<?php echo e($product->qty); ?>" required/>
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Regular Price</label>
                                    <input class="form-control" type="number" name="regular_price" value="<?php echo e($product->regular_price); ?>" required/>
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Sale Price</label>
                                    <input class="form-control" type="number" name="sale_price" value="<?php echo e($product->sales_price); ?>" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Available Size</label>
                                    <select name="size[]" class="form-control size-color" multiple>
                                        <option value="s" <?php echo e(in_array('s', explode(',', $product->size)) ? 'selected' : ''); ?>>S</option>
                                        <option value="m" <?php echo e(in_array('m', explode(',', $product->size)) ? 'selected' : ''); ?>>M</option>
                                        <option value="l" <?php echo e(in_array('l', explode(',', $product->size)) ? 'selected' : ''); ?>>L</option>
                                        <option value="xl" <?php echo e(in_array('xl', explode(',', $product->size)) ? 'selected' : ''); ?>>XL</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Available Color</label>
                                    <select name="color[]" class="form-control size-color" multiple>
                                        <option value="white" <?php echo e(in_array('white', explode(',', $product->color)) ? 'selected' : ''); ?>>White</option>
                                        <option value="black" <?php echo e(in_array('black', explode(',', $product->color)) ? 'selected' : ''); ?>>Black</option>
                                        <option value="blue" <?php echo e(in_array('blue', explode(',', $product->color)) ? 'selected' : ''); ?>>Blue</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Category</label>
                                    <select name="category" class="form-control" required>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>" <?php echo e($category->id == $product->category_id ? 'selected' : ''); ?>>
                                                <?php echo e($category->category_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select> 
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Thumbnail Image 
                                        <span class="text-danger">(Recommended: 390 x 200 pixels)</span>
                                    </label>
                                    <input class="form-control" type="file" name="thumbnail"/>
                                    <?php if($product->thumbnail): ?>
                                        <img src="<?php echo e(asset('products/' . $product->thumbnail)); ?>" alt="Thumbnail" class="rounded mt-2" style="width: 100px; object-fit: cover;">
                                    <?php endif; ?>
                                </div>
                                <div class="mb-3 col-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" cols="30" rows="5"><?php echo e($product->decription); ?></textarea>

                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Update Product">
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
        <?php if(Session::has('success')): ?>
            toastr.success("<?php echo e(Session::get('success')); ?>");
        <?php endif; ?>

        $(document).ready(function(){
            $('.size-color').select2();
        });
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel\laravel-Shopping\resources\views/product/edit.blade.php ENDPATH**/ ?>