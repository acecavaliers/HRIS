<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\OffenseDetail;
use App\Models\CodeOfDisciplines;

class EmployeeDisciplinaryAction extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = ['employees' => 'employee_id', 'offenses_classifications'=>'offenses_classification_id'];

    protected $fillable = [
        'employee_id',
        'offenses_classification_id',
        'date_acted',
        'date_start',
        'date_end',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function offensedetails()
    {
        return $this->belongsToMany(OffenseDetail::class, 'offenses_classifications', 'id', 'offense_detail_id');
    }

    public function codeofdisciplines()
    {
        return $this->belongsToMany(CodeOfDisciplines::class, 'offenses_classifications', 'id', 'code_of_discipline_id');
    }
}
