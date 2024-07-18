<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubSpecialization;

use Illuminate\Database\Eloquent\SoftDeletes;

class Specialization extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [];


    protected $fillable = [

        'code',
        'short_name',
        'name',
        'description',
        'designation',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    public function subspecializations()
    {
        return $this->hasMany(SubSpecialization::class);
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
