<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\Region;

class IslandGroup extends Model
{
    use HasFactory;

    protected $fillable = [

        'country_id',
        'name',
        'description',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    protected $foreignKeys = ['countries' => 'country_id'];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function countries(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function regions(){
        return $this->hasMany(Region::class, 'region_id');
    }
}
