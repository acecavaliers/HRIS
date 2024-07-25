<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubDepartmentUnitShiftSetup extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [
        'shift_setups' => 'shift_setup_id',
        'sub_department_units' => 'sub_department_unit_id'
    ];

    protected $fillable = [
        'sub_department_unit_id',
        'shift_setup_id',
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

    public function shift_setups()
    {
        return $this->belongsTo(ShiftSetup::class, 'shift_setup_id');
    }
}
