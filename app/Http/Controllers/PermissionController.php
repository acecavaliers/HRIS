<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Auth;
use App\Http\Controllers\General\CommonController;
use App\Models\Permission;
use App\Models\SystemTable;
use App\Models\SystemTableDetail;
use DB;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('RolesandPermissions/Permission');
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

        $validated = CommonController::getRequiredFields('Permission', $request);
        $validated1 = CommonController::getUniqueData('Permission', $request);


        $arr = $request->formdata;
        $arr['created_by'] = Auth::user()->name;

        $query = Permission::create($arr);
        return 'success';

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

    public function getlist(Request $request){

        $query = Permission::paginate(10);
        return $query;

    }

    public function getActiveList(Request $request){
        $query = Permission::selectRaw("category, name")->where('is_active', 1)->groupBy('category', 'name')->get();
        return $query;
    }

    public function getcolumns(Request $request)
    {
       $systemtable = SystemTable::where('model_name', $request->modelName)->first();
       return SystemTableDetail::with('formtypes')->where('system_table_id', $systemtable->id)->get();
    }

    public function searchData(Request $request){


        /*     return $request->is_active_all; */
            DB::enableQueryLog();
            //$searchdatadecode = json_decode($request->searchdata);
            $searchdatadecode = $request->searchdata;
            $val = 0;
            $query = Permission::query();
            foreach($searchdatadecode as $key=>$value){

                if($request->is_active_all == 'false'){
                    if($key!= 'deleted_at'){
                        if($key == 'created_at' || $key=='updated_at'){
                            $query->whereDate($key, 'LIKE', '%'.$value.'%');
                        }else if($key=='is_active'){
                            $finalvalue = $value == 'true'? 1:0;
                            $query->where($key, $finalvalue);
                        }else{
                            $query->where($key, 'LIKE', '%'.$value.'%');
                        }
                    }
                }else{
                    if($key!= 'deleted_at'){
                        if($key == 'created_at' || $key=='updated_at'){
                            $query->whereDate($key, 'LIKE', '%'.$value.'%');
                        }else if($key=='is_active'){
                            $query->whereIn($key, [0,1]);
                        }else{
                            $query->where($key, 'LIKE', '%'.$value.'%');
                        }
                    }
                }
            }


            $data = $query->paginate(10);
            return $data;
          /*   return DB::getQueryLog(); */

        }


}
