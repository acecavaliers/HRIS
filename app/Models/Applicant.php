<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PersonnelRequisition;
use App\Models\ApplicationSource;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicant extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = ['personnel_requisitions' => 'personnel_requisition_id', 'application_sources'=> 'application_source_id'];

    protected $fillable =
    [
        'personnel_requisition_id',
        'application_source_id',
        'applicant_code',
        'last_name',
        'first_name',
        'middle_name',
        'has_no_middlename',
        'suffix',
        'email_address',
        'contact_number',
        'address_street',
        'address_bldgorsubd',
        'address_province',
        'address_towncity',
        'address_zipcode',
        'address_region',
        'address_country',
        'address_barangay',
        'cover_letter',
        'curriculum_vitae',
    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function personnelrequisitions()
    {
        return $this->belongsTo(PersonnelRequisition::class,'personnel_requisition_id');
    }


    public function applicationsources()
    {
        return $this->belongsTo(ApplicationSource::class,'application_source_id');
    }

}
