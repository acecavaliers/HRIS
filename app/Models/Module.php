<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Submodule;
use App\Models\NavTabs;
use App\Models\ModuleCategory;

class Module extends Model
{
    use HasFactory;

/*     protected $foreignKeys = ['module_category_id']; */

    protected $foreignKeys = [
        'module_categories' => 'module_category_id'
    ];

    public function submodules(){
        return $this->hasMany(Submodule::class)->orderBy('name', 'asc');
    }

    public function navtabs(){
        return $this->hasMany(NavTabs::class);
    }

    public function modulecategories(){
        return $this->belongsTo(ModuleCategory::class);
    }

    public function getForeignKeys(){
        return $this->foreignKeys;
    }
}
