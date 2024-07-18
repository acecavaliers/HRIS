<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
use App\Models\City;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = ['regions' => 'region_id'];

    protected $fillable = [
        'region_id',
        'flag',
        'seal',
        'short_name',
        'name',
        'description',
        'no_of_cities',
        'no_of_municipalities',
        'no_of_barangays',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function regions(){
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function cities(){
        return $this->hasMany(City::class, 'city_id');
    }

    public function worklocations()
    {
        return $this->hasMany(WorkLocation::class, 'work_location_id');
    }

}
