@extends('admin.app')

@section('title')
    Edit Books
@endsection

@section('body')
    <div class="container-fluid m-5">
        <h1 class="mt-4"> Edit BookDetail </h1>
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
        {!! Form::model($bookData, [
            'route' => ['books.update', $bookData->book_id],
            'method' => 'PATCH',
            'enctype' => 'multipart/form-data',
        ]) !!}
        {!! Form::token() !!}
        @include('admin.BookList.form')
        {!! Form::close() !!}
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $(document).on("click", '.rowAdd', function() {
                $('#inputVariant').append('<tr>' + $('#inputVariant').find('tr:last').html() + '</tr>')
            });

            $(document).on("click", ".removeEditedRow", function() {
                $(this).parent().parent().remove();
                var value = $(this).closest('tr').find('.variant_mapping_id').val()
                var removeValue = $('#removed_variant_mapping_id').val()
                if (removeValue == '') {
                    removeValue = value;
                } else {
                    removeValue = removeValue + "," + value;
                }
                $('#removed_variant_mapping_id').val(removeValue)
            });

            $('.deleteImage').on('click', function() {
                var ImageId = $(this).data('image-id');
                var routeUrl = "/admin/delete-image/" + ImageId;
                console.log(routeUrl);

                $.ajax({
                    url: routeUrl,
                    type: "POST",
                    data: {
                        image_id: ImageId,
                        method: "DELETE",
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(textStatus);
                    }
                });
            });

            $(document).ready(function(){
                $('#parentCategory').trigger('change');
            })

            $('#parentCategory').on("change",function(){
                var parentCategoryId = $('#parentCategory').val();
                $('#addSubCategory').html("");
                fetchCategories(parentCategoryId, $('.forIndex:first').val());
            });

            function fetchCategories(categoryId, selectedId = 0) {
                if (categoryId && $('.forIndex').length) {
                    $.ajax({
                        url: "/admin/fetch-category",
                        type: "POST",
                        data: {
                            categoryId: categoryId,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(result) {
                            if (result.length > 0) {
                                var newDiv = $('<div class="col-md-6 mt-2">' +
                                    '{!! Form::label('subCategory_name', 'Select Sub Category Name: ') !!}' +
                                    '<select name="subCategory_name[]" class="form-control mt-2 subcategoryDropdown"></select>' +
                                    '{!! $errors->first('subCategory_name', '<span class="text-danger">:message</span>') !!}' +
                                    '</div>');

                                $('#addSubCategory').append(newDiv);

                                var subDropDownList = $('.subcategoryDropdown');

                                subDropDownList.last().append(
                                    '<option value="">Select Sub Category</option>');
                                $.each(result, function(index, category) {
                                    subDropDownList.last().append('<option value="' + category
                                        .cateogery_id + '">' + category.category_name +
                                        '</option>');
                                });
                            }
                            $('.subcategoryDropdown:last').val(selectedId);
                            $('.forIndex:first').remove()
                            fetchCategories(selectedId,$('.forIndex:first').val());
                        },
                        error: function(msg) {
                            console.log(msg);
                        }
                    });
                }

            }
        });
    </script>
@endsection
