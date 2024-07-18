<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submodule;
use App\Models\Module;
use App\Models\ModuleCategory;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function indexactive()
    {
        $modulecategory = ModuleCategory::with('modules', 'modules.submodules', 'modules.navtabs')->where('is_active', 1)->orderBy('order_no', 'asc')->get();
       //$data = Module::with('submodules', 'navtabs')->where('is_active', 1)->get();

        return $modulecategory;
    }

    public function updateCurrentActive(Request $request){

        Submodule::query()->update(['is_current' => 0]);
        Module::query()->update(['is_current' => 0]);
        Module::where('id', $request->id)->update(['is_current' => 1]);
        $module = Module::with('submodules')->where('id', $request->id)->first();
        return $module;

   }

    public function updateDefault(){
            Submodule::query()->update(['is_current' => 0]);
            Module::query()->update(['is_current' => 0]);
            Module::where('is_default', 1)->update(['is_current' => 1]);
           return 'success';
    }


}
