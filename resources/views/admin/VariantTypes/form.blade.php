<div class="row mt-5">
    <div class="col-6 mt-2">
        {!! Form::label("variant_id", "Select Variant Name: ") !!}
        {!! Form::select('variant_id',$variant_type, null, ['placeholder' => 'Select Variant...', 'class' => 'form-select mt-2']) !!}
        {!! $errors->first("variant_id",'<span class="text-danger">:message</span>') !!}
    </div>
    <div class="col-6 mt-2">
        {!! Form::label("variant_type_name", "Variant Type Name :") !!}
        {!! Form::text("variant_type_name", null, ['class' => 'form-control variantTypeName', 'id' => 'variantTypeName']) !!}
        {!! $errors->first("variant_type_name",'<span class="text-danger">:message</span>') !!}
    </div>
    <div class="mt-2">
        {!! Form::submit('Save',['type' => 'submit', 'class' => 'btn btn-primary']) !!}
    </div>
</div>
