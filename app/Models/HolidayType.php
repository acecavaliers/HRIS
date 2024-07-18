<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Holiday;
use Illuminate\Database\Eloquent\SoftDeletes;

class HolidayType extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [];

    protected $fillable = [

        'code',
        'short_name',
        'name',
        'description',
        'legend_color_code',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function holidays(){
        return $this->hasMany(Holiday::class);
    }
}
