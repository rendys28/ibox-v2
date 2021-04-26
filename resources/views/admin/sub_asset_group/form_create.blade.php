<div class="form-group{{ $errors->has('sub_asset_group_name') ? 'has-error' : ''}}">

    <label class="control-label"> Asset Group </label>
    <select class="form-control" name="asset_group_id" id="exampleFormControlSelect1">

        <option selected disabled>Select Asset Group</option>
        @foreach($assetgroups as $assetgroup)
        <option value="{{ $assetgroup->id }}"> {{ $assetgroup->asset_group_name }} </option>
        @endforeach

    </select>

    <br>
    <label class="control-label"> Sub Asset Group </label>
    <input type="text" name="sub_asset_group_name" class="form-control">

    {!! $errors->first('sub_asset_group_name', '<p class="help-block">:message</p>') !!}

    <!-- <br> -->

</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>