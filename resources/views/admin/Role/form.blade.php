<div class="col-12 mt-3">
    {!! Form::label("name", "Name :") !!}
    {!! Form::text("name", null, ['class' => 'form-control name', 'id' => 'name']) !!}
    {!! $errors->first("name",'<span class="text-danger">:message</span>') !!}
</div>
<div class="mt-3">
    {!! Form::submit('save',['type' => 'submit', 'class' => 'btn btn-primary']) !!}
</div>
