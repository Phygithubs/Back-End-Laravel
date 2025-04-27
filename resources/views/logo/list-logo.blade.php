@extends('dashboard.master')
@section('content')
<div class="content-wrapper">
    @section('site-title')
      Admin | List Post
    @endsection
    @section('page-main-title')
      List Logo
    @endsection

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
                @foreach ($data as $logo)
                  <tr id="category-row-{{ $logo -> id }}">
                    <td>
                      <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                        <img src="./image/{{ $logo -> thumbnail }}" alt="Avatar" style="width: 100px">
                      </ul>
                    </td>
                    <td><span class="badge bg-label-primary me-1">{{ $logo -> created_at }}</span></td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu position-absolute z-3" >
                          <a class="dropdown-item" href="/update/logo/{{ $logo -> id }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                          <a class="dropdown-item" id="remove-post-key" data-value="{{ $logo -> id }}" data-bs-toggle="modal" data-bs-target="#basicModal" href="javascript:void(0);">
                            <i class="bx bx-trash me-1"></i> Delete
                          </a>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="mt-3">
          <form action="" method="post">
            @csrf
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
@endsection

@section('script')
<script>
    @if(Session::has('success'))
      toastr.success("{{ Session::get('success') }}");
    @endif

    $(document).ready(function() {
        $.ajaxSetup({
            'headers': {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
@endsection