@extends('admin.app')

@section('title')
    Role Listing
@endsection

@section('body')

<div class="container-fluid">
    <div class="row m-5">
        <div class="d-flex bd-highlight">
            <div class="me-auto p-2 bd-highlight fs-2">Book-e-Sale</div>
            <div class="p-2 bd-highlight">
                <a href="{{ route('permissions.create') }}" class="btn btn-success"> ADD Permission </a>
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
        <th>Permission</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($permissions as $permission)
        <tr>
            <td>{{ $permission->permission_id }}</td>
            <td>{{ $permission->p_name }}</td>
            <td>
                <a class="btn btn-info" href="{{ route('permissions.edit',$permission->permission_id) }}">Edit</a>
                {!! Form::open(['route' => ['permissions.destroy',$permission->permission_id], 'method' => 'DELETE']) !!}
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

