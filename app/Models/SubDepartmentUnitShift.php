<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubDepartmentUnitShift extends Model
{
    use HasFactory , SoftDeletes;

    protected $foreignKeys = ['work_shifts' => 'work_shift_id', 'sub_department_units' => 'sub_department_unit_id'];

    protected $fillable = [
        'sub_department_unit_id',
        'work_shift_id',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];


    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    public function sub_department_units()
    {
        return $this->belongsTo(SubDepartmentUnit::class, 'sub_department_unit_id');
    }

    public function workshifts()
    {
        return $this->belongsTo(WorkShift::class, 'work_shift_id');
    }
}
