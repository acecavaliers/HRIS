<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Course;
use App\Models\EmployeeEducation;
use App\Models\Education;
use App\Models\EducationLevelSchool;
class EducationLevel extends Model
{
    use HasFactory , SoftDeletes;

    protected $foreignKeys = ['educations' => 'education_id'];

    protected $fillable = [

        'education_id',
        'code',
        'name',
        'other_name',
        'description',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function educations()
    {
        return $this->belongsTo(Education::class, 'education_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function schools()
    {
        return $this->belongsToMany(School::class, 'education_level_schools', 'education_level_id', 'school_id');
    }

    public function employeeeducations()
    {
        return $this->hasMany(EmployeeEducation::class, 'employee_education_id');
    }
}
