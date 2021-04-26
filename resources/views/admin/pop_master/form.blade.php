<div class="form-group{{ $errors->has('asset_group_name') ? 'has-error' : ''}}">

    {!! Form::label('pop_id', 'POP ID', ['class' => 'control-label']) !!}
    {!! Form::text('pop_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    <br>
    {!! Form::label('pop_name', 'POP Name', ['class' => 'control-label']) !!}
    {!! Form::text('pop_name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    <br>
    {!! Form::label('address', 'POP Address', ['class' => 'control-label']) !!}
    {!! Form::text('address', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}

    {!! $errors->first('asset_group_name', '<p class="help-block">:message</p>') !!}

    <br>

</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>