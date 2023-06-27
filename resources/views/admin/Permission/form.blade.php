<div class="col-12 mt-3">
    {!! Form::label("p_name", "Name :") !!}
    {!! Form::text("p_name", null, ['class' => 'form-control name', 'id' => 'name']) !!}
    {!! $errors->first("p_name",'<span class="text-danger">:message</span>') !!}
</div>
<div class="mt-3">
    {!! Form::submit('save',['type' => 'submit', 'class' => 'btn btn-primary']) !!}
</div>
