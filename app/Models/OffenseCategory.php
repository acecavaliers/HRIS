<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OffenseDetail;
use App\Models\CodeOfDiscipline;
use Illuminate\Database\Eloquent\SoftDeletes;

class OffenseCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = [];

    protected $fillable = [
        'code',
        'description',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function offensedetails()
    {
        return $this->hasMany(OffenseDetail::class, 'offense_detail_id');
    }

    public function codeofdisciplines()
    {
        return $this->hasMany(CodeOfDiscipline::class, 'code_of_discipline_id');
    }


}
