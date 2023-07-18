@extends('admin.app')

@section('title')
    Variant Listing
@endsection

@section('body')

<div class="container-fluid">
    <div class="row m-5">
        <div class="d-flex bd-highlight">
            <div class="me-auto p-2 bd-highlight fs-2">Book-e-Sale</div>
            <div class="p-2 bd-highlight">
                <a href="{{ route('variants.create') }}" class="btn btn-success"> ADD Varints </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    @if (Session::has('success'))
        <div class="alert alert-success message" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
</div>
<table class="table table-bordered m-5">
    <tr>
        <th>No</th>
        <th>Variant_type</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($variants as $variant)
        <tr>
            <td>{{ $variant->variant_id }}</td>
            <td>{{ $variant->variant_type }}</td>
            <td>
                <a class="btn btn-info" href="{{ route('variants.edit',$variant->variant_id) }}" id="edit{{ $variant->variant_id }}">Edit</a>
                {!! Form::open(['route' => ['variants.destroy',$variant->variant_id], 'method' => 'DELETE']) !!}
                    {!! Form::submit('Delete',['class'=> 'btn btn-danger', 'dusk' => "delete_{$variant->variant_id}" ]) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
</table>
@endsection

@section('scripts')
    <script>
        $(".message").delay(2300).slideUp(1000);
    </script>
@endsection

