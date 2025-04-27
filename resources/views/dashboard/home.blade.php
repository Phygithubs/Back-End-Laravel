@extends('dashboard.master')

@section('site-title')
Home Page
@endsection

@section('page-main-title')
Dashboard
@endsection

@section('content')

<div class="content-wrapper d-flex flex-col justify-content-center align-items-center">
    @if (Session::has('success'))
        <div class="alert alert-success pb-0" id="alert">
            <p class="text text-primary">
                {{ Session::get('success') }}
            </p>
        </div>
    @endif
    <h3>Welcome to my Dashboard.</h3>
</div>
@endsection