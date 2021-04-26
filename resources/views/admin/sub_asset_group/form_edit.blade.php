<div class="form-group{{ $errors->has('sub_asset_group_name') ? 'has-error' : ''}}">

    <!-- <br> -->

    {!! Form::label('sub_asset_group_name', 'Asset Group Name', ['class' => 'control-label']) !!}
    {!! Form::text('foreign_asset_group[asset_group_name]', null,('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'readonly' => 'readonly'] : ['class' => 'form-control', 'readonly' => 'readonly']) !!}

    <br>
    {!! Form::label('sub_asset_group_name', 'Sub Asset Group Name', ['class' => 'control-label']) !!}
    {!! Form::text('sub_asset_group_name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}

    {!! $errors->first('sub_asset_group_name', '<p class="help-block">:message</p>') !!}

    <!-- <br> -->

</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>