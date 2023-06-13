@extends('admin.app')

@section('title')
    Add Books
@endsection

@section('body')
<div class="container-fluid m-5">
    <h1 class="mt-4"> Add BookDetail </h1>
</div>
<div class="row m-5">
    {!! Form::open(['route' => 'books.store', "method" => "post", 'enctype' => 'multipart/form-data']) !!}
    {!! Form::token() !!}
        @include('admin.BookList.form')
    {!! Form::close() !!}
</div>
@endsection
