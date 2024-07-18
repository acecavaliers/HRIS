<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SystemTableDetail;
use Illuminate\Database\Eloquent\SoftDeletes;

class AutoGenerateCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $foreignKeys = ['system_table_detail' => 'system_table_detail_id'];

    protected $fillable = [

        'system_table_detail_id',
        'prefix',
        'no_of_digits',
        'no_start_from',
        'no_end_from',
        'current_no',
        'next_no',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function systemtabledetails()
    {
        return $this->belongsTo(SystemTableDetail::class, 'system_table_detail_id');
    }


}
