<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SystemTableDetail;
use App\Models\DataType;
class FormType extends Model
{
    use HasFactory;

    protected $foreignKeys = ['data_types' => 'data_type_id'];



    public function tablesettingsdetails(){
        return $this->hasMany(SystemTableDetail::class);
    }

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function datatypes(){

        return $this->belongsToMany(DataType::class);
    }

 

  
}
