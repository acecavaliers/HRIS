<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrfGeneralSetting extends Model
{
    use HasFactory;

    protected $foreignKeys = [];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    protected $fillable = [
        'no_of_approvers',
        'created_by',
        'updated_by',
        'deleted_by',

    ];
}
