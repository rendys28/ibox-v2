@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Sub Asset Group {{ $assetmaster->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('admin/asset-master') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('admin/asset-master/' . $assetmaster->id . '/edit') }}" title="Edit Asset Group"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/asset-master', $assetmaster->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Asset Group',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>

                                    <tr>
                                        <th>ID</th><td>{{ $assetmaster->id }}</td>
                                    </tr>

                                    <tr>
                                        <th> Material Number </th><td> {{ $assetmaster->material_number }} </td>
                                    </tr>

                                    <tr>
                                        <th> Material Description </th><td> {{ $assetmaster->material_description }} </td>
                                    </tr>

                                    <tr>
                                        <th> Brand </th><td> {{ $assetmaster->brand }} </td>
                                    </tr>
                                   
                                    <tr>
                                        <th> Category </th><td> {{ $assetmaster->category }} </td>
                                    </tr>
                                   
                                    <tr>
                                        <th> Asset Group </th><td> {{ $assetmaster->foreign_asset_group->asset_group_name }} </td>
                                    </tr>

                                    <tr>
                                        <th>Sub Asset Group</th><td>{{ $assetmaster->foreign_sub_asset_group->sub_asset_group_name }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
