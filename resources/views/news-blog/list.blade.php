@extends('dashboard.master')

@section('content')
<div class="content-wrapper">
    @section('site-title')
        Admin | List Post
    @endsection

    @section('page-main-title')
        List Products
    @endsection

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card" id="card">
            <div class="table-responsive text-nowrap" id="table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Thumbnail</th>
                            <th>Banner</th>
                            <th>Description</th>
                            <th>Views</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($news as $new)
                            <tr>
                                <td >{{ $new->title }}</td>
                                <td>
                                <img src="http://127.0.0.1/products/{{ $new->thumbnail}}" alt="Thumbnail" class="rounded-circle"
                                        style="width: 50px; object-fit: cover; border-radius: 0px !important;">
                                </td>
                                <td>
                                <img src="http://127.0.0.1/products/{{ $new->thumbnail}}" alt="Banner" class="rounded-circle"
                                        style="width: 50px; object-fit: cover; border-radius: 0px !important;">
                                </td>
                                <td class="text-truncate" style="max-width: 200px;">{{ $new->description }}</td>
                                <td>{{ $new->views }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/update/news/{{ $new->id }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                            <a class="dropdown-item" id="remove-post-key" data-value="{{ $new->id }}"
                                                data-bs-toggle="modal" data-bs-target="#basicModal" href="javascript:void(0);">
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

        <!-- Delete Modal -->
        <div class="mt-3">
            <form action="" method="post">
                @csrf
                <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Are you sure to remove this post?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="remove-val" name="remove_id">
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
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        });

        $('#btn_confirm_remove').click(function(e) {
            e.preventDefault();
            let id = $('#remove-val').val();

            $.ajax({
                url: '/remove/news/' + id,
                method: 'POST',
                data: { id: id },
                success: function(response) {
                    swal({
                        title: "Deleted Successfully",
                        text: "You deleted the post!",
                        icon: "success",
                        button: "Confirm",
                    }).then(() => {
                        $('.btn-close').click();
                        $('#category-row-' + id).remove();
                    });
                },
                error: function() {
                    swal({
                        title: "Delete Failed",
                        text: "You cannot delete the post!",
                        icon: "error",
                        button: "Confirm",
                    });
                }
            });
        });

        // Set remove ID when clicking delete
        $(document).on('click', '#remove-post-key', function () {
            let id = $(this).data('value');
            $('#remove-val').val(id);
        });
    });
</script>
@endsection
