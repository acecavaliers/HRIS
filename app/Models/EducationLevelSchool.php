<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EducationLevel;
use App\Models\School;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationLevelSchool extends Model
{
    use HasFactory ,SoftDeletes;


    protected $foreignKeys = ['education_levels' => 'education_level_id', 'schools'=>'school_id'];

    protected $fillable = [

        'education_level_id',
        'school_id',
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

    public function schools()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
}
