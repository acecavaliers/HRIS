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
    public function index(){

        return Inertia::render('Timekeeping/EmployeeWorkSchedule');
    }
    public function getDivisions(Request $request){

        $query = Division::where('is_active','1')->get();
                            // ->get('name','id','division_id');
        return $query;

        //         $query = Division::with('departmets')->where('is_active', 1)->get();

        // return $query;

    }

    public function getDept(Request $request){

        $query = Department::where('is_active','1')
                            // ->where('division_id', $request->divID)
                            ->get();
                            // ->get(['id','name','division_id','short_name']);
        return $query;
    }

    public function getSubDept(Request $request){

        $query = SubDepartment::where('is_active','1')
                            // ->where('division_id', $request->divID)
                            ->get();
                            // ->get(['id','name','division_id','short_name']);
        return $query;
    }

    public function getSubDeptUnit(Request $request){

        $query = SubDepartmentUnit::where('is_active','1')
                            // ->where('division_id', $request->divID)
                            ->get();
                            // ->get(['id','name','division_id','short_name']);
        return $query;
    }

    public function update(Request $request, string $id)
    {
        try {
            $arr = $request->formdata;

            $workshiftDetails = EmployeeWorkshiftsDetail::where('employee_workshift_id', $id)->get();

            $rowsUpdated = 0;

            foreach ($workshiftDetails as $workshiftDetail) {
                // Find the corresponding item in $arr by id
                $matchingArrItem = collect($arr)->firstWhere('id', $workshiftDetail->id);

                // Compare and update if necessary
                if ($matchingArrItem && ($workshiftDetail->day_off != $matchingArrItem['day_off'] || $workshiftDetail->oc != $matchingArrItem['oc'])) {
                    // Update the workshift detail
                    $workshiftDetail->day_off = $matchingArrItem['day_off'];
                    $workshiftDetail->oc = $matchingArrItem['oc'];
                    $workshiftDetail->updated_by =  Auth::user()->name;
                    $workshiftDetail->save();
                    $rowsUpdated++;
                }
            }

            return $workshiftDetails;
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
        $insertedCount = 0;

        if (!empty($empIDs)) {

            foreach ($empIDs as $empID) {
                $arr['employee_id'] = $empID;

                // Check if a record already exists with the same employee_id, period_from, and period_to
                $existingWorkshift = EmployeeWorkshift::where('employee_id', $arr['employee_id'])
                        ->where(function($query) use ($arr) {
                            $query->whereBetween('period_from', [$arr['period_from'], $arr['period_to']])
                                ->orWhereBetween('period_to', [$arr['period_from'], $arr['period_to']]);
                        })
                    ->first();

                // Only create a new record if it doesn't already exist
                if (!$existingWorkshift) {
                    $que = EmployeeWorkshift::create($arr);
                    $insertedCount++;

                    if ($que) {
                        if($setby < 1){
                            $shift['employee_workshift_id'] = $que->id;
                            $shift['work_shift_id'] = $que->work_shift_id;
                            $shift['created_by'] = $que->created_by;
                            EmployeeWorkshiftsDetail::create($shift);

                        }else{
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
                }
                else{
                    if($setby < 1){
                        $existingDetail = EmployeeWorkshiftsDetail::where('employee_workshift_id', $existingWorkshift->id)
                        ->where('schedule_date', $shift['schedule_date'])
                        ->first();
                        if(!$existingDetail){
                            $shift['employee_workshift_id'] = $existingWorkshift->id;
                            $shift['work_shift_id'] = $arr['work_shift_id'];
                            $shift['created_by'] = Auth::user()->name;
                            EmployeeWorkshiftsDetail::create($shift);
                        }

                    }else{

                        $filteredShiftDates = array_filter($shiftDates, function($shifts) use ($existingWorkshift) {
                            $existingDetail = EmployeeWorkshiftsDetail::where('employee_workshift_id', $existingWorkshift->id)
                                ->where('schedule_date', $shifts['schedule_date'])
                                ->first();
                            return !$existingDetail;
                        });

                        foreach ($filteredShiftDates as $shifts) {
                            $shifts['employee_workshift_id'] = $existingWorkshift->id;
                            $shifts['work_shift_id'] = $existingWorkshift->work_shift_id;
                            $shifts['day_off'] = $shift['day_off'];
                            $shifts['oc'] = $shift['oc'];
                            $shifts['created_by'] = Auth::user()->name;

                            EmployeeWorkshiftsDetail::create($shifts);
                        }
                    }

                }
            }
            if ($insertedCount >0){
                return 'success';
            }else{
                return 'existed';
            }
            // return 'success';

        }else{

            $existingWorkshift = EmployeeWorkshift::where('employee_id', $arr['employee_id'])
                        ->where(function($query) use ($arr) {
                            $query->whereBetween('period_from', [$arr['period_from'], $arr['period_to']])
                                ->orWhereBetween('period_to', [$arr['period_from'], $arr['period_to']]);
                        })
                    ->first();

                // Only create a new record if it doesn't already exist
                if (!$existingWorkshift) {
                    $que = EmployeeWorkshift::create($arr);


                    if ($que) {

                        if($setby < 1){
                            $shift['employee_workshift_id'] = $que->id;
                            $shift['work_shift_id'] = $que->work_shift_id;
                            $shift['created_by'] = $que->created_by;
                            EmployeeWorkshiftsDetail::create($shift);


                        }else{
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
                }else{

                    if($setby < 1){
                        $shift['employee_workshift_id'] = $existingWorkshift->id;
                        $shift['work_shift_id'] = $arr['work_shift_id'];
                        $shift['created_by'] = Auth::user()->name;
                        EmployeeWorkshiftsDetail::create($shift);

                    }else{

                        $filteredShiftDates = array_filter($shiftDates, function($shifts) use ($existingWorkshift) {
                            $existingDetail = EmployeeWorkshiftsDetail::where('employee_workshift_id', $existingWorkshift->id)
                                ->where('schedule_date', $shifts['schedule_date'])
                                ->first();
                            return !$existingDetail;
                        });

                        foreach ($filteredShiftDates as $shifts) {
                            $shifts['employee_workshift_id'] = $existingWorkshift->id;
                            $shifts['work_shift_id'] = $existingWorkshift->work_shift_id;
                            $shifts['day_off'] = $shift['day_off'];
                            $shifts['oc'] = $shift['oc'];
                            $shifts['created_by'] = Auth::user()->name;

                            EmployeeWorkshiftsDetail::create($shifts);
                        }
                    }
                }
            // $que = EmployeeWorkshift::create($arr);

            // if ($que) {

            //     $shift['employee_workshift_id'] = $que->id;
            //     $shift['work_shift_id'] = $que->work_shift_id;
            //     $shift['created_by'] = $que->created_by;
            //     EmployeeWorkshiftsDetail::create($shift);

            //     // if ($shiftLength >1){
            //     //     $shift['employee_workshift_id'] = $que->id;
            //     //     $shift['work_shift_id'] = $que->work_shift_id;
            //     //     $shift['created_by'] = $que->created_by;
            //     //     EmployeeWorkshiftsDetail::create($shift);
            //     // }
            //     // else{

            //     //     foreach ($shift as $shifts) {
            //     //         $shifts['employee_workshift_id'] = $que->id;
            //     //         $shifts['work_shift_id'] = $que->work_shift_id;
            //     //         $shifts['created_by'] = $que->created_by;
            //     //         EmployeeWorkshiftsDetail::create($shifts);
            //     //     }

            //     // }


            //     // if(is_array($shift)){

            //     //     foreach ($shift as $shifts) {
            //     //         $shifts['employee_workshift_id'] = $que->id;
            //     //         $shifts['work_shift_id'] = $que->work_shift_id;
            //     //         $shifts['created_by'] = $que->created_by;
            //     //         EmployeeWorkshiftsDetail::create($shifts);
            //     //     }

            //     // }else{
            //     //     // $shift['employee_workshift_id'] = $que->id;
            //     //     // $shift['work_shift_id'] = $que->work_shift_id;
            //     //     // $shift['created_by'] = $que->created_by;
            //     //     // EmployeeWorkshiftsDetail::create($shift);
            //     // }
            // }

            return 'success';

        }

    }

    public function getlist(Request $request){

        if($request->searchType == 'division' )
        {

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
                'employee_workshifts.id as workshift_id',
                'employee_workshifts.period_from',
                'employee_workshifts.period_to',
            ])
            ->join('employee_work_assignments', 'employees.id', '=', 'employee_work_assignments.employee_id')
            ->leftJoin('employee_workshifts', function($join) {
                $join->on('employees.id', '=', 'employee_workshifts.employee_id')
                     ->where('employee_workshifts.is_active', '=', 1);
            })
            ->where('employee_work_assignments.is_active', 1)
            ->where('employee_work_assignments.division_id', $request->searchId)
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
                    ->leftJoin('work_shifts', function($join) {
                            $join->on('employee_workshifts_details.work_shift_id', '=', 'work_shifts.id');
                        })
                    ->whereBetween('schedule_date', [$request->dateFrom, $request->dateTo])
                    ->where('employee_workshift_id', $employee->workshift_id)
                    ->get();

                    $workshiftDetails->map(function ($employee) {
                        if (isset($employee->time_from) || isset($employee->time_to)) {
                            $employee->time_from = Carbon::parse($employee->time_from)->format('g:i A');
                            $employee->time_to = Carbon::parse($employee->time_to)->format('g:i A');
                        } else {
                            $employee->time_from = null;
                            $employee->time_to = null;
                        }
                        return $employee;
                    });

                $employee->selectedShift = $workshiftDetails->isNotEmpty() ? $workshiftDetails : null;

                return $employee;
            });

            return response()->json($query);

        }

        if($request->searchType == 'department' )
        {

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
                'employee_workshifts.id as workshift_id',
                'employee_workshifts.period_from',
                'employee_workshifts.period_to',

            ])
            ->join('employee_work_assignments', 'employees.id', '=', 'employee_work_assignments.employee_id')
            ->leftJoin('employee_workshifts', function($join) {
                $join->on('employees.id', '=', 'employee_workshifts.employee_id')
                     ->where('employee_workshifts.is_active', '=', 1);
            })

            ->where('employee_work_assignments.is_active', 1)
            ->where('employee_work_assignments.department_id', $request->searchId)
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
                    ->leftJoin('work_shifts', function($join) {
                            $join->on('employee_workshifts_details.work_shift_id', '=', 'work_shifts.id');
                        })
                    ->whereBetween('schedule_date', [$request->dateFrom, $request->dateTo])
                    ->where('employee_workshift_id', $employee->workshift_id)
                    ->get();

                    $workshiftDetails->map(function ($employee) {
                        if (isset($employee->time_from) || isset($employee->time_to)) {
                            $employee->time_from = Carbon::parse($employee->time_from)->format('g:i A');
                            $employee->time_to = Carbon::parse($employee->time_to)->format('g:i A');
                        } else {
                            $employee->time_from = null;
                            $employee->time_to = null;
                        }
                        return $employee;
                    });
                $employee->selectedShift = $workshiftDetails->isNotEmpty() ? $workshiftDetails : null;

                return $employee;
            });
            return response()->json($query);
        }
        if($request->searchType == 'subdepartment' )
        {

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
                'employee_workshifts.id as workshift_id',
                'employee_workshifts.period_from',
                'employee_workshifts.period_to',

            ])
            ->join('employee_work_assignments', 'employees.id', '=', 'employee_work_assignments.employee_id')
            ->leftJoin('employee_workshifts', function($join) {
                $join->on('employees.id', '=', 'employee_workshifts.employee_id')
                     ->where('employee_workshifts.is_active', '=', 1);
            })

            ->where('employee_work_assignments.is_active', 1)
            ->where('employee_work_assignments.sub_department_id', $request->searchId)
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
                    ->leftJoin('work_shifts', function($join) {
                            $join->on('employee_workshifts_details.work_shift_id', '=', 'work_shifts.id');
                        })
                    ->whereBetween('schedule_date', [$request->dateFrom, $request->dateTo])
                    ->where('employee_workshift_id', $employee->workshift_id)
                    ->get();

                    $workshiftDetails->map(function ($employee) {
                        if (isset($employee->time_from) || isset($employee->time_to)) {
                            $employee->time_from = Carbon::parse($employee->time_from)->format('g:i A');
                            $employee->time_to = Carbon::parse($employee->time_to)->format('g:i A');
                        } else {
                            $employee->time_from = null;
                            $employee->time_to = null;
                        }
                        return $employee;
                    });
                $employee->selectedShift = $workshiftDetails->isNotEmpty() ? $workshiftDetails : null;

                return $employee;
            });
            return response()->json($query);
        }

        if($request->searchType == 'subdepartmentunit' )
        {

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
                'employee_workshifts.id as workshift_id',
                'employee_workshifts.period_from',
                'employee_workshifts.period_to',

            ])
            ->join('employee_work_assignments', 'employees.id', '=', 'employee_work_assignments.employee_id')
            ->leftJoin('employee_workshifts', function($join) {
                $join->on('employees.id', '=', 'employee_workshifts.employee_id')
                     ->where('employee_workshifts.is_active', '=', 1);
            })

            ->where('employee_work_assignments.is_active', 1)
            ->where('employee_work_assignments.sub_department_unit_id', $request->searchId)
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
                    ->leftJoin('work_shifts', function($join) {
                            $join->on('employee_workshifts_details.work_shift_id', '=', 'work_shifts.id');
                        })
                    ->whereBetween('schedule_date', [$request->dateFrom, $request->dateTo])
                    ->where('employee_workshift_id', $employee->workshift_id)
                    ->get();

                    $workshiftDetails->map(function ($employee) {
                        if (isset($employee->time_from) || isset($employee->time_to)) {
                            $employee->time_from = Carbon::parse($employee->time_from)->format('g:i A');
                            $employee->time_to = Carbon::parse($employee->time_to)->format('g:i A');
                        } else {
                            $employee->time_from = null;
                            $employee->time_to = null;
                        }
                        return $employee;
                    });
                $employee->selectedShift = $workshiftDetails->isNotEmpty() ? $workshiftDetails : null;

                return $employee;
            });
            return response()->json($query);
        }

    }

    public function getWorkShifts(Request $request)
    {

        if($request->searchType == 'division'){

            $shifts = DB::table('work_shifts as T0')
            ->join('division_shifts as T1', 'T0.id', '=', 'T1.work_shift_id')
            ->select('T0.id','T0.shift_name', 'T0.time_from', 'T0.time_to')
            ->where('T0.is_active', 1)
            ->where('T1.is_active', 1)
            ->where('T1.division_id', $request->searchId )
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
        if($request->searchType == 'department'){

            $shifts = DB::table('work_shifts as T0')
            ->join('department_shifts as T1', 'T0.id', '=', 'T1.work_shift_id')
            ->select('T0.id','T0.shift_name', 'T0.time_from', 'T0.time_to')
            ->where('T0.is_active', 1)
            ->where('T1.is_active', 1)
            ->where('T1.department_id', $request->searchId )
            ->get();

            // Format the time fields
            $formattedShifts = $shifts->map(function ($shift) {
                $shift->time_from = Carbon::parse($shift->time_from)->format('g:i A');
                $shift->time_to = Carbon::parse($shift->time_to)->format('g:i A');
                return $shift;
            });

            return response()->json($formattedShifts);

        }
        if($request->searchType == 'subdepartment'){

            $shifts = DB::table('work_shifts as T0')
            ->join('sub_department_shifts as T1', 'T0.id', '=', 'T1.work_shift_id')
            ->select('T0.id','T0.shift_name', 'T0.time_from', 'T0.time_to')
            ->where('T0.is_active', 1)
            ->where('T1.is_active', 1)
            ->where('T1.sub_department_id', $request->searchId )
            ->get();

            // Format the time fields
            $formattedShifts = $shifts->map(function ($shift) {
                $shift->time_from = Carbon::parse($shift->time_from)->format('g:i A');
                $shift->time_to = Carbon::parse($shift->time_to)->format('g:i A');
                return $shift;
            });

            return response()->json($formattedShifts);

        }
        if($request->searchType == 'subdepartmentunit'){

            $shifts = DB::table('work_shifts as T0')
            ->join('sub_department_unit_shifts as T1', 'T0.id', '=', 'T1.work_shift_id')
            ->select('T0.id','T0.shift_name', 'T0.time_from', 'T0.time_to')
            ->where('T0.is_active', 1)
            ->where('T1.is_active', 1)
            ->where('T1.sub_department_unit_id', $request->searchId )
            ->get();

            // Format the time fields
            $formattedShifts = $shifts->map(function ($shift) {
                $shift->time_from = Carbon::parse($shift->time_from)->format('g:i A');
                $shift->time_to = Carbon::parse($shift->time_to)->format('g:i A');
                return $shift;
            });

            return response()->json($formattedShifts);

        }


    }


}
