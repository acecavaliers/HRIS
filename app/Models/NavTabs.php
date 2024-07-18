<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Module;
use App\Models\Submodules;

class NavTabs extends Model
{
    use HasFactory;

    public function modules(){
        return $this->belongsTo(Module::class);
    }

    public function submodules(){
        return $this->belongsTo(Submodules::class);
    }


}
