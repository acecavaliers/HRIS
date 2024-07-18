<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use App\Http\Controllers\General\CommonController;
use App\Models\AutoGenerateCode;
use App\Models\SystemTable;
use App\Models\SystemTableDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AutoGenerateCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Maintenance/AutoGenerateCode');
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
        $arr = $request->formdata;
        $arr['updated_by'] = Auth::user()->name;

        $query = AutoGenerateCode::where('id', $id)->update($arr);
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        AutoGenerateCode::where('id', $id)->update(['deleted_by'=> Auth::user()->name]);
        AutoGenerateCode::where('id', $id)->delete();
        return 'success';
    }
    public function getlist(Request $request){

        $query = AutoGenerateCode::paginate($request->showrecords);
        return $query;

    }

    public function getcolumns(Request $request)
    {
       $systemtable = SystemTable::where('model_name', $request->modelName)->first();
       return SystemTableDetail::with('formtypes', 'systemtables')->where('system_table_id', $systemtable->id)->get();
    }

    public function searchData(Request $request){


        /*     return $request->is_active_all; */
            DB::enableQueryLog();
            //$searchdatadecode = json_decode($request->searchdata);
            $searchdatadecode = $request->searchdata;
            $val = 0;
            $query = AutoGenerateCode::query();
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

        public function getAutoGenCodeBySystemTableDetails(Request $request){
            $query = AutoGenerateCode::where('system_table_detail_id', $request->systemtabledetailid)->first();
            
            $num = str_pad($query->next_no, $query->no_of_digits, '0', STR_PAD_LEFT); 
            $result = '';
            if($query->prefix == ''){
                $result =  $num;
            }else{
                if(str_contains($query->prefix, '{yyyy}')){
                    $replacevalue = str_replace("{yyyy}",date("Y"),$query->prefix);
                    $result = $replacevalue.$num; 
                }/* else if(preg_match_all('/\{(.*?)\}/', $query->prefix, $matches)){
                    
                  
                
                
                } */else{
                    $result = $query->prefix.$num; 
                }
                
            }
            return $result;
        }

        public function updateNextNo(Request $request){
                //update autogeneratecode next_no
                $query1 = AutoGenerateCode::where('system_table_detail_id', $request->systemtabledetailid)->first();
                $num = str_pad($request->nextNo, $query1->no_of_digits, '0', STR_PAD_LEFT); 
                $query = AutoGenerateCode::where('system_table_detail_id',$request->systemtabledetailid)->update([
                    'current_no' => $request->currentNo,
                    'next_no' => $num
                ]);
                return $query;
        }
}
