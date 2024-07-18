<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventType extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [];

    protected $fillable = [

        'code',
        'name',
        'description',
        'event_date',
        'event_time',
        'location',
        'organizer',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }
}
