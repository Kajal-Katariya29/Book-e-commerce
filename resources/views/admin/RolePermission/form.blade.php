<div class="row mt-5">
    <div class="col-6 mt-2">
        {!! Form::label("role_id", "Select Role : ") !!}
        {!! Form::select('role_id',$role, null, ['placeholder' => 'Select Role...', 'class' => 'form-select mt-2']) !!}
        {!! $errors->first("role_id",'<span class="text-danger">:message</span>') !!}
    </div>
    <div class="col-6 mt-2">
        {!! Form::label("permission_id", "Select Permission: ") !!}
        {!! Form::select('permission_id',$permission, null, ['placeholder' => 'Select Permission...', 'class' => 'form-select mt-2']) !!}
        {!! $errors->first("permission_id",'<span class="text-danger">:message</span>') !!}
    </div>
    <div class="mt-2">
        {!! Form::submit('Save',['type' => 'submit', 'class' => 'btn btn-primary']) !!}
    </div>
</div>
