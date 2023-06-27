@extends('admin.app')

@section('titile')

    Edit Role Detail

@endsection

@section('body')

<div class="container-fluid m-5">
    <h1 class="mt-4"> Edit Role Detail </h1>
</div>
<div class="row m-5">
    {{-- @php
        dd($variantData);
    @endphp --}}
    {!! Form::model($roleData, ['route' => ['roles.update', $roleData->role_id], 'method' => 'PATCH']) !!}
    {!! Form::token() !!}
        @include('admin.Role.form')
    {!! Form::close() !!}
</div>

@endsection

@section('scripts')

@endsection
