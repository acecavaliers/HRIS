<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Province;
use App\Models\Country;
use App\Models\IslandGroup;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use HasFactory, SoftDeletes;


    protected $foreignKeys = ['countries' => 'country_id', 'island_groups' => 'island_group_id'];

    protected $fillable = [
        'country_id',
        'island_group_id',
        'short_name',
        'name',
        'description',
        'no_of_lgus',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function countries(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function islandgroups(){
        return $this->belongsTo(IslandGroup::class, 'island_group_id');
    }

    public function provinces(){
        return $this->hasMany(Province::class);
    }

    public function worklocations()
    {
        return $this->hasMany(WorkLocation::class, 'work_location_id');
    }


}
