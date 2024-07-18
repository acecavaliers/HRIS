<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Occupation extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    protected $fillable = [
        'code',
        'short_name',
        'name',
        'description',
        'has_prc',
        'has_s2',
        'has_phicacrreditation',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',

    ];
}
