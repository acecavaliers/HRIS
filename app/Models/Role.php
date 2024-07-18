<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;

    protected $foreignKeys = [];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    protected $fillable = [
        'name',
        'guard_name',
        'description',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',

    ];
}
