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
        Schema::create('system_tables', function (Blueprint $table) {
            $table->id();
            $table->string('table_name');
            $table->string('model_name');
            $table->text('table_description')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('is_migrated')->default(0);
            $table->tinyInteger('is_columns_migrated')->default(0);
            $table->tinyInteger('enable_view_button')->default(1);
            $table->tinyInteger('enable_search_button')->default(1);
            $table->tinyInteger('enable_add_button')->default(1);
            $table->tinyInteger('enable_edit_button')->default(1);
            $table->tinyInteger('enable_export_button')->default(0);
            $table->tinyInteger('enable_delete_button')->default(1);
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
        Schema::dropIfExists('system_tables');
    }
};
