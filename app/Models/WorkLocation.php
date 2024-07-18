<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\Region;
use App\Models\Province;
use App\Models\Barangay;
use App\Models\EmployeeWorkAssignment;

use Illuminate\Database\Eloquent\SoftDeletes;

class WorkLocation extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [
        'countries' => 'country_id', 'regions' => 'region_id', 'provinces' => 'province_id', 'cities'=>'city_id','barangays'=>'barangay_id'
    ];

    protected $fillable = [
        'name',
        'description',
        'address',
        'contact_no',
        'email_address',
        'country_id',
        'region_id',
        'province_id',
        'city_id',
        'barangay_id',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    public function countries()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function regions()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function provinces()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function barangays()
    {
        return $this->belongsTo(Barangay::class, 'barangay_id');
    }

    public function employeeworkassignments()
    {
        return $this->hasMany(EmployeeWorkAssignment::class, 'work_location_id');
    }
}
