@extends('admin.app')

@section('title')
    Add Sub Category
@endsection

@section('body')
<div class="container-fluid m-5">
    <h1 class="mt-4"> Add Sub CategoryDetail </h1>
</div>
<div class="row m-5">
    {!! Form::open(['route' => 'sub-categories.store', "method" => "post"]) !!}
    {!! Form::token() !!}
        @include('admin.SubCategory.form')
    {!! Form::close() !!}
</div>
@endsection

@section('scripts')

@endsection
