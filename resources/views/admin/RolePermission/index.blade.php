@extends('admin.app')

@section('title')
    Role Permission Listing
@endsection

@section('body')

<div class="container-fluid">
    <div class="row m-5">
        <div class="d-flex bd-highlight">
            <div class="me-auto p-2 bd-highlight fs-2">Book-e-Sale</div>
            <div class="p-2 bd-highlight">
                <a href="{{ route('role-permission.create') }}" class="btn btn-success"> ADD Role Permission</a>
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
        <th>Role</th>
        <th>Permission</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($rolePermissions as $rolePermission)
        <tr>
            <td>{{ $rolePermission->role_permission_id }}</td>
            <td>{{ $rolePermission->role->name }}</td>
            <td>{{ $rolePermission->permission->p_name }}</td>
            <td>
                <a class="btn btn-info" href="{{ route('role-permission.edit',$rolePermission->role_permission_id ) }}">Edit</a>
                {!! Form::open(['route' => ['role-permission.destroy',$rolePermission->role_permission_id], 'method' => 'DELETE']) !!}
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

