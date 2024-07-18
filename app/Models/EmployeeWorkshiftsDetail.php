<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeWorkshiftsDetail extends Model
{
    use HasFactory , SoftDeletes;

    protected $foreignKeys = ['workshifts' => 'work_shift_id','employee_workshifts' =>'employee_workshift_id'];

    protected $fillable = [

        'employee_workshift_id',
        'work_shift_id',
        'schedule_date',
        // 'shift_start',
        // 'shift_end',
        'day_off',
        'oc',
        'schedule_day',
        'division_shift_id',
        'department_shift_id',
        'sub_department_shift_id',
        'sub_department_unit_id',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',

    ];


    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    public function employee_workshifts()
    {
        return $this->belongsTo(EmployeeWorkshift::class, 'employee_workshift_id');
    }

    public function workshifts()
    {
        return $this->belongsTo(WorkShift::class, 'work_shift_id');
    }

    public function division_shifts()
    {
        return $this->belongsTo(DivisionShift::class, 'division_shift_id')->withDefault();
    }
}
