<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Training extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [];


    protected $fillable = [
        'name',
        'code',
        'description',
        'start_datetime',
        'end_datetime',
        'is_active',
        'creadted_by',
        'updated_by',
        'deleted_by',
    ];

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    public function trainingcategories()
    {
        return $this->hasMany(TrainingCategory::class);
    }
}
