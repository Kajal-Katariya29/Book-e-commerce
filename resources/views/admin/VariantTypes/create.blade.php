@extends('admin.app')

@section('title')
    Variant Types
@endsection

@section('body')
<div class="container-fluid m-5">
    <h1 class="mt-4"> Add Variant Types </h1>
</div>
<div class="row m-5">
    {!! Form::open(['route' => 'variant-type.store', "method" => "post"]) !!}
    {!! Form::token() !!}
        @include('admin.VariantTypes.form')
    {!! Form::close() !!}
</div>
@endsection

@section('scripts')

@endsection
