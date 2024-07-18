<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FormType;
class DataType extends Model
{
    use HasFactory;

    protected $foreignKeys = [];


    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function formtypes(){
    
        return $this->belongsToMany(FormType::class);
    }
}
