<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Module;

class ModuleCategory extends Model
{
    use HasFactory;

    public function modules(){
        return $this->hasMany(Module::class);
    }
}
