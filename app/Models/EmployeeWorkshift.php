<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeWorkshift extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = ['workshifts' => 'work_shift_id', 'employees' => 'employee_id'];

    protected $fillable = [
        'employee_id',
        'work_shift_id',
        'period_from',
        'period_to',
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

    public function workshifts()
    {
        return $this->belongsTo(WorkShift::class, 'work_shift_id');
    }
}
