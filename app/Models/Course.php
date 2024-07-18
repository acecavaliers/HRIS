<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\EducationLevel;
use App\Models\CourseCategory;
use App\Models\EmployeeEducation;

class Course extends Model
{
    use HasFactory , SoftDeletes;

    protected $foreignKeys = ['education_levels' => 'education_level_id', 'course_categories'=>'course_category_id'];


    protected $fillable = [

        'education_level_id',
        'course_category_id',
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

    public function educationlevels()
    {
        return $this->belongsTo(EducationLevel::class, 'education_level_id');
    }

    public function coursecategories()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }

    public function employeeeducations()
    {
        return $this->hasMany(EmployeeEducation::class, 'employee_education_id');
    }
}
