<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Relationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeFamilyBackground extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = ['employees' => 'employee_id', 'relationships' => 'relationship_id'];

    protected $fillable = [
        'employee_id',
        'relationship_id',
        'first_name',
        'middle_name',
        'last_name',
        'has_middle_name',
        'birth_date',
        'occupation',
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

    public function relationships()
    {
        return $this->belongsTo(Relationship::class, 'relationship_id');
    }
}
