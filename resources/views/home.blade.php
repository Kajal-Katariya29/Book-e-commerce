@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="d-flex flex-row bd-highlight mt-3 col-md-9">
                <a href="{{route('books.index')}}" class="btn btn-primary text-decoration-none text-white p-2 bd-highlight me-3">BookDetail</a>
                @can('book.create')
                    <a href="{{route('variants.index')}}" class="btn btn-secondary text-decoration-none text-white p-2 bd-highlight me-3">Add Variants</a>
                    <a href="{{route('variant-type.index')}}" class="btn btn-success text-decoration-none text-white p-2 bd-highlight me-3">Add Variant-Type</a>
                    <a href="{{route('categories.index')}}" class="btn btn-danger text-decoration-none text-white p-2 bd-highlight me-3">Add Categories</a>
                    <a href="{{route('roles.index')}}" class="btn btn-warning text-decoration-none text-white p-2 bd-highlight me-3">Add Roles</a>
                    <a href="{{route('permissions.index')}}" class="btn btn-info text-decoration-none text-white p-2 bd-highlight me-3">Add Permissions</a>
                    <a href="{{route('role-user.index')}}" class="btn btn-light text-decoration-none text-success p-2 bd-highlight me-3">Add Role-User</a>
                    <a href="{{route('role-permission.index')}}" class="btn btn-dark text-decoration-none text-white p-2 bd-highlight me-3">Add Role-Permission</a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
