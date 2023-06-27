@extends('admin.app')

@section('titile')

    Edit Permission Detail

@endsection

@section('body')

<div class="container-fluid m-5">
    <h1 class="mt-4"> Edit Permission Detail </h1>
</div>
<div class="row m-5">
    {{-- @php
        dd($variantData);
    @endphp --}}
    {!! Form::model($permissionData, ['route' => ['permissions.update', $permissionData->permission_id], 'method' => 'PATCH']) !!}
    {!! Form::token() !!}
        @include('admin.Permission.form')
    {!! Form::close() !!}
</div>

@endsection

@section('scripts')

@endsection
