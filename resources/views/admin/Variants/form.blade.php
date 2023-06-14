
<div class="col-12 mt-3">
    {!! Form::label("variant_type", "Variant Type:") !!}
    {!! Form::text("variant_type", null, ['class' => 'form-control variant_type', 'id' => 'variant_type']) !!}
    {!! $errors->first("variant_type",'<span class="text-danger">:message</span>') !!}
</div>
<div class="mt-3">
    {!! Form::submit('save',['type' => 'submit', 'class' => 'btn btn-primary']) !!}
</div>
