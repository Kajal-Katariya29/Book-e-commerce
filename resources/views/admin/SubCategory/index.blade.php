@extends('admin.app')

@section('title')
    Sub Category Listing
@endsection

@section('body')

<div class="container-fluid">
    <div class="row m-5">
        <div class="d-flex bd-highlight">
            <div class="me-auto p-2 bd-highlight fs-2">Book-e-Sale</div>
            <div class="p-2 bd-highlight">
                <a href="{{ route('sub-categories.create') }}" class="btn btn-success"> ADD Sub Category</a>
            </div>
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
        <th>Sub_Category_name</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($categoryDetails as $categoryDetail)
        <tr>
            <td>{{ $categoryDetail->cateogery_id }}</td>
            <td>{{ $categoryDetail->category_name }}</td>
            <td>
                <a class="btn btn-info" href="{{ route('categories.edit',$categoryDetail->cateogery_id) }}" id="edit{{ $categoryDetail->cateogery_id }}">Edit</a>
                {!! Form::open(['route' => ['categories.destroy',$categoryDetail->cateogery_id], 'method' => 'DELETE']) !!}
                {!! Form::token() !!}
                    {!! Form::submit('Delete',['class'=> 'btn btn-danger']) !!}
                {!! Form::close() !!}
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

