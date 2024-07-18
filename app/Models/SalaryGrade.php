<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SalaryGradeDetail;


class SalaryGrade extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [];

    protected $fillable = [
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

    public function salarygradedetails()
    {
        return $this->hasMany(SalaryGradeDetail::class);
    }
}
