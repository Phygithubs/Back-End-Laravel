

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
                <form action="/add-logo" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card">
                        <?php if(Session::has('message')): ?>
                            <p class="text-danger text-center" id="alert"><?php echo e(Session::get('message')); ?></p>
                        <?php endif; ?>
                        <?php if($errors -> any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <li><?php echo e($errors); ?></li>
                            </ul>
                        </div>
                        
                        <?php endif; ?>
                        <div class="card-body">

                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label for="formFile" class="form-label text-danger">Recommend image size ..x.. pixels.</label>
                                    <input class="form-control" type="file" name="thumbnail" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Submite">
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

    $(document).ready(function() {
        $.ajaxSetup({
            'headers': {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            }
        });
        $('#btn_confirm_remove').click(function() {
            let id = $('#remove-val').val();

            $.ajax({
                url : '/remove-category/'+id,
                method : 'POST',
                success :  function(response){
                    swal({
                        title: "Deleted Success",
                        text: "You deleted the category!",
                        icon: "success",
                        button: "Confirm",
                    }).then(() => {
                        $('#btn-close-modal').click();
                        $('#category-row-'+id).remove();
                    })
                },
                error :function(){
                    swal({
                        title: "Deleted Failed",
                        text: "You cannot delete the category!",
                        icon: "error",
                        button: "Confirm",
                    });
                }
            })

        })
    })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel\laravel-Shopping\resources\views/logo/add-logo.blade.php ENDPATH**/ ?>