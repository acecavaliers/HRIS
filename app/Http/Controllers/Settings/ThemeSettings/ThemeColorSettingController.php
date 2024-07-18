<?php

namespace App\Http\Controllers\Settings\ThemeSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\SystemTable;
use App\Models\SystemTableDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\General\CommonController;
use App\Models\ThemeColor;

class ThemeColorSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Settings/ThemeSettings/ThemeColorSettings');
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
        $validated = CommonController::getRequiredFields('ThemeColor', $request);
        $systemtable = SystemTable::where('table_name', 'theme_colors')->first();
        $systemtabledetail = SystemTableDetail::where(array('system_table_id' => $systemtable->id))->get();
        $arr = $request->formdata;

        if (count($systemtabledetail) > 0) {
            foreach ($systemtabledetail as $data) {
                if($data['is_fk_getreferenced'] == 0){
                    if(isset($arr[$data['column_name']])){
                        if (isset($data['saving_referenced_field'])) {
                            $arr[$data['column_name']] = $request->formdata[$data['column_name']][$data['saving_referenced_field']];
                        }
                    }
                }
               
            }

        }

    
        $arr['created_by'] = Auth::user()->name;

        $query = ThemeColor::create($arr);
       
        /* UPDATE AUTOGENERATE */
        if (count($systemtabledetail) > 0) {
            foreach($systemtabledetail as $stbldet){
                if($stbldet->is_autogenerate == 1){  
                   CommonController::getNextNumberInAutoGenerateCode($stbldet->id);
                }
            }
        }

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
        $validated = CommonController::getRequiredFields('ThemeColor', $request);
        $systemtable = SystemTable::where('table_name', 'theme_colors')->first();
        $systemtabledetail = SystemTableDetail::where(array('system_table_id' => $systemtable->id))->get();
        $arr = $request->formdata;

        if (count($systemtabledetail) > 0) {
            foreach ($systemtabledetail as $data) {
                if($data['is_fk_getreferenced'] == 0){
                    if(isset($arr[$data['column_name']])){
                        if (isset($data['saving_referenced_field'])) {
                            $arr[$data['column_name']] = $request->formdata[$data['column_name']][$data['saving_referenced_field']];
                        }
                    }
                }
            }

        }
        $arr['updated_by'] = Auth::user()->name;

        $query = ThemeColor::where('id', $id)->update($arr);
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ThemeColor::where('id', $id)->update(['deleted_by' => Auth::user()->name]);
        ThemeColor::where('id', $id)->delete();
        return 'success';
    }

    public function getlist(Request $request)
    {

        $query = ThemeColor::paginate($request->showrecords);
        return $query;

    }

    public function getcolumns(Request $request)
    {
        $systemtable = SystemTable::where('model_name', $request->modelName)->first();
        return SystemTableDetail::with('formtypes')->where('system_table_id', $systemtable->id)->get();
    }

    public function searchData(Request $request)
    {

        /*     return $request->is_active_all; */
        DB::enableQueryLog();
        //$searchdatadecode = json_decode($request->searchdata);
        $searchdatadecode = $request->searchdata;
        $val = 0;
        $query = ThemeColor::query();
        foreach ($searchdatadecode as $key => $value) {

            if ($request->is_active_all == 'false') {
                if ($key != 'deleted_at') {
                    if ($key == 'created_at' || $key == 'updated_at') {
                        $query->whereDate($key, 'LIKE', '%' . $value . '%');
                    } else if ($key == 'is_active') {
                        $query->where($key, $value);

                    } else {
                        $query->where($key, 'LIKE', '%' . $value . '%');
                    }
                }
            } else {
                if ($key != 'deleted_at') {
                    if ($key == 'created_at' || $key == 'updated_at') {
                        $query->whereDate($key, 'LIKE', '%' . $value . '%');
                    } else if ($key == 'is_active') {
                        $query->whereIn($key, [0, 1]);


                    } else {
                        $query->where($key, 'LIKE', '%' . $value . '%');
                    }
                }
            }
        }


        $data = $query->paginate(10);
        return $data;
        /*   return DB::getQueryLog(); */

    }

    public function getThemeColorSelected(){
        return ThemeColor::where(array('is_active' => 1, 'is_selected' => 1))->first();
    }

    
}
