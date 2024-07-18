<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Specialization;

use Illuminate\Database\Eloquent\SoftDeletes;

class SubSpecialization extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = ['specializations' => 'specialization_id'];

    protected $fillable = [

        'specialization_id',
        'code',
        'short_name',
        'name',
        'description',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ] ;

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function specializations()
    {
        return $this->belongsTo(Specialization::class,'specialization_id');
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
