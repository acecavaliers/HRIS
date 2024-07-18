<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeeDependent;
use App\Models\EmployeeFamilyBackground;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relationship extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [];

    protected $fillable = [

        'code',
        'short_name',
        'name',
        'description',
        'legend_color_code',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function employeedependents()
    {
        return $this->hasMany(EmployeeDependent::class, 'relationship_id');
    }

    public function employeefamilybackgrounds()
    {
        return $this->hasMany(EmployeeFamilyBackground::class, 'relationship_id');
    }
}
