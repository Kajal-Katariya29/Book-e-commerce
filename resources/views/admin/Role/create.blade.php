@extends('admin.app')

@section('title')
    Add Role
@endsection

@section('body')

<div class="container-fluid m-5">
    <h1 class="mt-4"> Add Roles </h1>
</div>
<div class="row m-5">
    {!! Form::open(['route' => 'roles.store', "method" => "post"]) !!}
    {!! Form::token() !!}
        @include('admin.Role.form')
    {!! Form::close() !!}
</div>

@endsection

@section('scripts')

@endsection
