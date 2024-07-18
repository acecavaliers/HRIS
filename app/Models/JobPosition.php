<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\JobLevel;
use App\Models\PersonnelRequisition;

class JobPosition extends Model
{
    use HasFactory,SoftDeletes ;

    protected $foreignKeys = ['joblevels' => 'joblevel_id'];

    protected $fillable = [

        'job_level_id',
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

    public function joblevels(){
        return $this->belongsTo(JobLevel::class);
    }

    public function personnelrequisition()
    {
        return $this->hasMany(PersonnelRequisition::class);
    }
}
