<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DayShift;

use Illuminate\Database\Eloquent\SoftDeletes;

class WorkShift extends Model
{
    use HasFactory, SoftDeletes;


    protected $foreignKeys = [];

    protected $fillable = [

        'shift_name',
        'time_from',
        'time_to',
        'enable_shift_margin',
        'hrs_before_shift_starts',
        'hrs_after_shift_ends',
        'enable_oncall',
        'oncall_rate_per_day',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function dayshifts()
    {
        return $this->hasMany(DayShift::class, 'day_shift_id');
    }
    public function department_shifts()
    {
        return $this->hasMany(DepartmentShift::class, 'department_id');
    }
    public function division_shifts()
    {
        return $this->hasMany(DivisionShift::class, 'division_id');
    }


}
