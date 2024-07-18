<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeIdentification extends Model
{
    use HasFactory , SoftDeletes;

    protected $foreignKeys = ['employees'=>'employee_id', 'identificationtypes' => 'identification_type_id'];

    protected $fillable = [
        'employee_id',
        'identification_type_id',
        'id_number',
        'expiration_date',
        'front_image_attachment',
        'back_image_attachment',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function identificationtypes()
    {
        return $this->belongsTo(IdentificationType::class, 'identification_type_id');
    }

}
