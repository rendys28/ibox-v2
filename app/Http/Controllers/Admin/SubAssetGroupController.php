<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\SubAssetGroup;
use App\Models\AssetGroup;
use Illuminate\Http\Request;

class SubAssetGroupController extends Controller
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
            $subassetgroup = SubAssetGroup::where('sub_asset_group_name', 'LIKE', "%$keyword%")
                ->with('foreign_asset_group')->latest()->paginate($perPage);
        } else {
            $subassetgroup = SubAssetGroup::with('foreign_asset_group')->latest()->paginate($perPage);
        }

        // $subassetgroup = SubAssetGroup::with('foreign_asset_group')->first();

        return view('admin/sub_asset_group/index', compact('subassetgroup'));
        // return $subassetgroup;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $assetgroups = AssetGroup::all();
        return view('admin/sub_asset_group/create', compact('assetgroups'));
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

        SubAssetGroup::create($requestData);

        return redirect('admin/sub-asset-group')->with('flash_message', 'Sub Asset Group added!');
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
        $subassetgroup = SubAssetGroup::findOrFail($id);

        return view('admin/sub_asset_group/show', compact('subassetgroup'));
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
        $subassetgroup = SubAssetGroup::with('foreign_asset_group')->findOrFail($id);

        // return  $subassetgroup;

        return view('admin/sub_asset_group/edit', compact('subassetgroup'));
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

        $subassetgroup = SubAssetGroup::findOrFail($id);
        $subassetgroup->update($requestData);

        return redirect('admin/sub-asset-group')->with('flash_message', 'Sub Asset Group updated!');
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
        SubAssetGroup::destroy($id);

        return redirect('admin/sub-asset-group')->with('flash_message', 'Sub Asset Group deleted!');
    }
}
