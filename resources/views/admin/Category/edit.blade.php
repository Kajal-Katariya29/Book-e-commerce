@extends('admin.app')

@section('title')
    Edit Category
@endsection

@section('body')
<div class="container-fluid m-5">
    <h1 class="mt-4"> Edit CategoryDetail </h1>
</div>
<div class="row m-5">
    {!! Form::model($categoryData, ['route' => ['categories.update', $categoryData->cateogery_id], 'method' => 'PATCH']) !!}
    {!! Form::token() !!}
        @include('admin.Category.form')
    {!! Form::close() !!}
</div>
@endsection

@section('scripts')

@endsection
