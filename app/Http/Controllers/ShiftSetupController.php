<?php

namespace App\Http\Controllers;

use App\Http\Controllers\General\CommonController;
use App\Models\Department;
use App\Models\DepartmentShiftSetup;
use App\Models\Division;
use App\Models\DivisionShiftSetup;
use App\Models\ShiftSetup;
use App\Models\SubDepartment;
use App\Models\SubDepartmentShiftSetup;
use App\Models\SubDepartmentUnit;
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

    public function getDiv()
    {
        $query = Division::where('is_active', '1')->get();
        return $query;
    }
    public function getDept()
    {
        $query = Department::where('is_active', '1')
            ->get();
        return $query;
    }
    public function getSubDept()
    {
        $query = SubDepartment::where('is_active', '1')
            ->get();
        return $query;
    }
    public function getSubDeptUnit()
    {
        $query = SubDepartmentUnit::where('is_active', '1')
            ->get();
        return $query;
    }

    public function store(Request $request)
    {
        $validated = CommonController::getRequiredFields('ShiftSetup', $request);

        $systemtable = SystemTable::where('table_name', 'shift_setups')->first();

        $systemtabledetail = SystemTableDetail::where(array('system_table_id' => $systemtable->id, 'is_fk_getreferenced' => 0))->get();


        $arr = $request->formdata;
        $multiSelect = $request->multiSelectData;



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


            if (!empty($multiSelect['divisions'])) {

                foreach ($multiSelect['divisions'] as $divisions) {

                    $existingSetup = DivisionShiftSetup::where('division_id', $divisions['id'])
                        ->where('is_active', 1)
                        ->first();

                    if (!$existingSetup || !$existingSetup->is_active) {
                        $divisions['shift_setup_id'] = $query->id;
                        $divisions['created_by'] = $query->created_by;
                        DivisionShiftSetup::create($divisions);
                    }
                }
            }
            if (!empty($multiSelect['departments'])) {

                foreach ($multiSelect['departments'] as $departments) {

                    $existingSetup = DepartmentShiftSetup::where('department_id', $departments['id'])
                        ->where('is_active', 1)
                        ->first();

                    if (!$existingSetup || !$existingSetup->is_active) {
                        $departments['shift_setup_id'] = $query->id;
                        $departments['created_by'] = $query->created_by;
                        DepartmentShiftSetup::create($departments);
                    }
                }
            }

            if (!empty($multiSelect['sub_departments'])) {

                foreach ($multiSelect['sub_departments'] as $subDepartments) {

                    $existingSetup = SubDepartmentShiftSetup::where('sub_department_id', $subDepartments['id'])
                        ->where('is_active', 1)
                        ->first();

                    if (!$existingSetup || !$existingSetup->is_active) {
                        $subDepartments['shift_setup_id'] = $query->id;
                        $subDepartments['created_by'] = $query->created_by;
                        SubDepartmentShiftSetup::create($subDepartments);
                    }
                }
            }

            if (!empty($multiSelect['sub_department_units'])) {

                foreach ($multiSelect['sub_department_units'] as $subDepartmentunits) {

                    $existingSetup = SubDepartmentUnitShiftSetup::where('sub_department_unit_id', $subDepartmentunits['id'])
                        ->where('is_active', 1)
                        ->first();

                    if (!$existingSetup || !$existingSetup->is_active) {
                        $subDepartmentunits['shift_setup_id'] = $query->id;
                        $subDepartmentunits['created_by'] = $query->created_by;
                        SubDepartmentUnitShiftSetup::create($subDepartmentunits);
                    }
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
