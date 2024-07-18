<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Province;
use App\Models\School;
use App\Models\WorkLocation;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = ['provinces' => 'province_id'];

    protected $fillable = [

        'province_id',
        'flag',
        'seal',
        'short_name',
        'name',
        'description',
        'district',
        'no_of_barangays',
        'is_capital',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function provinces(){
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function schools()
    {
        return $this->hasMany(School::class , 'school_id');
    }

    public function worklocations()
    {
        return $this->hasMany(WorkLocation::class, 'work_location_id');
    }

    public function barangays()
    {
        return $this->hasMany(Barangay::class, 'barangay_id');
    }
}
