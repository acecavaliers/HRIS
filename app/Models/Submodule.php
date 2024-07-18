<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Module;

class Submodule extends Model
{
    use HasFactory;

   /*  protected $foreignKeys = ['module_id']; */

    protected $foreignKeys = [
        'modules' => 'module_id'
    ];

    public function modules(){
        return $this->belongsTo(Module::class);
    }

    public function navtabs(){
        return $this->hasMany(NavTabs::class);
    }

    public function getForeignKeys(){
        return $this->foreignKeys;
    }
}
