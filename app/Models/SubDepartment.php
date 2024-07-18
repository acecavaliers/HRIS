<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\SubDepartmentUnit;
use App\Models\PersonnelRequisition;
use App\Models\EmployeeWorkAssignment;

use Illuminate\Database\Eloquent\SoftDeletes;

class SubDepartment extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = ['departments' => 'department_id'];


    protected $fillable = [

        'department_id',
        'code',
        'short_name',
        'name',
        'description',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function departments(){
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function subdepartmentunit(){
        return $this->hasMany(SubDepartmentUnit::class);
    }

    public function personnelrequisition()
    {
        return $this->hasMany(PersonnelRequisition::class);
    }

    public function employeeworkassignments()
    {
        return $this->hasMany(EmployeeWorkAssignment::class, 'sub_department_id');
    }
}
