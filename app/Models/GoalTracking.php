<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'goal_type',
        'start_date',
        'end_date',
        'subject',
        'target_achievement',
        'description',
        'created_by',
        'rating',
    ];

    public function goalType()
    {
        return $this->hasOne('App\Models\GoalType', 'id', 'goal_type');
    }

    public static $status = [
        'Not Started',
        'In Progress',
        'Completed',
    ];

}
