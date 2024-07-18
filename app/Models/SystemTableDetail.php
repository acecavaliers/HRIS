<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FormType;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SystemTable;
use App\Models\TextEditor;

class SystemTableDetail extends Model
{


    use HasFactory,SoftDeletes;


    protected $foreignKeys = [
        'system_tables' => 'system_table_id',
        'form_types' => 'form_type_id',
        'text_editors' => 'text_editor_id'
    ];

    protected $fillable = [

        'system_table_id',
        'column_name',
        'column_label',
        'column_type',
        'enable_search',
        'enable_display_column',
        'enable_addform',
        'enable_editform',
        'is_active',
        'column_order',
        'search_order',
        'is_foreignkey',
        'reference_table',
        'reference_table_column',
        'is_required',
        'form_type_id',
        'required_text',
        'created_by',
        'updated_by',
        'deleted_by',
        'is_disabled'

    ];

    public function getForeignKeys(){
        return $this->foreignKeys;
    }

    public function formtypes(){
        return $this->belongsTo(FormType::class, 'form_type_id');
    }
    
    public function systemtables(){
        return $this->belongsTo(SystemTable::class, 'system_table_id');
    }
    public function autogeneratecodes(){
        return $this->hasMany(AutoGenerateCode::class, 'system_table_detail_id');
    }

    public function texteditors(){
        return $this->belongsTo(TextEditor::class, 'text_editor_id');
    }

}
