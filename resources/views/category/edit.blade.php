@extends('dashboard.master')

@section('site-title')
Add Category
@endsection

@section('page-main-title')
Category
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-xl-12">
            <!-- File input -->
            <form action="{{ url('update-category/'.$categorys->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Fixed the typo here -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label for="category-name" class="form-label">Name</label>
                                <!-- Fixed incorrect variable name -->
                                <input class="form-control border-1 border-dark" 
                                       type="text" 
                                       name="name" 
                                       value="{{ $categorys->category_name }}" 
                                       id="category-name" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <a href="/list-category" class="btn btn-danger">Cancel</a>
                            <input type="submit" class="btn btn-primary" value="Update Category">
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
    @if ($errors->any())
        @foreach ($errors->all() as $err)
            toastr.error("{{ $err }}");
        @endforeach
    @endif
</script>
@endsection