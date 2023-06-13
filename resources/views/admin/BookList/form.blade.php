
<div class="row m-5">
    <div class="col-md-4">
        {!! Form::label("name", "Book Name :") !!}
        {!! Form::text("name", null, ['class' => 'form-control bookname', 'id' => 'bookname']) !!}
        {!! $errors->first("name",'<span class="text-danger">:message</span>') !!}
    </div>
    <div class="col-md-4">
        {!! Form::label("author", "Book Author :") !!}
        {!! Form::text("author",null, ['class' => 'form-control author', 'id' => 'author']) !!}
        {!! $errors->first("author",'<span class="text-danger">:message</span>') !!}
    </div>
    <div class="col-md-4">
        {!! Form::label("price", "Book Price :") !!}
        {!! Form::text("price", null, ['class' => 'form-control price', 'id' => 'price']) !!}
        {!! $errors->first("price",'<span class="text-danger">:message</span>') !!}
    </div>
    <div class="col-12">
        {!! Form::label("description", "Book Description :") !!}
        {!! Form::textarea("description", null, ['class' => 'form-control description', 'id' => 'description']) !!}
        {!! $errors->first("description",'<span class="text-danger">:message</span>') !!}
    </div>
    <div class="col-4 mt-3">
        {!! Form::label("images","Book Images:") !!}
        {!! Form::file('images[]',null , ['class' => 'form-control images', 'id' => 'images', 'multiple' => true]) !!}
        {!! $errors->first("images",'<span class="text-danger">:message</span>') !!}
    </div>
    {{-- <div class="col-4 mt-3">
        {!! Form::label("varianttype" ,"Variant Type:") !!}
        {!! Form::text("varianttype",null,['class' => 'form-control varianttype', 'id' => 'varianttype']) !!}
        {!! $errors->first("varianttype",'<span class="text-danger">:message</span>') !!}
    </div>
    <div class="col-4 mt-3">
        {!! Form::label("varianttypename" ,"Variant Type Name:") !!}
        {!! Form::text("varianttypename",null,['class' => 'form-control varianttypename', 'id' => 'varianttypename']) !!}
        {!! $errors->first("varianttypename",'<span class="text-danger">:message</span>') !!}
    </div> --}}
    <div class="d-flex bd-highlight mb-3 mt-3">
        {!! Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
    </div>
</div>

