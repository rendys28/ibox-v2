<div class="form-group{{ $errors->has('sub_asset_group_name') ? 'has-error' : ''}}">

    <label class="control-label"> POP Master </label>
    <select class="form-control" name="pop_master_id" id="exampleFormControlSelect1">

        <option selected disabled>Select POP Master</option>
        @foreach($popmaster as $pop)
        <option value="{{ $pop->id }}">{{ $pop->pop_name }}</option>
        @endforeach

    </select> <br>

    <label class="control-label"> Asset Group </label>
    <select class="form-control" id="asset_group" name="asset_group_id" id="exampleFormControlSelect1">

        <option selected disabled>Select Asset Group</option>
        @foreach($assetgroups as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
        @endforeach

    </select> <br>

    <label class="control-label"> Sub Asset Group </label>
    <select name="sub_asset_group_id" id="sub_asset_group" class="form-control">
        <option disabled selected>--Select Sub Asset--</option>
    </select> <br>

    <label class="control-label"> Asset Master </label>
    <select name="asset_master" class="form-control">
        <option disabled selected>--Select Asset Master--</option>
    </select>

    {!! $errors->first('sub_asset_group_name', '<p class="help-block">:message</p>') !!}

</div>

<script type="application/javascript" src="//code.jquery.com/jquery-2.2.0.min.js"></script>

<script type="application/javascript">
    jQuery(document).ready(function() {
        jQuery('select[name="asset_group_id"]').on('change', function() {
            var assetgroupID = jQuery(this).val();
            if (assetgroupID) {
                jQuery.ajax({
                    url: '/ibox-v2/public/admin/asset-master/js/' + assetgroupID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        jQuery('select[name="sub_asset_group_id"]').empty();
                        jQuery.each(data, function(key, value) {
                            $('select[name="sub_asset_group_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="sub_asset_group_id"]').empty();
            }
        });
    });
</script>

<script type="application/javascript">
    jQuery(document).ready(function() {
        jQuery('select[name="sub_asset_group_id"]').on('change', function() {
            var assetgroupID = jQuery(this).val();
            if (assetgroupID) {
                jQuery.ajax({
                    url: '/ibox-v2/public/admin/pm-pop/js/' + assetgroupID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        jQuery('select[name="asset_master"]').empty();
                        jQuery.each(data, function(key, value) {
                            $('select[name="asset_master"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="asset_master"]').empty();
            }
        });
    });
</script>

<div class="setDataWrap">
    <!-- <button id="getXML" type="button">Get XML Data</button> -->
    <button id="getJSON" class="btn btn-primary" type="button">Get JSON Data</button>
    <!-- <button id="getJS" type="button">Get JS Data</button> -->
</div> <br>
<input id="isiJSON" type="text" class="form-control"> <br>
<!-- <input id="konvertJSON" type="text" class="form-control"> <br> -->
<div id="build-wrap"></div>
<div id="form-output"></div>

<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="application/javascript" src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
<script type="application/javascript">
    jQuery(function($) {
        var fbEditor = document.getElementById('build-wrap');
        var isiJSON = document.getElementById('isiJSON');
        // var konvertJSON = document.getElementById('konvertJSON');
        var formBuilder = $(fbEditor).formBuilder();

        // document.getElementById('getXML').addEventListener('click', function() {
        //     alert(formBuilder.actions.getData('xml'));
        // });

        document.getElementById('getJSON').addEventListener('click', function() {
            // alert(formBuilder.actions.getData('json'));
            isiJSON.value = formBuilder.actions.getData('json')
            // konvertJSON.value = JSON.stringify(isiJSON.value);
        });

        // document.getElementById('getJS').addEventListener('click', function() {
        //     alert('check console');
        //     console.log(formBuilder.actions.getData());
        // });
    });
</script>
<script type="application/javascript">
    $('.form-output').formRender({
        formData: `[
        {
            "type":"button","label":"Button","subtype":"button","className":"btn-default btn","name":"button-1618903101720","access":false,"style":"default
        }
      ]`,
        dataType: 'json',
        render: true
    });
</script>
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>