<!DOCTYPE html>
<html lang="en">
    @include('admin.layouts.head')
    <body>
        <main>
            @yield('body')
        </main>
        @include('admin.layouts.scripts')
        @yield('scripts')
    </body>
</html>


{{-- $(document).ready(function(){
    $('#parentCategory').trigger('change');
})
$('#parentCategory').on("change",function(){
    var categoryId = $(this).val();
    $('#addSubCategory').html("");
    var subCate = $('#sub_category_id_0').val();
    fetchCategories(categoryId,subCate);
});

$(document).on("change", ".subcategoryDropdown", function() {
    var categoryId = $(this).val();
    var subCate = $('#sub_sub_category_id').val();
    var subCate = $('#sub_category_id_' + index).val();
    fetchCategories(categoryId,subCate);
});

function fetchCategories(categoryId,selectedId=0){
    $.ajax({
        url: "/admin/fetch-category",
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
                subDropDownList.last().val(selectedId)
                subDropDownList.last().trigger('change')
            },

        error: function (msg) {
            console.log(msg);
        }
    });
} --}}



