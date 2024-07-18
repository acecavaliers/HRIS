<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_name',
        'model_name',
        'table_description',
        'is_active',
        'is_migrated',
        'is_columns_migrated',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function systemtabledetails(){
        return $this->hasMany(SystemTableDetail::class, 'system_table_id', 'id');
    }
}
