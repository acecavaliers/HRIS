<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShiftSetup extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [];
    protected $fillable = [
        'name',
        'with_start_date',
        'first_start_date',
        'second_start_date',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }
}
