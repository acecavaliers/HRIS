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
        $saveData = [];



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

            foreach ($multiSelect as $category => $multidata) {
                if (!empty($multidata)) {
                    foreach ($multidata as $data) {
                        // Determine the fully qualified class name dynamically
                        $modelClass = 'App\\Models\\' . $data['db'] . 'Setup'; // Adjust namespace as needed
                        $foreignKey = $data['fk'];

                        // Check if the class exists before using it
                        if (!class_exists($modelClass)) {
                            continue; // Skip if the class doesn't exist
                        }

                        // Check if an active setup already exists
                        $existingSetup = $modelClass::where($foreignKey, $data['id'])
                            ->where('is_active', 1)
                            ->first();

                        // Insert if not exists or is not active
                        if (!$existingSetup || !$existingSetup->is_active) {
                            $saveData['shift_setup_id'] = $query->id;
                            $saveData['created_by'] = $query->created_by;
                            $saveData[$foreignKey] = $data['id'];


                            $modelClass::create($saveData); // Create new record in the respective model
                        }
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

    public function getList(Request $request)
    {
        $query = ShiftSetup::paginate($request->showrecords);

        foreach ($query->items() as $item) {
            $item->division_ids = DivisionShiftSetup::where('shift_setup_id', $item->id)
                ->where('is_active', 1)
                ->pluck('division_id');

            $item->department_ids = DepartmentShiftSetup::where('shift_setup_id', $item->id)
                ->where('is_active', 1)
                ->pluck('department_id');

            $item->sub_department_ids = SubDepartmentShiftSetup::where('shift_setup_id', $item->id)
                ->where('is_active', 1)
                ->pluck('sub_department_id');

            $item->sub_department_unit_ids = SubDepartmentUnitShiftSetup::where('shift_setup_id', $item->id)
                ->where('is_active', 1)
                ->pluck('sub_department_unit_id');
        }

        return $query;
    }

    public function getcolumns(Request $request)
    {
        $systemtable = SystemTable::where('model_name', $request->modelName)->first();
        return SystemTableDetail::with('formtypes')->where('system_table_id', $systemtable->id)->get();
    }
}
