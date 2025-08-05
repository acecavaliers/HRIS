<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestTimeOff extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = ['employees' => 'employee_id', 'leave_types' => 'leave_type_id',];

    protected $fillable = [
        'employee_id',
        'leave_type_id',
        'date_from',
        'date_to',
        'number_of_days',
        'reason',
        'status',
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

    public function leave_types()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }
}
