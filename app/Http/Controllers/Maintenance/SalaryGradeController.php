<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use App\Http\Controllers\General\CommonController;
use App\Models\SalaryGrade;
use App\Models\SystemTable;
use App\Models\SystemTableDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SalaryGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Maintenance/SalaryGrade');
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
        $validated = CommonController::getRequiredFields('SalaryGrade', $request);
        $systemtable = SystemTable::where('table_name', 'salary_grades')->first();
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

        $query = SalaryGrade::create($arr);
       
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
        $validated = CommonController::getRequiredFields('SalaryGrade', $request);
        $systemtable = SystemTable::where('table_name', 'salary_grades')->first();
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

        $query = SalaryGrade::where('id', $id)->update($arr);
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SalaryGrade::where('id', $id)->update(['deleted_by' => Auth::user()->name]);
        SalaryGrade::where('id', $id)->delete();
        return 'success';
    }

    public function getlist(Request $request)
    {

        $query = SalaryGrade::paginate($request->showrecords);
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
        $query = SalaryGrade::query();
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
}
