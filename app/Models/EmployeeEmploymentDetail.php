<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\EmployeeStatus;
use App\Models\ApplicationSource;
use App\Models\EmployeeWorkAssignment;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeEmploymentDetail extends Model
{
    use HasFactory , SoftDeletes;


    protected $foreignKeys = ['employees' => 'employee_id', 'employee_statuses' => 'employee_status_id', 'application_sources'=>'application_source_id'];

    protected $fillable = [
        'employee_id',
        'employment_number',
        'confirmation_due_date',
        'confirmed_date',
        'date_of_joining',
        'effective_date',
        'end_date',
        'employee_status_id',
        'application_source_id',
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

    public function employeestatuses()
    {
        return $this->belongsTo(EmployeeStatus::class, 'employee_status_id');
    }

    public function applicationsources()
    {
        return $this->belongsTo(ApplicationSource::class, 'application_source_id');
    }

    public function employeeworkassignments()
    {
        return $this->belongsTo(EmployeeWorkAssignment::class, 'employee_employment_detail_id');
    }

    
}
