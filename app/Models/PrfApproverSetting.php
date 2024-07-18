<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JobTitle;

class PrfApproverSetting extends Model
{
    use HasFactory;

    protected $foreignKeys = [
        'job_titles' => 'job_title_id',
    
    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    protected $fillable = [
        'job_title_id',
        'sequence',
        'is_required',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    public function jobtitles(){
        return $this->belongsTo(JobTitle::class,'job_title_id');
    }
}
