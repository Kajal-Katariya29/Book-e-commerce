@extends('admin.app')

@section('titile')

    Add Variant

@endsection

@section('body')

<div class="container-fluid m-5">
    <h1 class="mt-4"> Edit Variants </h1>
</div>
<div class="row m-5">
    {{-- @php
        dd($variantData);
    @endphp --}}
    {!! Form::model($variantTypeData, ['route' => ['variant-type.update', $variantTypeData->variant_type_id], 'method' => 'PATCH']) !!}
    {!! Form::token() !!}
        @include('admin.variantTypes.form')
    {!! Form::close() !!}
</div>

@endsection

@section('scripts')

@endsection
