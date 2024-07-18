<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SalaryStandardization;
use App\Models\SalaryGrade;


class SalaryGradeDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [
        'salary_standardizations' => 'salary_standardization_id', 'salary_grades' => 'salary_grade_id'
    ];

    protected $fillable = [
        'salary_standardization_id',
        'salary_grade_id',
        'code',
        'name',
        'description',
        'amount_value',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    public function salarystandardizations()
    {
        return $this->belongsTo(SalaryStandardization::class, 'salary_standardization_id');
    }

    public function salarygrades()
    {
        return $this->belongsTo(SalaryGrade::class, 'salary_grade_id');
    }
}
