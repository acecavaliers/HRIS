<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThemeColor extends Model
{
    use HasFactory,SoftDeletes;


    protected $foreignKeys = [];

    protected $fillable = [

        'name',
        'navigation_sidebar_bg_color',
        'navigation_logo_bg_color',
        'navigation_logo_header_bg_color',
        'navigation_category_bg_color',
        'navigation_category_txt_color',
        'navigation_sidebar_txt_color',
        'navigation_sidebar_icon_txt_color',
        'datatable_bg_color',
        'datatable_txt_color',
        'navbar_bg_color',
        'navbar_txt_color',
        'pageheader_bg_color',
        'pageheader_txt_color',
        'buttons_bg_color',
        'buttons_txt_color',
        'is_selected',
        'is_default',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
      

    ];

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }
}
