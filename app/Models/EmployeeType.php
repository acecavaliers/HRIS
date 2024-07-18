<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PersonnelRequisition;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeType extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [];

    protected $fillable = [

        'code',
        'short_name',
        'name',
        'description',
        'is_daily_rate',
        'is_hourly_rate',
        'is_employee',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function personnelrequisitions()
    {
        return $this->hasMany(PersonnelRequisition::class);
    }
}
