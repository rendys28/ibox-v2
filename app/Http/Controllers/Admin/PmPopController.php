<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\PopMaster;
use App\Models\PmPop;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PmPopController extends Controller
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
            $pmpop = Pmpop::where('pop_name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $pmpop = Pmpop::latest()->paginate($perPage);
        }

        return view('admin.pm_pop.index', compact('pmpop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $popmaster = PopMaster::all();
        $assetgroups = DB::table('asset_groups')->pluck("asset_group_name","id");
        // return $popmaster;
        return view('admin.pm_pop.create', compact('assetgroups', 'popmaster'));
    }

    public function getJsasset($id)
    {
        $assetmaster = DB::table("asset_master")->where("sub_asset_group_id",$id)->pluck("material_description","id");
        return json_encode($assetmaster);
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
        
        pmpop::create($requestData);

        return redirect('admin/pop-master')->with('flash_message', 'POP Master added!');
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
        $pmpop = pmpop::findOrFail($id);

        return view('admin/pop_master/show', compact('pmpop'));
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
        $pmpop = pmpop::findOrFail($id);

        return view('admin/pop_master/edit', compact('pmpop'));
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
        
        $pmpop = pmpop::findOrFail($id);
        $pmpop->update($requestData);

        return redirect('admin/pop-master')->with('flash_message', 'POP Master updated!');
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
        pmpop::destroy($id);

        return redirect('admin/pop-master')->with('flash_message', 'POP Master deleted!');
    }
}
