<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeeDependent;
use App\Models\EmployeeFamilyBackground;
use App\Models\EmployeeEducation;
use App\Models\EmployeeEmploymentDetail;
use App\Models\EmployeeWorkAssignment;
use App\Models\EmployeeEmploymentHistory;
use App\Models\EmployeeIdentification;
use App\Models\EmployeeDisciplinaryAction;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PrfApprover;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [];
    protected $appends = ['full_name'];
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'has_middle_name',
        'gender',
        'civil_status',
        'birth_date',
        'nationality',
        'religion',
        'contactinfo_landlineno',
        'contactinfo_mobileno',
        'street',
        'bldgsubd',
        'region',
        'province',
        'city',
        'barangay',
        'zip_code',
        'country',
        'email_address',
        'blood_type',
        'is_active',
        'photo',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    public function employeedependents()
    {
        return $this->hasMany(EmployeeDependent::class, 'employee_id');
    }

    public function employeefamilybackgrounds()
    {
        return $this->hasMany(EmployeeFamilyBackground::class, 'employee_id');
    }

    public function employeeeducations()
    {
        return $this->hasMany(EmployeeEducation::class, 'employee_id');
    }

    public function prfapprovers()
    {
        return $this->hasMany(PrfApprover::class, 'employee_id');
    }

    public function employeeemploymentdetails()
    {
        return $this->hasMany(EmployeeEmploymentDetail::class, 'employee_id');
    }

    public function employeeworkassignments()
    {
        return $this->hasMany(EmployeeWorkAssignment::class, 'employee_id');
    }

    public function employeeemploymenthistories()
    {
        return $this->hasMany(EmployeeEmploymentHistory::class, 'employee_id');
    }

    public function employeeidentifications()
    {
        return $this->hasMany(EmployeeIdentification::class, 'employee_id');
    }

    public function employeedisciplinaryactions()
    {
        return $this->hasMany(EmployeeDisciplinaryAction::class, 'employee_id');
    }

    public function getFullNameAttribute() // notice that the attribute name is in CamelCase.
    {
        return $this->first_name . ' ' . $this->last_name;
    }

  


}
