<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Training;

class TrainingCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [
        'trainings' => 'training_id'
    ];

    protected $fillable = [
        'training_id',
        'name',
        'file_video',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    public function trainings()
    {
        return $this->belongsTo(Training::class, 'training_id');
    }
}
