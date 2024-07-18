<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\EducationLevel;
use App\Models\EmployeeEducation;

use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use HasFactory , SoftDeletes;

    protected $foreignKeys = ['cities' => 'city_id'];

    protected $fillable = [

        'city_id',
        'code',
        'short_name',
        'name',
        'description',
        'address',
        'contact_number',
        'email_address',
        'is_active',
        'is_private',
        'school_logo',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function cities()
    {
        return $this->belongsTo(City::class , 'city_id');
    }

    public function educationlevels()
    {
        return $this->belongsToMany(EducationLevel::class, 'education_level_schools', 'school_id', 'education_level_id');
    }

    public function employeeeducations()
    {
        return $this->hasMany(EmployeeEducation::class, 'employee_education_id');
    }
}
