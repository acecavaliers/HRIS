<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeeEmploymentDetail;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [];

    protected $fillable = [
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

    public function employeeemploymentdetails()
    {
        return $this->hasMany(EmployeeEmploymentDetail::class);
    }
}
