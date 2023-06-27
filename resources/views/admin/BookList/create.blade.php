@extends('admin.app')

@section('title')
    Add Books
@endsection

@section('body')
<div class="container-fluid m-5">
    <h1 class="mt-4"> Add BookDetail </h1>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row m-5">
    {!! Form::open(['route' => 'books.store', "method" => "post", 'enctype' => 'multipart/form-data']) !!}
    {!! Form::token() !!}
        @include('admin.BookList.form', ['bookData' => null])
    {!! Form::close() !!}
</div>
@endsection

@section('scripts')

<script>

    $(document).ready(function(){

        $('.rowAdd').on("click",function(){
            // newRowAdd =
            // '<tr><td> {!! Form::select('variant_id[]',$variant_type, null, ['placeholder' => 'Select Variant...', 'class' => 'form-select mt-2']) !!}</td>' +
            // '<td>{!! Form::select('variant_type_name[]', $variant_type_name, null, ['placeholder' => 'Select Variant...','class' => 'form-select mt-2']) !!}</td>' +
            // '<td>{!! Form::text("price[]", null, ['class' => 'form-control price mt-1']) !!}</td>' +
            // '<td> <button type="button" class="btn btn-secondary rowDelete" id="rowAdd">-</button> </tr>';
                $('#inputVariant').append('<tr>'+$('#inputVariant').find('tr:last').html()+'</tr>')
        });

        $(document).on("click", ".rowDelete", function() {
            $(this).parent().parent().remove();
        });

        $('.select2').select2();

        $('#mainSelect').on("change",function(){
            var categoryId = $(this).val();
            $('#addSubCategory').html("");
            fetchCategories(categoryId);
        });

        $(document).on("change", ".subcategoryDropdown", function() {
            var categoryId = $(this).val();
            fetchCategories(categoryId);
        });

        function fetchCategories(categoryId){
            $.ajax({
                url: "/fetch-category",
                type: "POST",
                data: {
                    categoryId: categoryId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result){
                    if(result.length > 0){
                        var newDiv = $('<div class="col-md-6 mt-2">' +
                            '{!! Form::label("subCategory_name", "Select Sub Category Name: ") !!}' +
                            '{!! Form::select("subCategory_name", [], null, ["class" => "form-control mt-2 subcategoryDropdown", "id" => ""]) !!}' +
                            '{!! $errors->first("subCategory_name", '<span class="text-danger">:message</span>') !!}' +
                            '</div>');

                        $('#addSubCategory').append(newDiv);

                        var subDropDownList = $('.subcategoryDropdown');

                        subDropDownList.last().append('<option value="">Select Sub Category</option>');
                            $.each(result, function(index, category) {
                                subDropDownList.last().append('<option value="' + category.cateogery_id + '">' + category.category_name + '</option>');
                            });
                        }
                    else {
                    }
                },
                error: function (msg) {
                    console.log(msg);
                }
            });
        }
    });

</script>

@endsection
