<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appraisal extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee',
        'appraisal_date',
        'customer_experience',
        'marketing',
        'administration',
        'professionalism',
        'integrity',
        'attendance',
        'remark',
        'created_by',
        'rating',
    ];

    public static $technical = [
        'None',
        'Beginner',
        'Intermediate',
        'Advanced',
        'Expert / Leader',
    ];

    public static $organizational = [
        'None',
        'Beginner',
        'Intermediate',
        'Advanced',
    ];

    public function employees()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'employee');
    }
}
