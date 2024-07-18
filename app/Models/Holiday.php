<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HolidayType;
use Illuminate\Database\Eloquent\SoftDeletes;

class Holiday extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = ['holidaytypes' => 'holiday_type_id'];

    protected $fillable = [

        'holiday_type_id',
        'code',
        'short_name',
        'name',
        'description',
        'from_datetime',
        'to_datetime',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function holidaytypes(){
        return $this->belongsTo(HolidayType::class, 'holiday_type_id');
    }

    // ATTRIBUTES :: BEGIN
    protected $appends = ['temptime'];
    public function getTemptimeAttribute()
    {
        return strtoupper(date('ga',strtotime($this->from_datetime)));
    }

}
