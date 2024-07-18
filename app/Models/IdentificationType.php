<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeeIdentification;
use Illuminate\Database\Eloquent\SoftDeletes;

class IdentificationType extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [];

    protected $fillable = [
        'name',
        'description',
        'with_expiration',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    public function employeeidentifications()
    {
        return $this->hasMany(EmployeeIdentification::class);
    }
}
