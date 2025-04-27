
@extends('dashboard.master')
@section('content')

    @section('site-title')
        Admin | Add Post
    @endsection
    @section('page-main-title')
        Add Logo
    @endsection

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="/add-logo" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        @if (Session::has('message'))
                            <p class="text-danger text-center" id="alert">{{ Session::get('message') }}</p>
                        @endif
                        @if ($errors -> any())
                        <div class="alert alert-danger">
                            <ul>
                                <li>{{$errors}}</li>
                            </ul>
                        </div>
                        
                        @endif
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
