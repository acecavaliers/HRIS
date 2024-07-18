<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubDepartment;
use App\Models\PersonnelRequisition;
use App\Models\EmployeeWorkAssignment;

use Illuminate\Database\Eloquent\SoftDeletes;

class SubDepartmentUnit extends Model
{
    use HasFactory, SoftDeletes ;

    protected $foreignKeys = ['sub_departments' => 'sub_department_id'];

    protected $fillable = [

        'sub_department_id',
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

    public function subdepartments(){
        return $this->belongsTo(SubDepartment::class, 'sub_department_id');
    }

    public function personnelrequisition()
    {
        return $this->hasMany(PersonnelRequisition::class);
    }

    public function employeeworkassignments()
    {
        return $this->hasMany(EmployeeWorkAssignment::class, 'sub_department_unit_id');
    }
}
