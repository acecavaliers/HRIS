<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Offense;
use App\Models\OffenseCategory;
use App\Models\OffensesClassification;
use Illuminate\Database\Eloquent\SoftDeletes;

class OffenseDetail extends Model
{
    use HasFactory, SoftDeletes;


    protected $foreignKeys = ['offenses'=>'offense_id', 'offense_categories' => 'offense_category_id'];

    protected $fillable = [
        'offense_id',
        'offense_category_id',
        'code',
        'description',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }


    public function offenses()
    {
        return $this->belongsTo(Offense::class, 'offense_id');
    }

    public function offensecategories()
    {
        return $this->belongsTo(OffenseCategory::class, 'offense_category_id');
    }

    public function offensesclassifications() {
        return $this->hasMany(OffensesClassification::class, 'offenses_classification_id');
    }
}
