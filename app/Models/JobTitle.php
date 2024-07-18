<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JobLevel;
use App\Models\JobTitleCategory;
use App\Models\EmployeeWorkAssignment;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PrfApproverSetting;

class JobTitle extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = ['joblevels'=>'job_level_id', 'jobtitlecategories'=>'job_title_category_id'];

    protected $fillable = [
        'job_level_id',
        'job_title_category_id',
        'name',
        'job_description',
        'roles_and_responsibilities',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];


    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function joblevels()
    {
        return $this->belongsTo(JobLevel::class, 'job_level_id');
    }

    public function jobtitlecategories()
    {
        return $this->belongsTo(JobTitleCategory::class, 'job_title_category_id');
    }

    public function prfapproversettings()
    {
        return $this->hasMany(PrfApproverSetting::class, 'job_title_id');
    }




    public function employeeworkassignments()
    {
        return $this->hasMany(EmployeeWorkAssignment::class, 'job_title_id');
    }

}
