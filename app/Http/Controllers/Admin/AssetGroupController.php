<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\AssetGroup;
use Illuminate\Http\Request;

class AssetGroupController extends Controller
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
            $assetgroup = AssetGroup::where('asset_group_name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $assetgroup = AssetGroup::latest()->paginate($perPage);
        }

        return view('admin.asset_group.index', compact('assetgroup'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.asset_group.create');
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
        
        AssetGroup::create($requestData);

        return redirect('admin/asset-group')->with('flash_message', 'Asset Group added!');
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
        $assetgroup = AssetGroup::findOrFail($id);

        return view('admin/asset_group/show', compact('assetgroup'));
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
        $assetgroup = AssetGroup::findOrFail($id);

        return view('admin/asset_group/edit', compact('assetgroup'));
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
        
        $assetgroup = AssetGroup::findOrFail($id);
        $assetgroup->update($requestData);

        return redirect('admin/asset-group')->with('flash_message', 'Asset Group updated!');
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
        AssetGroup::destroy($id);

        return redirect('admin/asset-group')->with('flash_message', 'Asset Group deleted!');
    }
}
