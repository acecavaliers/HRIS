<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Division;
use App\Models\SubDepartment;
use App\Models\PersonnelRequisition;
use App\Models\EmployeeWorkAssignment;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = ['divisions' => 'division_id'];

    protected $fillable = [

        'division_id',
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

    public function divisions(){
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function subdepartment(){
        return $this->hasMany(SubDepartment::class);
    }

    public function personnelrequisition()
    {
        return $this->hasMany(PersonnelRequisition::class);
    }

    public function employeeworkassignments()
    {
        return $this->hasMany(EmployeeWorkAssignment::class, 'department_id');
    }

}

