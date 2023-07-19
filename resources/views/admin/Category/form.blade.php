<div class="row mt-5">
    <div class="col-md-6">
        {!! Form::label("category_name", "Category_name :") !!}
        {!! Form::text("category_name",null, ['class' => 'form-control mt-2']) !!}
        {!! $errors->first("category_name",'<span class="text-danger">:message</span>') !!}
    </div>
    <div class="col-6 mt-2">
        {!! Form::label("category_parent_id", "Select Category Name: ") !!}
        {!! Form::select('category_parent_id',$category_parent_id, null, ['placeholder' => 'Select Category...', 'class' => 'form-select mt-2']) !!}
        {!! $errors->first("category_parent_id",'<span class="text-danger">:message</span>') !!}
    </div>
    <div class="d-flex bd-highlight mb-3 mt-3">
        {!! Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
    </div>
</div>
