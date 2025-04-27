
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <?php $__env->startSection('site-title'); ?>
      Admin | List Post
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('page-main-title'); ?>
      List Logo
    <?php $__env->stopSection(); ?>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr>
                  <th>Thumbnail</th>
                  <th>Created At</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr id="category-row-<?php echo e($logo -> id); ?>">
                    <td>
                      <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                        <img src="./image/<?php echo e($logo -> thumbnail); ?>" alt="Avatar" style="width: 100px">
                      </ul>
                    </td>
                    <td><span class="badge bg-label-primary me-1"><?php echo e($logo -> created_at); ?></span></td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu position-absolute z-3" >
                          <a class="dropdown-item" href="/update/logo/<?php echo e($logo -> id); ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                          <a class="dropdown-item" id="remove-post-key" data-value="<?php echo e($logo -> id); ?>" data-bs-toggle="modal" data-bs-target="#basicModal" href="javascript:void(0);">
                            <i class="bx bx-trash me-1"></i> Delete
                          </a>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="mt-3">
          <form action="" method="post">
            <?php echo csrf_field(); ?>
          <div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel1">Are you sure to remove this post?</h5>

                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  <!-- Use class btn-close for ajax.then() -->
                </div>
                <div class="modal-footer">
                  <input type="hidden" id="remove-val" name="remove_id">
                  <button type="submit" class="btn btn-danger" id="btn_confirm_remove">Confirm</button>
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        
      <hr class="my-5" />
    </div>
    <!-- / Content -->
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
        $('#btn_confirm_remove').click(function(e) {
            e.preventDefault();
            let id = $('#remove-val').val();

            $.ajax({
                url : '/remove/logo/'+id,
                method : 'POST',
                data : {
                    id : id,
                },
                success :  function(response){
                    swal({
                        title: "Deleted Success",
                        text: "You deleted the category!",
                        icon: "success",
                        button: "Confirm",
                    }).then(() => {
                        $('.btn-close').click();
                        // .btn-close is used to close the modal
                        // from line 60
                        $('#category-row-'+id).remove();// from line 24
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
<?php echo $__env->make('dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel\laravel-Shopping\resources\views/logo/list-logo.blade.php ENDPATH**/ ?>