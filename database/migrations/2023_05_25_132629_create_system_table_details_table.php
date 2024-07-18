<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\SystemTable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('system_table_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SystemTable::class)->constrained('system_tables');
            $table->string('column_name');
            $table->string('column_label')->nullable();
            $table->string('column_type');
            $table->tinyInteger('enable_search')->default(1);
            $table->tinyInteger('enable_display_column')->default(1);
            $table->tinyInteger('default_display_column')->default(1);
            $table->tinyInteger('enable_sort')->default(0);
            $table->tinyInteger('enable_addform')->default(0);
            $table->tinyInteger('enable_editform')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->integer('column_order')->default(0);
            $table->integer('search_order')->default(0);
            $table->tinyInteger('is_foreignkey')->default(0);
            $table->string('reference_table')->nullable();
            $table->string('reference_table_column')->nullable();
            $table->string('where_column')->nullable();
            $table->string('where_column_reference')->nullable();
            $table->string('display_data_column')->nullable();
            $table->tinyInteger('is_required')->default(0);
            $table->string('required_text')->nullable();
            $table->tinyInteger('is_disabled')->default(0);
            $table->tinyInteger('is_autogenerate')->default(0);
            $table->tinyInteger('is_unique')->default(0);
            $table->tinyInteger('use_texteditor')->default(0);
            $table->tinyInteger('is_form_hidden')->default(0);
            $table->tinyInteger('is_fk_getreferenced')->default(0);
            $table->tinyInteger('hide_column')->default(0);
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
        Schema::dropIfExists('system_table_details');
    }
};
