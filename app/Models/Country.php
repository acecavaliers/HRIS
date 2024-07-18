<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
use App\Models\SalaryGrade;
use App\Models\WorkLocation;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [];

    protected $fillable = [

        'flag',
        'short_name',
        'name',
        'description',
        'currency_text',
        'currency_shortcut',
        'currency_symbol',
        'calling_code',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function regions(){
        return $this->hasMany(Region::class, 'region_id');
    }

    public function salarygrade()
    {
        return $this->hasMany(SalaryGrade::class);
    }

    public function worklocations()
    {
        return $this->hasMany(WorkLocation::class, 'work_location_id');
    }


    public function salarystandardizations()
    {
        return $this->hasMany(SalaryStandardization::class);
    }
}
