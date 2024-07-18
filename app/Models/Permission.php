<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory;

    protected $foreignKeys = [];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    protected $fillable = [
        'name',
        'category',
        'guard_name',
        'description',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

}
