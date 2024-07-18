<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Country;
use App\Models\SalaryGradeDetail;

class SalaryStandardization extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = ['countries' => 'country_id'];

    protected $fillable = [
        'country_id',
        'code',
        'name',
        'description',
        'effectivity_date',
        'end_date',
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

    public function salarygradedetails()
    {
        return $this->hasMany(SalaryGradeDetail::class);
    }
}
