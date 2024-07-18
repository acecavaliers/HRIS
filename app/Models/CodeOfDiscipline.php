<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OffenseCategory;
use App\Models\OffenseSeverity;
use App\Models\DisciplinaryAction;
use App\Models\OffensesClassification;
use Illuminate\Database\Eloquent\SoftDeletes;

class CodeOfDiscipline extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = ['offense_categories' => 'offense_category_id', 'offense_severities'=> 'offense_severity_id', 'disciplinary_actions' => 'disciplinary_action_id'];

    protected $fillable =
    [
        'offense_category_id',
        'offense_severity_id',
        'disciplinary_action_id',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }


    public function offensecategories()
    {
        return $this->belongsTo(OffenseCategory::class, 'offense_category_id');
    }

    public function offenseseverities()
    {
        return $this->belongsTo(OffenseSeverity::class, 'offense_severity_id');
    }

    public function disciplinaryactions()
    {
        return $this->belongsTo(DisciplinaryAction::class, 'disciplinary_action_id');
    }

    public function offensesclassifications()
    {
        return $this->hasMany(OffensesClassification::class, 'offenses_classification_id');
    }

}
