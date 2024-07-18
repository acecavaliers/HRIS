<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('theme_colors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('navigation_sidebar_bg_color')->nullable();
            $table->string('navigation_logo_bg_color')->nullable();
            $table->string('navigation_logo_header_bg_color')->nullable();
            $table->string('navigation_category_bg_color')->nullable();
            $table->string('navigation_category_txt_color')->nullable();
            $table->string('navigation_sidebar_txt_color')->nullable();
            $table->string('navigation_sidebar_icon_txt_color')->nullable();
            $table->string('navigation_sidebar_children_bg_color')->nullable();
            $table->string('navigation_sidebar_children_txt_color')->nullable();
            $table->string('navigation_sidebar_hover_bg_color')->nullable();
            $table->string('navigation_sidebar_hover_txt_color')->nullable();
            $table->string('navigation_sidebar_active_bg_color')->nullable();
            $table->string('navigation_sidebar_active_txt_color')->nullable();
            $table->string('navigation_sidebar_children_focus_ring_color')->nullable();
            $table->string('datatable_bg_color')->nullable();
            $table->string('datatable_txt_color')->nullable();
            $table->string('navbar_bg_color')->nullable();
            $table->string('navbar_txt_color')->nullable();
            $table->string('pageheader_bg_color')->nullable();
            $table->string('pageheader_txt_color')->nullable();
            $table->string('buttons_bg_color')->nullable();
            $table->string('buttons_txt_color')->nullable();
            $table->tinyInteger('is_selected')->default(0);
            $table->tinyInteger('is_default')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theme_colors');
    }
};
