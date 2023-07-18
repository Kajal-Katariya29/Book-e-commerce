@extends('admin.app')

@section('title')
    Book Listing
@endsection

@section('body')

<div class="container-fluid">
    <div class="row m-5">
        <div class="d-flex bd-highlight">
            <div class="me-auto p-2 bd-highlight fs-2">Book-e-Sale</div>
            {{-- @can('book.create') --}}
                <div class="p-2 bd-highlight">
                    <a href="{{ route('books.create') }}" class="btn btn-success"> ADD Books </a>
                </div>
            {{-- @endcan --}}
        </div>
    </div>
</div>
<div class="row">
    @if (Session::has('success'))
        <div class="alert alert-success message" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
</div>
<table class="table table-bordered m-5">
    <tr>
        <th>No</th>
        <th>Book_name</th>
        <th>Book_Description</th>
        <th>Book_author</th>
        {{-- @can('book.create') --}}
            <th width="280px">Action</th>
        {{-- @endcan --}}
    </tr>
    @foreach ($bookDetails as $bookDetail)
        <tr>
            <td>{{ $bookDetail->book_id }}</td>
            <td>{{ $bookDetail->name }}</td>
            <td>{{ $bookDetail->description }}</td>
            <td>{{ $bookDetail->author }}</td>
            <td>
                {{-- @can('book.update') --}}
                    <a class="btn btn-info" href="{{ route('books.edit',$bookDetail->book_id) }}" id="edit{{ $bookDetail->book_id }}">Edit</a>
                {{-- @endcan --}}
                {{-- @can('book.delete') --}}
                    {!! Form::open(['route' => ['books.destroy',$bookDetail->book_id], 'method' => 'DELETE']) !!}
                    {!! Form::token() !!}
                        {!! Form::submit('Delete',['class'=> 'btn btn-danger', 'dusk' => "delete_{$bookDetail->book_id}"]) !!}
                    {!! Form::close() !!}
                {{-- @endcan --}}

            </td>
        </tr>
    @endforeach
</table>
@endsection

@section('scripts')
    <script>
        $(".message").delay(2300).slideUp(1000);
    </script>
@endsection

