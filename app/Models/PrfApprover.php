<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PersonnelRequisition;
use App\Models\Employee;

class PrfApprover extends Model
{
    use HasFactory;

    protected $foreignKeys = [
        'personnel_requisitions' => 'personnel_requisition_id',
        'employees' => 'employee_id',
    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    protected $fillable = [
        'personnel_requisition_id',
        'employee_id',
        'is_approved',
        'is_rejected',
        'rejected_reason',
        'is_onhold',
        'onhold_reason',
        'remarks',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    public function personnelrequisitions(){
        return $this->belongsTo(PersonnelRequisition::class,'personnel_requisition_id');
    }

    public function employees(){
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
