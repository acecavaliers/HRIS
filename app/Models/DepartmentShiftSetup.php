<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentShiftSetup extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [
        'shift_setups' => 'shift_setup_id',
        'departments' => 'department_id'
    ];

    protected $fillable = [
        'department_id',
        'shift_setup_id',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];


    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function shift_setups()
    {
        return $this->belongsTo(ShiftSetup::class, 'shift_setup_id');
    }
}
