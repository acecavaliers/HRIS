<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubDepartmentShift extends Model
{
    use HasFactory , SoftDeletes;

    protected $foreignKeys = ['work_shifts' => 'work_shift_id', 'sub_departments' => 'sub_department_id'];

    protected $fillable = [
        'sub_department_id',
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

    public function sub_departments()
    {
        return $this->belongsTo(SubDepartment::class, 'sub_department_id');
    }

    public function workshifts()
    {
        return $this->belongsTo(WorkShift::class, 'work_shift_id');
    }
}
