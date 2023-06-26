@extends('admin.app')

@section('titile')

    Edit Role User

@endsection

@section('body')

<div class="container-fluid m-5">
    <h1 class="mt-4"> Edit Role User Data </h1>
</div>
<div class="row m-5">
    {!! Form::model($roleUserData, ['route' => ['role-user.update', $roleUserData->role_user_id], 'method' => 'PATCH']) !!}
    {!! Form::token() !!}
        @include('admin.RoleUser.form')
    {!! Form::close() !!}
</div>

@endsection

@section('scripts')

@endsection
