<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\PopMaster;
use Illuminate\Http\Request;

class PopMasterController extends Controller
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
            $popmaster = Popmaster::where('pop_name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $popmaster = Popmaster::latest()->paginate($perPage);
        }

        return view('admin.pop_master.index', compact('popmaster'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.pop_master.create');
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
        
        popmaster::create($requestData);

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
        $popmaster = popmaster::findOrFail($id);

        return view('admin/pop_master/show', compact('popmaster'));
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
        $popmaster = popmaster::findOrFail($id);

        return view('admin/pop_master/edit', compact('popmaster'));
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
        
        $popmaster = popmaster::findOrFail($id);
        $popmaster->update($requestData);

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
        popmaster::destroy($id);

        return redirect('admin/pop-master')->with('flash_message', 'POP Master deleted!');
    }
}
