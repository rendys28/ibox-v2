<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\AssetGroup;
use App\Models\AssetMaster;
use Illuminate\Support\Facades\DB;
use App\Models\SubAssetGroup;
use Illuminate\Http\Request;

class AssetMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $assetmaster = Assetmaster::where('material_description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $assetmaster = Assetmaster::latest()->paginate($perPage);
        }

        return view('admin/asset_master/index', compact('assetmaster'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // $assetgroups = AssetGroup::all();
        $assetgroups = DB::table('asset_groups')->pluck("asset_group_name","id");
        return view('admin/asset_master/create', compact('assetgroups'));
    }

    public function getJs($id)
    {
        $subasset = DB::table("sub_asset_group")->where("asset_group_id",$id)->pluck("sub_asset_group_name","id");
        return json_encode($subasset);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        Assetmaster::create($requestData);

        return redirect('admin/asset-master')->with('flash_message', 'Asset Master added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $assetmaster = Assetmaster::findOrFail($id);

        return view('admin/asset_master/show', compact('assetmaster'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $assetgroups = DB::table('asset_groups')->pluck("asset_group_name","id");

        $assetmaster = Assetmaster::findOrFail($id);

        return view('admin/asset_master/edit', compact('assetmaster', 'assetgroups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $assetmaster = Assetmaster::findOrFail($id);
        $assetmaster->update($requestData);

        return redirect('admin/asset-master')->with('flash_message', 'Asset Group updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Assetmaster::destroy($id);

        return redirect('admin/asset-master')->with('flash_message', 'Asset Master deleted!');
    }
}
