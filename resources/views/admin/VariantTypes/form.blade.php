<div class="row mt-5">
    <div class="col-md-6">
        {!! Form::label("variant_name", "Variant Name :") !!}
        {!! Form::select('size',['L' => 'Large']) !!}
    </div>
    <div class="col-md-6">
        {!! Form::label("variant_type_name", "Variant Type Name :") !!}
        {!! Form::text("variant_type_name", null, ['class' => 'form-control variantTypeName', 'id' => 'variantTypeName']) !!}
        {!! $errors->first("variant_type_name",'<span class="text-danger">:message</span>') !!}
    </div>
    <div class="mt-2">
        {!! Form::submit('Save',['type' => 'submit', 'class' => 'btn btn-primary']) !!}
    </div>
</div>
