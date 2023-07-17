@extends('admin.app')

@section('title')
    Add Sub Category
@endsection

@section('body')
<div class="container-fluid m-5">
    <h1 class="mt-4"> Add Sub Sub CategoryDetail </h1>
</div>
<div class="row m-5">
    {!! Form::open(['route' => 'sub-sub-categories.store', "method" => "post"]) !!}
    {!! Form::token() !!}
        @include('admin.SubSubCategory.form')
    {!! Form::close() !!}
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $("#category_parent_parent_id").on("change", function() {
        var categoryParentId = $(this).val();
        console.log(categoryParentId);
        $("#category_parent_id").html("");
            $.ajax({
                url: "/admin/fetch-category",
                type: "POST",
                data: {
                    category_parent_parent_id: categoryParentId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    $("#category_parent_id").html('<option value="">Select Sub Category</option>');
                    $.each(result, function(key, value) {
                        $("#category_parent_id").append(
                            '<option value="' +
                            value.cateogery_id +
                            '">' +
                            value.category_name +
                            "</option>"
                        );
                    });
                },
                error: function(msg) {
                    console.log(msg);
                },
            });
        });
    });
</script>
@endsection
