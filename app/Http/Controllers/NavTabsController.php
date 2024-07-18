<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NavTabs;

class NavTabsController extends Controller
{
    public function index(Request $request){
        $query = NavTabs::where(array('module_id' => $request->module_id, 'submodule_id' => $request->submodule_id))->get();
        return $query;
    }

    public function updateCurrentNavTab(Request $request){
        NavTabs::query()->update(['is_current' => 0]);
        NavTabs::where('id', $request->id)->update(['is_current' => 1]);
        return 'success';
      /*   $query = NavTabs::where(array('id'=> $request->id, 'is_current' => 1))->first();
        return $query; */
    }

    public function getDefaultTabView(){
        $query = NavTabs::where('is_default', 1)->first();
        NavTabs::where('id', $query->id)->update(['is_current' => 1]);
        return 'success';


    }
}
