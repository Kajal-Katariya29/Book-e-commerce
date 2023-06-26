
<div class="row m-4" id="subCategories">
    <div class="col-md-6">
        {!! Form::label("name", "Book Name :") !!}
        {!! Form::text("name", null, ['class' => 'form-control bookname', 'id' => 'bookname']) !!}
        {!! $errors->first("name",'<span class="text-danger">:message</span>') !!}
    </div>
    <div class="col-md-6">
        {!! Form::label("author", "Book Author :") !!}
        {!! Form::text("author",null, ['class' => 'form-control author', 'id' => 'author']) !!}
        {!! $errors->first("author",'<span class="text-danger">:message</span>') !!}
    </div>
    <div class="col-12">
        {!! Form::label("description", "Book Description :") !!}
        {!! Form::textarea("description", null, ['class' => 'form-control description', 'id' => 'description']) !!}
        {!! $errors->first("description",'<span class="text-danger">:message</span>') !!}
    </div>
    <div class="col-12 mt-2">
        {!! Form::label("variantType", "Variant Type : ") !!}
        <a class="btn btn-secondary" id="addVariants">Add Varaints</a>
        <table class="table table-bordered mt-3">
            <tr>
                <th>Varint :</th>
                <th>Variant Type :</th>
                <th>Amout: </th>
                <th>Action</th>
            </tr>
            <tr id="inputVariant" style="display: none;">
                <td>
                    {!! Form::select('variant_id',$variant_type, $bookData ? $bookData->variants->pluck('variant_id') : null, ['placeholder' => 'Select Variant...', 'class' => 'form-select mt-2']) !!}
                </td>
                <td>
                    {!! Form::select('variant_type_name', $variant_type_name, $bookData ? $bookData->variants->pluck('variant_type_id') : null, ['placeholder' => 'Select Variant...','class' => 'form-select mt-2']) !!}
                </td>
                <td>
                    {!! Form::text("price", null, ['class' => 'form-control price mt-1', 'id' => 'price']) !!}
                </td>
                <td>
                    <button type="button" class="btn btn-secondary rowDelete" id="rowDelete">-</button>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-6 mt-3">
        {!! Form::label('images', 'Book Images:') !!}
        {!! Form::file('images[]', ['class' => 'form-control', 'id' => 'images', 'multiple' => true]) !!}
        {!! $errors->first("images",'<span class="text-danger">:message</span>') !!}
        @if (!empty($bookData && $bookData->bookMedia))
            @foreach ($bookData->bookMedia as $media)
                <div class="mt-3 me-3" style="position: relative; display: inline-block;">
                    <img src="{{ asset('images/Book-Images/' .$media->book_id.'/'.$media->media_name) }}" alt="{{ $media->image_path }}" width="100" height="100" class="mt-3">
                    <span class="close deleteImage" style="position: absolute; top: 0; right: 0; z-index: 1; cursor: pointer; font-size: 30px; color:aqua;"
                        data-image-id="{{ $media->book_media_id }}">&times;</span>
                </div>
            @endforeach
        @endif
    </div>
    <div class="col-6 mt-2">
        {!! Form::label("category_name", "Select Category Name: ") !!}
        {!! Form::select('category_name',$category_name, null, ['placeholder' => 'Select Category...', 'class' => 'form-select mt-2','id' => 'mainSelect']) !!}
        {!! $errors->first("category_name",'<span class="text-danger">:message</span>') !!}
    </div>
    <div id="addSubCategory">

    </div>
</div>
<div id="subCatConatiner">
@if (!empty($subCatData))
    <div class="col-6 ms-4">
        {!! Form::label("subCategory_name", "Select Sub Category Name: ") !!}
        {!! Form::select('subCategory_name',$subCatData, null, ['placeholder' => 'Select sub category..','class' => 'form-select mt-2','id' => 'categorySelect']) !!}
        {!! $errors->first("subCategory_name",'<span class="text-danger">:message</span>') !!}
    </div>
@endif
@if (!empty($subCategory))
    <div class="col-6 ms-4">
        {!! Form::label("subCategory_name", "Select Sub Category Name: ") !!}
        {!! Form::select('subCategory_name',$subCategory, $bookData ? $bookData->categories->pluck('cateogery_id') : null, ['placeholder' => 'Select sub category..',' class' => 'form-select mt-2','id' => 'categorySubSelect']) !!}
        {!! $errors->first("subCategory_name",'<span class="text-danger">:message</span>') !!}
    </div>
@endif
</div>
<div class="d-flex bd-highlight mb-3 m-5">
    {!! Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
</div>

