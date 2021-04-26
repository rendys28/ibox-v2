<div class="form-group{{ $errors->has('sub_asset_group_name') ? 'has-error' : ''}}">

    <label class="control-label"> Material Number</label>

    <input type="text" name="material_number"  value="{{ $assetmaster->material_number }}" class="form-control"> <br>

    <label class="control-label"> Material Description</label>

    <input type="text" value="{{ $assetmaster->material_description }}" name="material_description" class="form-control"> <br>

    <label class="control-label"> Brand </label>

    <input type="text" value="{{ $assetmaster->brand }}" name="brand" class="form-control"> <br>

    <label class="control-label"> Category </label>

    <input type="text" value="{{ $assetmaster->category }}" name="category" class="form-control"> <br>

    <label class="control-label"> Asset Group </label>
    <select class="form-control" id="asset_group" name="asset_group_id" id="exampleFormControlSelect1">

        <option disabled>Select Asset Group</option>
        <option selected value="{{ $assetmaster->foreign_asset_group->id }}">{{ $assetmaster->foreign_asset_group->asset_group_name }}</option>
        @foreach($assetgroups as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
        @endforeach

    </select> <br>

    <label class="control-label"> Sub Asset Group </label>
    <select name="sub_asset_group_id" id="sub_asset_group" class="form-control">
        <option disabled>--Select Sub Asset--</option>
        <option selected value="{{ $assetmaster->foreign_sub_asset_group->id }}">{{ $assetmaster->foreign_sub_asset_group->sub_asset_group_name }}</option>
    </select>

    {!! $errors->first('sub_asset_group_name', '<p class="help-block">:message</p>') !!}

</div>

<script type="application/javascript" src="//code.jquery.com/jquery-2.2.0.min.js"></script>

<script type="application/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="asset_group_id"]').on('change',function(){
               var assetgroupID = jQuery(this).val();
               if(assetgroupID)
               {
                  jQuery.ajax({
                     url : '/ibox-v2/public/admin/asset-master/js/' +assetgroupID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="sub_asset_group_id"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="sub_asset_group_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="sub_asset_group_id"]').empty();
               }
            });
    });
    </script>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>