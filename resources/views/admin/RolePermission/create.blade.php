@extends('admin.app')

@section('title')
    Add Role Permissions
@endsection

@section('body')

<div class="container-fluid m-5">
    <h1 class="mt-4"> Add Role Permissions </h1>
</div>
<div class="row m-5">
    {!! Form::open(['route' => 'role-permission.store', "method" => "post"]) !!}
    {!! Form::token() !!}
        @include('admin.RolePermission.form')
    {!! Form::close() !!}
</div>

@endsection

@section('scripts')

@endsection
