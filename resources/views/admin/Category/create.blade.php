@extends('admin.app')

@section('title')
    Add Category
@endsection

@section('body')
<div class="container-fluid m-5">
    <h1 class="mt-4"> Add CategoryDetail </h1>
</div>
<div class="row m-5">
    {!! Form::open(['route' => 'categories.store', "method" => "post"]) !!}
    {!! Form::token() !!}
        @include('admin.Category.form')
    {!! Form::close() !!}
</div>
@endsection

@section('scripts')

@endsection
