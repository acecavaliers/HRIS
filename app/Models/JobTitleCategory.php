<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JobTitle;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobTitleCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [];

    protected $fillable = [
        'code',
        'name',
        'description',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function jobtitle()
    {
        return $this->hasMany(JobTitle::class, 'job_title_id');
    }
}
