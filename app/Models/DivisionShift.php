<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DivisionShift extends Model
{
    use HasFactory , SoftDeletes;

    protected $foreignKeys = ['work_shifts' => 'work_shift_id',
                            'divisions' => 'division_id'];

    protected $fillable = [
        'division_id',
        'work_shift_id',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];


    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    public function divisions()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function workshifts()
    {
        return $this->belongsTo(WorkShift::class, 'work_shift_id');
    }
}
