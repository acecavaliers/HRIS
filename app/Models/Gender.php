<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gender extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [];

    protected $fillable = [
        'name',
        'is_active',
        'created_by',
        'deleted_by',
        'updated_by'
    ];

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }
}
