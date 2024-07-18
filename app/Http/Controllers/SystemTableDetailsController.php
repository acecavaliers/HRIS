<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\SystemTable;
use App\Models\SystemTableDetail;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\Module;
use App\Models\Submodule;
use App\Http\Controllers\General\CommonController;
use App\Models\AutoGenerateCode;

class SystemTableDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('SystemAdministration/SystemTableDetails');
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
      /*   $arr = $request->formdata;
        $arr['created_by'] = Auth::user()->name;

        $query = SystemTableDetails::create($arr);
        return 'success'; */
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


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $arr = $request->formdata;


        $arr['updated_by'] = Auth::user()->name;

        $query = SystemTableDetail::where('id', $id)->update($arr);
        return $arr;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SystemTableDetail::where('id', $id)->update(['deleted_by'=> Auth::user()->name]);
        SystemTableDetail::where('id', $id)->delete();
        return 'success';
    }

    public function getlist(Request $request){

        $query = SystemTableDetail::with(['systemtables', 'formtypes', 'texteditors'])->paginate($request->showrecords);
        return $query;

    }

    public function getcolumns(Request $request)
    {
       $systemtable = SystemTable::where('model_name', $request->modelName)->first();
       return SystemTableDetail::with(['systemtables','formtypes', 'texteditors', 'autogeneratecodes'])->where('system_table_id', $systemtable->id)->get();
    }

    public function searchData(Request $request){


        /*     return $request->is_active_all; */
            DB::enableQueryLog();
            //$searchdatadecode = json_decode($request->searchdata);
            $searchdatadecode = $request->searchdata;
            $val = 0;
            $query = SystemTableDetail::query();
            foreach($searchdatadecode as $key=>$value){

                if($request->is_active_all == 'false'){
                    if($key!= 'deleted_at'){
                        if($key == 'created_at' || $key=='updated_at'){
                            $query->whereDate($key, 'LIKE', '%'.$value.'%');
                        }else if($key=='is_active'){
                            $query->where($key, $value);
                        }else if($key=='is_foreignkey'){
                            if($value == 'true'){
                                $query->where($key, 1);
                            }else{
                                $query->where($key, 0);
                            }
                        }else if($key=='column_order' || $key=='search_order'){
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

                        }else if($key=='is_foreignkey'){
                            if($value == 'true'){
                                $query->where($key, 1);
                            }else{
                                $query->where($key, 0);
                            }
                        }else if($key=='column_order' || $key=='search_order'){
                            $query->where($key, $value);

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


        public function getSystemDetailsBySystemTable(Request $request){
            $query = SystemTableDetail::with('systemtables', 'formtypes', 'texteditors')->where('system_table_id', $request->paramVal)->paginate(10);

            return $query;
        }

        public function updateByBulk(Request $request){
           /*  $arr = $request->formdata; */

           // $arr['updated_by'] = Auth::user()->name;
           /* Validation */

           
       
       

           foreach($request->formdata as $key => $fdata){
           

            //required field for foreign keys before updating
            if($fdata['is_foreignkey'] == 1){
                if($fdata['reference_table_column'] == ''){
                    $validated = $request->validate([
                        'reference_table_column' => 'required',
                    ]);
    
                }
            }   
          

          


            $query = SystemTableDetail::where('id', $fdata['id'])->update([
               'column_label' => $fdata['column_label'],
               'enable_search' => $fdata['enable_search'],
               'enable_display_column' => $fdata['enable_display_column'],
               'enable_addform' =>$fdata['enable_addform'],
               'enable_editform'=> $fdata['enable_editform'],
               'is_active' => $fdata['is_active'],
               'column_order' => $fdata['column_order'],
               'search_order' => $fdata['search_order'],
               'reference_table' =>$fdata['reference_table'] == '' ? '' : $fdata['reference_table'],
               'reference_table_column' => $fdata['reference_table_column'] == '' ? '' : $fdata['reference_table_column'],
               'is_required' => $fdata['is_required'],
               'form_type_id' => $fdata['formtype']['id'],
               'required_text'=> $fdata['required_text'],
               'is_unique' => $fdata['is_unique'],
               'is_autogenerate' => $fdata['is_autogenerate'],
               'is_disabled' => $fdata['is_disabled'],
               'use_texteditor'=> $fdata['use_texteditor'],
               'updated_by' => Auth::user()->name,
           ]);

           if($fdata['is_autogenerate'] ==1){

            
            $validated1 = $request->validate([
                'formdata.*.no_of_digits' => 'required_if:formdata.*.is_autogenerate,1|nullable|integer|gt:0',
                'formdata.*.no_start_from' => 'required_if:formdata.*.is_autogenerate,1|nullable|integer',
            ]);
            
          

              $query = AutoGenerateCode::where('system_table_detail_id',$fdata['id'])->first();
             
                
              if(!$query){

            
                AutoGenerateCode::create([
                    'system_table_detail_id' => $fdata['id'],
                    'prefix' => $fdata['prefix'],
                    'no_of_digits'=>$fdata['no_of_digits'],
                    'no_start_from' => $fdata['no_start_from'],
                    'no_end_from' => $fdata['no_end_from'] == '' ? 0 : $fdata['no_end_from'],
                    'current_no' => 0,
                    'next_no' => $fdata['no_start_from'],
                    'is_active' =>1,
                    'created_by' => Auth::user()->name

                  ]);
              }
             
           }else{

             AutoGenerateCode::where('system_table_detail_id',$fdata['id'])->update([
                'is_active' => 0,
                'updated_by' => Auth::user()->name
             ]);
           }

       }

    
       return 'success';
        }
}
