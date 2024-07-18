<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeEmploymentHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = ['employees'=>'employee_id'];

    protected $fillable = [
        'employee_id',
        'company_name',
        'company_address',
        'company_contactno',
        'from_date',
        'to_date',
        'job_title',
        'salary_on_leaving',
        'designation_on_joining',
        'designation_on_leaving',
        'industry_type',
        'roles_and_responsibilities',
        'key_experiences',
        'reason_for_leaving',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
