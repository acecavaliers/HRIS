<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventType;
use Auth;
use App\Http\Controllers\General\CommonController;
use App\Models\SystemTable;
use App\Models\SystemTableDetail;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class EventTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Maintenance/EventType');
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
        $validated = CommonController::getRequiredFields('EventType', $request);

        $systemtable = SystemTable::where('table_name', 'event_types')->first();
        $systemtabledetail = SystemTableDetail::where(array('system_table_id' => $systemtable->id, 'is_fk_getreferenced' => 0))->get();
        
        
        $arr = $request->formdata;

        
        if(count($systemtabledetail) > 0){
            foreach($systemtabledetail as $data){
                if(isset($data['saving_referenced_field'])){
                  
                        $arr[$data['column_name']] = $request->formdata[$data['column_name']][$data['saving_referenced_field']];
                    
                }
            }
          
        }
        $arr['created_by'] = Auth::user()->name;

        $query = EventType::create($arr);
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
        $validated = CommonController::getRequiredFields('EventType', $request);

        $systemtable = SystemTable::where('table_name', 'event_types')->first();
        $systemtabledetail = SystemTableDetail::where(array('system_table_id' => $systemtable->id, 'is_fk_getreferenced' => 0))->get();
        
        
        $arr = $request->formdata;

        
        if(count($systemtabledetail) > 0){
            foreach($systemtabledetail as $data){
                if(isset($data['saving_referenced_field'])){
                  
                        $arr[$data['column_name']] = $request->formdata[$data['column_name']][$data['saving_referenced_field']];
                    
                }
            }
          
        }
        $arr['updated_by'] = Auth::user()->name;

        $query = EventType::where('id', $id)->update($arr);
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        EventType::where('id', $id)->update(['deleted_by'=> Auth::user()->name]);
        EventType::where('id', $id)->delete();
        return 'success';
    }


    public function getlist(Request $request){

        $query = EventType::paginate($request->showrecords);
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
            $query = EventType::query();
            foreach($searchdatadecode as $key=>$value){

                if($request->is_active_all == 'false'){
                    if($key!= 'deleted_at'){
                        if($key == 'created_at' || $key=='updated_at'){
                            $query->whereDate($key, 'LIKE', '%'.$value.'%');
                        }else if($key=='is_active'){
                            $query->where($key, $value);

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
