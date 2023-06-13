@extends('admin.app')

@section('title')
    Edit Books
@endsection

@section('body')
<div class="container-fluid m-5">
    <h1 class="mt-4"> Add BookDetail </h1>
</div>
<div class="row m-5">
    {!! Form::model($bookData, ['route' => ['books.update', $bookData->book_id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data']) !!}
        @include('admin.BookList.form')
    {!! Form::close() !!}
</div>
@endsection
