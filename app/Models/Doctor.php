<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Specialization;
use App\Models\SubSpecialization;


class Doctor extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [
        'specializations' => 'specialization_id', 'sub_specializations'=>'sub_specialization_id'
    ];

    protected $fillable = [
        'prefix_name',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'professional_suffix',
        'no_middle_name',
        'gender',
        'civil_status',
        'birth_date',
        'nationality',
        'religion',
        'contactinfo_landlineno',
        'contactinfo_mobileno',
        'street',
        'bldgsubd',
        'region',
        'province',
        'city',
        'barangay',
        'zipcode',
        'country',
        'email_address',
        'blood_type',
        'specialization_id',
        'sub_specialization_id',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    public function specializations()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }

    public function subspecializations()
    {
        return $this->belongsTo(SubSpecialization::class, 'sub_specialization_id');
    }
}
