<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WorkLocation;
use App\Models\City;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barangay extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = ['cities' => 'city_id'];

    protected $fillable = [
        'city_id',
        'code',
        'name',
        'description',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    public function worklocations()
    {
        return $this->hasMany(WorkLocation::class, 'work_location_id');
    }

    public function cities()
    {
        return  $this->belongsTo(City::class, 'city_id');
    }
}
