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
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('short_company_name')->nullable();
            $table->string('system_name')->nullable();
            $table->string('short_system_name')->nullable();
            $table->text('company_address')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_contact')->nullable();
            $table->string('company_logo')->nullable();
            $table->tinyInteger('is_autologout')->default(1);
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
        Schema::dropIfExists('system_settings');
    }
};
