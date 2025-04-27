
@extends('dashboard.master')

@section('site-title')
    Products List
@endsection

@section('page-main-title')
    Products
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Thumbnail</th>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Regular Price</th>
                            <th>Sale Price</th>
                            <th>Category</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Viewer</th>
                            <th>Author</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($products as $product)
                        <tr id="product-row-{{ $product->id }}">
                            <td>{{ $product->id }}</td>
                            <td>
                                <img src="http://127.0.0.1/profile/{{ $product->thumbnail }}" alt="Thumbnail" class="rounded-circle" style="width: 50px; object-fit: cover;">
                            </td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $product->name }}</strong></td>
                            <td>{{ $product->qty }} </td>
                            <td>{{ $product->regular_price }} $</td>
                            <td>{{ $product->sales_price }} $</td>
                            <td><span class="badge bg-label-success me-1">{{ $product -> category_name }}</span></td>
                            <td><span class="badge bg-label-primary me-1">{{ $product->color }}</span></td>
                            <td><span class="badge bg-label-primary me-1">{{ $product->size }}</span></td>
                            <td>{{ $product->views}}</td>
                            <td><span class="badge bg-label-warning me-1">{{ Auth::user()->name }}</span></td>

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="edit-prod/{{ $product->id }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item remove-post-key" href="javascript:void(0);" data-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#basicModal"><i class="bx bx-trash me-1"></i> Delete</a>
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
            <form id="deleteForm" method="POST">
                @csrf
                <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Are you sure to remove this post?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="remove-val" name="remove-id">
                                <button type="submit" class="btn btn-danger" id="btn_confirm_remove">Confirm</button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <hr class="my-5" />
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
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $('.remove-post-key').click(function() {
                let id = $(this).data('id');
                $('#remove-val').val(id);
                $('#deleteForm').attr('action', '/remove-product/' + id);
            });

            $('#btn_confirm_remove').click(function(event) {
                event.preventDefault();  // Prevent default form submission

                let id = $('#remove-val').val();

                $.ajax({
                    url: '/remove-product/' + id,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(response) {
                        swal({
                            title: "Deleted Successfully",
                            text: "The product has been removed!",
                            icon: "success",
                            button: "OK",
                        }).then(() => {
                            $('#basicModal').modal('hide');
                            $('#product-row-' + id).remove();
                        });
                    },
                    error: function(xhr) {
                        swal({
                            title: "Delete Failed",
                            text: "Failed to delete the product.",
                            icon: "error",
                            button: "OK",
                        });
                    }
                });
            });
        });
    </script>
@endsection
