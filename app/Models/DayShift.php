<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\WorkShift;

class DayShift extends Model
{
    use HasFactory , SoftDeletes;

    protected $foreignKeys = ['work_shifts' => 'work_shift_id'];

    protected $fillable = [
        'work_shift_id',
        'work_monday',
        'work_tuesday',
        'work_wednesday',
        'work_thursday',
        'work_friday',
        'work_saturday',
        'work_sunday',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];


    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    public function workshifts()
    {
        return $this->belongsTo(WorkShift::class, 'work_shift_id');
    }
}
