<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PersonnelRequisition;

use Illuminate\Database\Eloquent\SoftDeletes;

class PrfReasonForReq extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [];

    protected $fillable =
    [
        'name',
        'description',
        'to_add_input',
        'no_of_inputfield',
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
