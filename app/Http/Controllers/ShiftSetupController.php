<?php

namespace App\Http\Controllers;

use App\Http\Controllers\General\CommonController;
use App\Models\DepartmentShiftSetup;
use App\Models\DivisionShiftSetup;
use App\Models\ShiftSetup;
use App\Models\SubDepartmentShiftSetup;
use App\Models\SubDepartmentUnitShiftSetup;
use App\Models\SystemTable;
use App\Models\SystemTableDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ShiftSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Timekeeping/ShiftSetup');
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
        $validated = CommonController::getRequiredFields('WorkShift', $request);

        $systemtable = SystemTable::where('table_name', 'work_shifts')->first();

        $systemtabledetail = SystemTableDetail::where(array('system_table_id' => $systemtable->id, 'is_fk_getreferenced' => 0))->get();


        $arr = $request->formdata;


        if (count($systemtabledetail) > 0) {
            foreach ($systemtabledetail as $data) {
                if (isset($data['saving_referenced_field'])) {

                    $arr[$data['column_name']] = $request->formdata[$data['column_name']][$data['saving_referenced_field']];
                }
            }
        }

        $arr['created_by'] = Auth::user()->name;

        $query = ShiftSetup::create($arr);

        if ($query) {

            if (!empty($request->SubDepartmentUnits) && !empty($request->SubDepartments) && !empty($request->Departments) && !empty($request->Divisions)) {

                foreach ($request->SubDepartmentUnits as $subDepartmentUnit) {
                    $subDepartmentUnit['work_shift_id'] = $query->id;
                    $subDepartmentUnit['created_by'] = $query->created_by;
                    SubDepartmentUnitShiftSetup::create($subDepartmentUnit);
                }
            }

            if (empty($request->SubDepartmentUnits) && !empty($request->SubDepartments) && !empty($request->Departments) && !empty($request->Divisions)) {

                foreach ($request->SubDepartments as $subDepartment) {
                    $subDepartment['work_shift_id'] = $query->id;
                    $subDepartment['created_by'] = $query->created_by;
                    SubDepartmentShiftSetup::create($subDepartment);
                }
            }

            if (empty($request->SubDepartmentUnits) && empty($request->SubDepartments) && !empty($request->Departments) && !empty($request->Divisions)) {

                foreach ($request->Departments as $department) {
                    $department['work_shift_id'] = $query->id;
                    $department['created_by'] = $query->created_by;
                    DepartmentShiftSetup::create($department);
                }
            }

            if (empty($request->SubDepartmentUnits) && empty($request->SubDepartments) && empty($request->Departments) && !empty($request->Divisions)) {

                foreach ($request->Divisions as $division) {
                    $division['work_shift_id'] = $query->id;
                    $division['created_by'] = $query->created_by;
                    DivisionShiftSetup::create($division);
                }
            }
        }

        return 'success';
    }

    /**
     * Display the specified resource.
     */
    public function show(ShiftSetup $shiftSetup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShiftSetup $shiftSetup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShiftSetup $shiftSetup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShiftSetup $shiftSetup)
    {
        //
    }

    public function getlist(Request $request)
    {

        $query = ShiftSetup::paginate($request->showrecords);
        return $query;
    }

    public function getcolumns(Request $request)
    {
        $systemtable = SystemTable::where('model_name', $request->modelName)->first();
        return SystemTableDetail::with('formtypes')->where('system_table_id', $systemtable->id)->get();
    }
}
