<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Education;
use App\Models\EducationLevel;
use App\Models\School;
use App\Models\CourseCategory;
use App\Models\Course;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeEducation extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = ['employees' => 'employee_id', 'education' => 'education_id', 'education_levels' => 'education_level_id' ,
    'schools' => 'school_id', 'course_categories' => 'course_category_id', 'courses' => 'course_id'];

    protected $fillable =
    [
        'employee_id',
        'education_id',
        'education_level_id',
        'school_id',
        'attended_from',
        'attended_to',
        'course_category_id',
        'course_id',
        'is_company_sponsored',
        'is_graduated',
        'gpa_grade',
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
        return $this->belongsTo(Employee::class , 'employee_id');
    }

    public function educations()
    {
        return $this->belongsTo(Education::class , 'education_id');
    }

    public function educationlevels()
    {
        return $this->belongsTo(EducationLevel::class, 'education_level_id');
    }

    public function schools()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function coursecategories()
    {
        return $this->belongsTo(CourseCategory::class , 'course_category_id');
    }

    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
