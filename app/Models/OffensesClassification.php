<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OffenseDetail;
use App\Models\CodeOfDiscipline;
use App\Models\EmployeeDisciplinaryAction;
use Illuminate\Database\Eloquent\SoftDeletes;

class OffensesClassification extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [
        'offense_details' => 'offense_detail_id', 'code_of_disciplines' => 'code_of_discipline_id'
    ];

    protected $fillable =
    [
        'offense_detail_id',
        'code_of_discipline_id',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }


    public function offensedetails()
    {
        return $this->belongsTo(OffenseDetail::class, 'offense_detail_id');
    }

    public function codeofdisciplines()
    {
        return $this->belongsTo(CodeOfDiscipline::class, 'code_of_discipline_id');
    }

    public function employeedisciplinaryactions()
    {
        return $this->hasMany(EmployeeDisciplinaryAction::class);
    }
}
