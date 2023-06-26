
@extends('admin.app')

@section('title')
    Add Role User
@endsection

@section('body')

<div class="container-fluid m-5">
    <h1 class="mt-4"> Add Role User</h1>
</div>
<div class="row m-5">
    {!! Form::open(['route' => 'role-user.store', "method" => "post"]) !!}
    {!! Form::token() !!}
        @include('admin.RoleUser.form')
    {!! Form::close() !!}
</div>

@endsection

@section('scripts')

@endsection
