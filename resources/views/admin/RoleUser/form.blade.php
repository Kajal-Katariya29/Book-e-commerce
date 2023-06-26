<div class="row mt-5">
    <div class="col-6 mt-2">
        {!! Form::label("role_id", "Select Role : ") !!}
        {!! Form::select('role_id',$role, null, ['placeholder' => 'Select Role...', 'class' => 'form-select mt-2']) !!}
        {!! $errors->first("role_id",'<span class="text-danger">:message</span>') !!}
    </div>
    <div class="col-6 mt-2">
        {!! Form::label("user_id", "Select User: ") !!}
        {!! Form::select('user_id',$user, null, ['placeholder' => 'Select User...', 'class' => 'form-select mt-2']) !!}
        {!! $errors->first("user_id",'<span class="text-danger">:message</span>') !!}
    </div>
    <div class="mt-2">
        {!! Form::submit('Save',['type' => 'submit', 'class' => 'btn btn-primary']) !!}
    </div>
</div>
