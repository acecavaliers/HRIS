<?php

namespace App\Http\Controllers;

use App\Models\DayShift;
use App\Models\Department;
use App\Models\DepartmentShift;
use App\Models\Division;
use App\Models\DivisionShift;
use App\Models\Employee;
use App\Models\EmployeeWorkSchedule;
use App\Models\EmployeeWorkshift;
use App\Models\EmployeeWorkshiftsDetail;
use App\Models\SubDepartment;
use App\Models\SubDepartmentUnit;
use App\Models\WorkShift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class EmployeeWorkScheduleController extends Controller
{
    public function index()
    {

        return Inertia::render('Timekeeping/EmployeeWorkSchedule');
    }
    public function getDivisions(Request $request)
    {

        // $query = Division::where('is_active', '1')->get();
        // // ->get('name','id','division_id');
        // return $query;

        $query = Division::select(
            'divisions.id',
            'divisions.code',
            'divisions.short_name',
            'divisions.name',
            'shift_setups.name as shift_setup_name',
            'shift_setups.with_start_date',
            'shift_setups.first_start_date',
            'shift_setups.second_start_date'
        )
            ->join('division_shift_setups', 'divisions.id', '=', 'division_shift_setups.division_id')
            ->join('shift_setups', 'division_shift_setups.shift_setup_id', '=', 'shift_setups.id')
            ->where('division_shift_setups.is_active', 1)
            ->where('shift_setups.is_active', 1)
            ->get();

        return $query;
    }

    public function getDept(Request $request)
    {

        // $query = Department::where('is_active', '1')
        //     ->get();
        $query = Department::select(
            'departments.id',
            'division_id',
            'departments.code',
            'departments.short_name',
            'departments.name',
            'shift_setups.name as shift_setup_name',
            'shift_setups.with_start_date',
            'shift_setups.first_start_date',
            'shift_setups.second_start_date'
        )
            ->join('department_shift_setups', 'departments.id', '=', 'department_shift_setups.department_id')
            ->join('shift_setups', 'department_shift_setups.shift_setup_id', '=', 'shift_setups.id')
            ->where('department_shift_setups.is_active', 1)
            ->where('shift_setups.is_active', 1)
            ->get();
        return $query;
    }

    public function getSubDept(Request $request)
    {

        // $query = SubDepartment::where('is_active', '1')
        //     ->get();
        $query = SubDepartment::select(
            'sub_departments.id',
            'department_id',
            'sub_departments.code',
            'sub_departments.short_name',
            'sub_departments.name',
            'shift_setups.name as shift_setup_name',
            'shift_setups.with_start_date',
            'shift_setups.first_start_date',
            'shift_setups.second_start_date'
        )
            ->join('sub_department_shift_setups', 'sub_departments.id', '=', 'sub_department_shift_setups.sub_department_id')
            ->join('shift_setups', 'sub_department_shift_setups.shift_setup_id', '=', 'shift_setups.id')
            ->where('sub_department_shift_setups.is_active', 1)
            ->where('shift_setups.is_active', 1)
            ->get();
        return $query;
    }

    public function getSubDeptUnit(Request $request)
    {

        // $query = SubDepartmentUnit::where('is_active', '1')
        //     ->get();
        $query = SubDepartmentUnit::select(
            'sub_department_units.id',
            'sub_department_id',
            'sub_department_units.code',
            'sub_department_units.short_name',
            'sub_department_units.name',
            'shift_setups.name as shift_setup_name',
            'shift_setups.with_start_date',
            'shift_setups.first_start_date',
            'shift_setups.second_start_date'
        )
            ->join('sub_department_unit_shift_setups', 'sub_department_units.id', '=', 'sub_department_unit_shift_setups.sub_department_unit_id')
            ->join('shift_setups', 'sub_department_unit_shift_setups.shift_setup_id', '=', 'shift_setups.id')
            ->where('sub_department_unit_shift_setups.is_active', 1)
            ->where('shift_setups.is_active', 1)
            ->get();
        return $query;
    }

    public function update(Request $request, string $id)
    {
        try {
            $arr = $request->formdata;
            $arr['day_off'] = $arr['day_off'] ? 1 : 0;
            $arr['oc'] = $arr['oc'] ? 1 : 0;

            $workshiftDetails = EmployeeWorkshiftsDetail::where('employee_workshift_id', $id)
                ->where('schedule_date', $arr['schedule_date'])
                ->where('employee_workshifts_details.is_active', 1)
                ->first();

            $rowsUpdated = 0;

            if ($workshiftDetails) {
                if (
                    $workshiftDetails->day_off != $arr['day_off'] ||
                    $workshiftDetails->oc != $arr['oc'] ||
                    $workshiftDetails->work_shift_id != $arr['work_shift_id']
                ) {
                    // Update the workshift detail
                    $workshiftDetails->day_off = $arr['day_off'];
                    $workshiftDetails->oc = $arr['oc'];
                    $workshiftDetails->work_shift_id = $arr['work_shift_id'];
                    $workshiftDetails->updated_by = Auth::user()->name;
                    $workshiftDetails->save();
                    $rowsUpdated++;
                }
            }

            // foreach ($workshiftDetails as $workshiftDetail) {
            //     // Find the corresponding item in $arr by id
            //     $matchingArrItem = collect($arr)->firstWhere('id', $workshiftDetail->id);

            //     // Compare and update if necessary
            //     if ($matchingArrItem && ($workshiftDetail->day_off != $matchingArrItem['day_off'] || $workshiftDetail->oc != $matchingArrItem['oc'])) {
            //         // Update the workshift detail
            //         $workshiftDetail->day_off = $matchingArrItem['day_off'];
            //         $workshiftDetail->oc = $matchingArrItem['oc'];
            //         $workshiftDetail->updated_by =  Auth::user()->name;
            //         $workshiftDetail->save();
            //         $rowsUpdated++;
            //     }
            // }

            return 'success';
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update workshift detail.'], 500);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $arr = $request->formdata;
        $shift = $request->shift_details;
        $empIDs = $request->emp;
        $arr['created_by'] = Auth::user()->name;
        $setby = $request->setby;
        $shiftDates = $request->shiftDates;
        // $insertedCount = 0;

        if (!empty($empIDs)) {
            foreach ($empIDs as $empID) {
                $arr['employee_id'] = $empID;
                $existingWorkshift = $this->findExistingWorkshift($arr);

                if (!$existingWorkshift) {
                    $que = EmployeeWorkshift::create($arr);
                    // $insertedCount++;
                    $this->createWorkshiftDetails($que, $shift, $setby, $shiftDates);
                } else {
                    $this->updateWorkshiftDetails($existingWorkshift, $shift, $setby, $shiftDates, $arr['work_shift_id']);
                }
            }
            return 'success';
            // return $insertedCount > 0 ? 'success' : 'existed';
        } else {
            $existingWorkshift = $this->findExistingWorkshift($arr);

            if (!$existingWorkshift) {
                $que = EmployeeWorkshift::create($arr);
                $this->createWorkshiftDetails($que, $shift, $setby, $shiftDates);
            } else {
                $this->updateWorkshiftDetails($existingWorkshift, $shift, $setby, $shiftDates, $arr['work_shift_id']);
            }
            return 'success';
        }
    }

    private function findExistingWorkshift($arr)
    {
        return EmployeeWorkshift::where('employee_id', $arr['employee_id'])
            ->where(function ($query) use ($arr) {
                $query->where(function ($subQuery) use ($arr) {
                    $subQuery->where('period_from', '<=', $arr['period_from'])
                        ->where('period_to', '>=', $arr['period_from']);
                })
                    ->orWhere(function ($subQuery) use ($arr) {
                        $subQuery->where('period_from', '<=', $arr['period_to'])
                            ->where('period_to', '>=', $arr['period_to']);
                    });

                // $query->whereBetween($arr['period_from'], [$arr['period_from'], $arr['period_to']])
                // ->orWhereBetween('period_to', [$arr['period_from'], $arr['period_to']]);
            })
            ->first();
    }

    private function createWorkshiftDetails($que, $shift, $setby, $shiftDates)
    {
        if ($setby < 1) {
            $shift['employee_workshift_id'] = $que->id;
            $shift['work_shift_id'] = $que->work_shift_id;
            $shift['created_by'] = $que->created_by;
            EmployeeWorkshiftsDetail::create($shift);
        } else {
            foreach ($shiftDates as $shifts) {
                $shifts['employee_workshift_id'] = $que->id;
                $shifts['work_shift_id'] = $que->work_shift_id;
                $shifts['day_off'] = $shift['day_off'];
                $shifts['oc'] = $shift['oc'];
                $shifts['created_by'] = $que->created_by;
                EmployeeWorkshiftsDetail::create($shifts);
            }
        }
    }

    private function updateWorkshiftDetails($existingWorkshift, $shift, $setby, $shiftDates, $work_id)
    {
        if ($setby < 1) {
            $existingDetail = EmployeeWorkshiftsDetail::where('employee_workshift_id', $existingWorkshift->id)
                ->where('schedule_date', $shift['schedule_date'])
                ->where('employee_workshifts_details.is_active', 1)
                ->first();
            if (!$existingDetail) {
                $shift['employee_workshift_id'] = $existingWorkshift->id;
                $shift['work_shift_id'] = $work_id;
                $shift['created_by'] = Auth::user()->name;
                EmployeeWorkshiftsDetail::create($shift);
            }
        } else {
            $filteredShiftDates = array_filter($shiftDates, function ($shifts) use ($existingWorkshift) {
                return !EmployeeWorkshiftsDetail::where('employee_workshift_id', $existingWorkshift->id)
                    ->where('schedule_date', $shifts['schedule_date'])
                    ->where('employee_workshifts_details.is_active', 1)
                    ->exists();
            });

            foreach ($filteredShiftDates as $shifts) {
                $shifts['employee_workshift_id'] = $existingWorkshift->id;
                $shifts['work_shift_id'] = $work_id;
                $shifts['day_off'] = $shift['day_off'];
                $shifts['oc'] = $shift['oc'];
                $shifts['created_by'] = Auth::user()->name;
                EmployeeWorkshiftsDetail::create($shifts);
            }
        }
    }

    public function getlist(Request $request)
    {
        $searchTypes = [
            'divisions' => 'division_id',
            'departments' => 'department_id',
            'sub_departments' => 'sub_department_id',
            'sub_department_units' => 'sub_department_unit_id',
        ];

        $searchType = $request->searchType;
        if (!isset($searchTypes[$searchType])) {
            return response()->json(['error' => 'Invalid search type'], 400);
        }

        $column = $searchTypes[$searchType];
        $query = Employee::select([
            'employees.id',
            'employees.first_name',
            'employees.last_name',
            'employees.middle_name',
            'employees.suffix',
            'employee_work_assignments.job_title_id',
            'employee_work_assignments.work_location_id',
            'employee_work_assignments.employment_type_id',
            'employee_work_assignments.division_id',
            'employee_work_assignments.department_id',
            'employee_work_assignments.sub_department_id',
            'employee_work_assignments.sub_department_unit_id',
        ])
            ->join('employee_work_assignments', 'employees.id', '=', 'employee_work_assignments.employee_id')

            ->where('employee_work_assignments.is_active', 1)
            ->where("employee_work_assignments.$column", $request->searchId)
            ->get();

        $query->map(function ($employee) use ($request) {
            $workshiftDetails = DB::table('employee_workshifts_details')
                ->select([
                    'employee_workshifts_details.id',
                    'employee_workshifts_details.work_shift_id',
                    'employee_workshifts_details.employee_workshift_id',
                    'employee_workshifts_details.schedule_date',
                    'employee_workshifts_details.schedule_day',
                    'employee_workshifts_details.division_shift_id',
                    'employee_workshifts_details.department_shift_id',
                    'employee_workshifts_details.sub_department_shift_id',
                    'employee_workshifts_details.sub_department_unit_id',
                    'employee_workshifts_details.day_off',
                    'employee_workshifts_details.oc',
                    'work_shifts.time_from',
                    'work_shifts.time_to',
                ])
                ->join('employee_workshifts', function ($join) {
                    $join->on('employee_workshift_id', '=', 'employee_workshifts.id');
                })
                ->join('work_shifts', function ($join) {
                    $join->on('employee_workshifts_details.work_shift_id', '=', 'work_shifts.id');
                })
                ->whereBetween('schedule_date', [$request->dateFrom, $request->dateTo])
                ->where('employee_workshifts.employee_id', $employee->id)
                ->where('employee_workshifts_details.is_active', 1)
                // ->where('employee_workshift_id', $employee->workshift_id)
                ->get();

            $workshiftDetails->map(function ($shift) {
                if (isset($shift->time_from) || isset($shift->time_to)) {
                    $shift->time_from = Carbon::parse($shift->time_from)->format('g:i A');
                    $shift->time_to = Carbon::parse($shift->time_to)->format('g:i A');
                } else {
                    $shift->time_from = null;
                    $shift->time_to = null;
                }
                return $shift;
            });

            $employee->selectedShift = $workshiftDetails->isNotEmpty() ? $workshiftDetails : null;

            return $employee;
        });

        return response()->json($query);
    }

    public function getWorkShifts(Request $request)
    {
        $searchType = $request->searchType;
        $searchId = $request->searchId;

        $tableMap = [
            'divisions' => 'division_shifts',
            'departments' => 'department_shifts',
            'sub_departments' => 'sub_department_shifts',
            'sub_department_units' => 'sub_department_unit_shifts'
        ];

        $columnMap = [
            'divisions' => 'division_id',
            'departments' => 'department_id',
            'sub_departments' => 'sub_department_id',
            'sub_department_units' => 'sub_department_unit_id'
        ];

        if (!array_key_exists($searchType, $tableMap)) {
            return response()->json(['error' => 'Invalid search type'], 400);
        }

        $shifts = DB::table('work_shifts as T0')
            ->join($tableMap[$searchType] . ' as T1', 'T0.id', '=', 'T1.work_shift_id')
            ->select('T0.id', 'T0.shift_name', 'T0.time_from', 'T0.time_to')
            ->where('T0.is_active', 1)
            ->where('T1.is_active', 1)
            ->where("T1.{$columnMap[$searchType]}", $searchId)
            ->get();

        // Format the time fields
        $formattedShifts = $shifts->map(function ($shift) {
            $shift->time_from = Carbon::parse($shift->time_from)->format('g:i A');
            $shift->time_to = Carbon::parse($shift->time_to)->format('g:i A');
            $shift->time_from_to = "{$shift->time_from} - {$shift->time_to}";
            return $shift;
        });

        return response()->json($formattedShifts);
    }
}
