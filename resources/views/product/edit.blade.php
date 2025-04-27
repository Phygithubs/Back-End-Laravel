@extends('dashboard.master')

@section('site-title')
    Edit Product
@endsection

@section('page-main-title')
    Products
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <form action="{{ url('/update-product/' . $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label">Name</label>
                                    <input class="form-control" type="text" name="name" value="{{ $product->name }}" required/>
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Quantity</label>
                                    <input class="form-control" type="number" name="qty" value="{{ $product->qty }}" required/>
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Regular Price</label>
                                    <input class="form-control" type="number" name="regular_price" value="{{ $product->regular_price }}" required/>
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Sale Price</label>
                                    <input class="form-control" type="number" name="sale_price" value="{{ $product->sales_price }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Available Size</label>
                                    <select name="size[]" class="form-control size-color" multiple>
                                        <option value="s" {{ in_array('s', explode(',', $product->size)) ? 'selected' : '' }}>S</option>
                                        <option value="m" {{ in_array('m', explode(',', $product->size)) ? 'selected' : '' }}>M</option>
                                        <option value="l" {{ in_array('l', explode(',', $product->size)) ? 'selected' : '' }}>L</option>
                                        <option value="xl" {{ in_array('xl', explode(',', $product->size)) ? 'selected' : '' }}>XL</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Available Color</label>
                                    <select name="color[]" class="form-control size-color" multiple>
                                        <option value="white" {{ in_array('white', explode(',', $product->color)) ? 'selected' : '' }}>White</option>
                                        <option value="black" {{ in_array('black', explode(',', $product->color)) ? 'selected' : '' }}>Black</option>
                                        <option value="blue" {{ in_array('blue', explode(',', $product->color)) ? 'selected' : '' }}>Blue</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Category</label>
                                    <select name="category" class="form-control" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select> 
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Thumbnail Image 
                                        <span class="text-danger">(Recommended: 390 x 200 pixels)</span>
                                    </label>
                                    <input class="form-control" type="file" name="thumbnail"/>
                                    @if ($product->thumbnail)
                                        <img src="{{ asset('products/' . $product->thumbnail) }}" alt="Thumbnail" class="rounded mt-2" style="width: 100px; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="mb-3 col-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" cols="30" rows="5">{{ $product->decription }}</textarea>

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
@endsection

@section('script')
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        $(document).ready(function(){
            $('.size-color').select2();
        });
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection
