<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeHandbook extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [];

    protected $fillable = [

        'title',
        'description',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
        'file_path',
        'file_size',
        'file_type',


    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }
}
