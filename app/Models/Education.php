<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EducationLevel;
use App\Models\EmployeeEducation;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [];

    protected $fillable = [

        'code',
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

    public function educationlevel()
    {
        return $this->hasMany(EducationLevel::class);
    }

    public function employeeeducations()
    {
        return $this->hasMany(EmployeeEducation::class, 'employee_education_id');
    }


}
