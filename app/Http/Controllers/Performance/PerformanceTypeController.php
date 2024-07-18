<?php

namespace App\Http\Controllers\Performance;

use App\Models\PerformanceType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerformanceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
             return Inertia::render('Performance/PerformanceType');
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
        $validated = CommonController::getRequiredFields('PerformanceType', $request);

        $systemtable = SystemTable::where('table_name', 'performances')->first();
        $systemtabledetail = SystemTableDetail::where(array('system_table_id' => $systemtable->id, 'is_fk_getreferenced' => 0))->get();

        $arr = $request->formdata;


        if(count($systemtabledetail) > 0){
            foreach($systemtabledetail as $data){
                if(isset($arr[$data['column_name']])){
                    if(isset($data['saving_referenced_field'])){

                            $arr[$data['column_name']] = $request->formdata[$data['column_name']][$data['saving_referenced_field']];

                    }
                }
            }

        }


        $arr['created_by'] = Auth::user()->name;

        $query = Performance::create($arr);
        return 'success';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Performance::where('id', $id)->first();
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
        $validated = CommonController::getRequiredFields('PerfomanceType', $request);

        $systemtable = SystemTable::where('table_name', 'performances')->first();
        $systemtabledetail = SystemTableDetail::where(array('system_table_id' => $systemtable->id, 'is_fk_getreferenced' => 0))->get();

        $arr = $request->formdata;


        if(count($systemtabledetail) > 0){
            foreach($systemtabledetail as $data){
                if(isset($arr[$data['column_name']])){
                    if(isset($data['saving_referenced_field'])){

                            $arr[$data['column_name']] = $request->formdata[$data['column_name']][$data['saving_referenced_field']];

                    }
                }
            }

        }
        $arr['updated_by'] = Auth::user()->name;

        $query = PerformanceType::where('id', $id)->update($arr);
        return 'success';
    }


    public function getcolumns(Request $request)
    {
       $systemtable = SystemTable::where('model_name', $request->modelName)->first();
       return SystemTableDetail::with('formtypes', 'systemtables')->where('system_table_id', $systemtable->id)->get();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
