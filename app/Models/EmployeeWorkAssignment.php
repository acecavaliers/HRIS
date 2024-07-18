<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\JobTitle;
use App\Models\WorkLocation;
use App\Models\EmploymentType;
use App\Models\Division;
use App\Models\Department;
use App\Models\SubDepartment;
use App\Models\SubDepartmentUnit;
use App\Models\EmployeeEmploymentDetail;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeWorkAssignment extends Model
{
    use HasFactory , SoftDeletes;

    protected $foreignKeys = ['employees'=>'employee_id' , 'job_titles'=>'job_title_id' , 'work_locations'=>'work_location_id' ,
    'employment_types' => 'employment_type_id', 'divisions'=>'division_id', 'departments' => 'department_id', 'sub_departments' => 'sub_department_id',
    'sub_department_units' => 'sub_department_unit_id', 'employee_employment_details' => 'employee_employment_detail_id'];

    protected $fillable = [
        'employee_id',
        'job_title_id',
        'work_location_id',
        'employment_type_id',
        'division_id',
        'department_id',
        'sub_department_id',
        'sub_department_unit_id',
        'start_date',
        'end_date',
        'salary_value',
        'remarks',
        'employee_employment_detail_id',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function jobtitles()
    {
        return $this->belongsTo(JobTitle::class, 'job_title_id');
    }

    public function worklocations()
    {
        return $this->belongsTo(WorkLocation::class, 'work_location_id');
    }

    public function employmenttypes()
    {
        return $this->belongsTo(EmploymentType::class, 'employment_type_id');
    }

    public function divisions()
    {
        return $this->belongsTo(Division::class ,'division_id');
    }

    public function departments()
    {
        return $this->belongsTo(Department::class , 'department_id');
    }

    public function subdepartments()
    {
        return $this->belongsTo(SubDepartment::class, 'sub_department_id');
    }

    public function subdepartmentunits()
    {
        return $this->belongsTo(SubDepartmentUnit::class, 'sub_department_unit_id');
    }

    public function employeeemploymentdetails(){
        return $this->belongsTo(EmployeeEmploymentDetail::class, 'employee_employment_detail_id');
    }
}
