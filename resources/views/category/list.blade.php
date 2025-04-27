@extends('dashboard.master')

@section('site-title')
View Category
@endsection

@section('page-main-title')
Category
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table align-middle" style="table-layout: fixed;">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 ">
                        @foreach ($categories as $category)
                        <tr id='category-row-{{ $category->id }}'>
                            <td class="text-dark">
                                {{ $category->id }}
                            </td>
                            <td class="text-info">
                                {{ $category->category_name }}
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Edit Category Link -->
                                        <!-- Delete Category -->
                                        <a class="dropdown-item" href="{{ url('edit-cate/'. $category->id) }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>                                        
                                        <a class="dropdown-item" id="remove-post-key" data-value="{{ $category->id }}" data-bs-toggle="modal" data-bs-target="#basicModal" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
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
                <div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Are you sure to remove this post?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close-modal"></button>
                            </div>
                            <div class="modal-footer">
                                <input type="text" id="remove-val" name="remove-id">
                                <button type="button" class="btn btn-danger" id="btn_confirm_remove">Confirm</button>
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
@endsection