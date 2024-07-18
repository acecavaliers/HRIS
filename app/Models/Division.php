<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\PersonnelRequisition;
use App\Models\EmployeeWorkAssignment;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use HasFactory , SoftDeletes;

    protected $foreignKeys = [];

    protected $fillable = [

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

    public function department(){
        return $this->hasMany(Department::class);
    }

    public function personnelrequisition()
    {
        return $this->hasMany(PersonnelRequisition::class);
    }

    public function employeeworkassignments()
    {
        return $this->hasMany(EmployeeWorkAssignment::class, 'division_id');
    }
}
