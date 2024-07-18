<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Applicant;
use App\Models\EmployeeEmploymentDetail;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationSource extends Model
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


    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }

    public function employeeemploymentdetails()
    {
        return $this->hasMany(EmployeeEmploymentDetail::class, 'application_source_id');
    }
}
