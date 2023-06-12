@extends('admin.app')

@section('title')
    Add/Edit Books
@endsection

@section('body')
<div class="container-fluid m-5">
    <h1 class="mt-4">{{ !empty($bookData) ? 'Edit' : 'Add' }} BookDetail </h1>
</div>
<div class="row m-5">
    <form class="row g-3" method="POST" action="{{ !empty($bookData) ? route('books.update',$bookData->book_id) : route('books.store') }}">
        @csrf
        @method(!empty($bookData) ? 'PATCH' : 'POST')
        <div class="col-md-4">
            <label for="bookname" class="form-label">Book Name :</label>
            <input type="text" class="form-control bookname" id="bookname" name="name" value="{{ !empty($bookData) ? $bookData->name : '' }}" >
        </div>
        <div class="col-md-4">
            <label for="bookauthor" class="form-label">Book Author :</label>
            <input type="text" class="form-control bookauthor" id="bookauthor" name="author" placeholder="" value="{{ !empty($bookData) ? $bookData->author : '' }}">
        </div>
        <div class="col-md-4">
            <label for="bookprice" class="form-label">Book Price :</label>
            <input type="text" class="form-control bookprice" id="bookprice" name="price" placeholder="" value="{{ !empty($bookData) ? $bookData->price : '' }}" >
        </div>
        <div class="col-12">
            <label for="description" class="form-label">Book Description :</label>
            <textarea name="description" class="form-control description" id="description" name="description">
                {{ !empty($bookData) ? $bookData->description : '' }}
            </textarea>
          </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary"> Save </button>
        </div>
    </form>
</div>
@endsection

