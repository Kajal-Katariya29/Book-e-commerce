@extends('admin.app')

@section('titile')

    Add Variant

@endsection

@section('body')

<div class="container-fluid m-5">
    <h1 class="mt-4"> Edit Variants </h1>
</div>
<div class="row m-5">
    {!! Form::model($variantData, ['route' => ['variants.update', $variantData->variant_id], 'method' => 'PATCH']) !!}
    {!! Form::token() !!}
        @include('admin.Variants.form')
    {!! Form::close() !!}
</div>

@endsection

@section('scripts')

@endsection
